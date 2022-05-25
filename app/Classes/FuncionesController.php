<?php

namespace App\Classes;

//require __DIR__ . "/vendor/autoload.php";

use App\Classes\MessageAlertClass;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
//use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Exception\NotWritableException;
use Intervention\Image\Facades\Image;
//use Intervention\Image\ImageManager;
//use RapidApi\RapidApiConnect;

class FuncionesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function toMayus($str=""){
        return strtr(strtoupper($str), "áéíóúñ", "ÁÉÍÓÚÑ");
    }

    public function showFile($root="/archivos/",$archivo=""){
        $public_path = public_path();
        $url = $public_path."/storage/".$root.$archivo;
        if (Storage::exists($archivo))
        {
            return response()->download($url);
        }
        abort(404);
    }

    public function string_to_tsQuery(String $string, String $type){
        $str = explode(' ',$string);
        //dd($str);
        $string = '';
        $i = 1;
        foreach ($str as $value){
            if ( strlen($value) >= 4 ){
                $vector = '';
                if ($string!=''){
                    $vector = $type;
                }
                $string = $string.$vector.$value;
            }
            ++$i;
        }
        return $string;
    }
    // get IP, Host or IdEmp
    public function getIHE($type=0){
        switch ($type){
            case 0:
                return 1;
                beark;
            case 1:
                return $_SERVER['REMOTE_ADDR'];
                beark;
            case 2:
                return gethostbyaddr($_SERVER['REMOTE_ADDR']);
                beark;
        }
    }

    public function setDateTo6Digit($fecha){
        if(is_null($fecha)){
            $fecha = Carbon::today()->toDateString();
        }
//        dd(Carbon::now());
        $fecha = str_replace('20','',$fecha);
        $fecha = str_replace('-','',$fecha);
        return $fecha;
    }

    public function getFechaFromNumeric($number){
        return
            '20'.substr($number,0,2).'-'.
            substr($number,2,2).'-'.
            substr($number,4,2)
            ;
    }

    public function fechaEspanol($f){
        $f = explode('-',substr($f,0,10));
        return $f[2].'-'.$f[1].'-'.$f[0];
    }

    public function fechaEspanolComplete($f,$type=false){
        $f = explode('-',substr($f,0,10));
        $f =  $f[2].'-'.$f[1].'-'.$f[0];
        return !$type ? $f.' 00:00:00' : $f.' 23:59:59';
    }

    public function fechaDateTimeFormat($f,$type=false){
        $f = explode('-',substr($f,0,10));
        $f = $f[0].'-'.$f[1].'-'.$f[2];
        return !$type ? $f.' 00:00:00' : $f.' 23:59:59';
    }

    public function validImage($model, $storage, $root, $type=1){
        $ext = config('atemun.images_type_extension');
        for ($i=0;$i<count($ext);$i++){
            $p1 = $model->id.'.'.$ext[$i];
            $p2 = '_'.$model->id.'.png';
            $p3 = '_thumb_'.$model->id.'.png';
            $e1 = Storage::disk($storage)->exists($p1);
            if ($e1) {
                switch ($type) {
                    case 1:
                        $model->update([
                            'root'              =>  $root,
                            'filename'          =>  $p1,
                            'filename_png'      =>  $p2,
                            'filename_thumb'    =>  $p3
                        ]);
                        break;
                }
            }
        }
    }

    public function deleteImages($model,$storage){
        $ext = ['jpg','jpeg','gif','png','JPG','JPEG','GIF','PNG','xls','xlsx','doc','docx','ppt','pptx','txt','mp4','pages','key','numbers'];
        for ($i=0;$i<4;$i++){
            $p1 = $model->id.'.'.$ext[$i];
            $e1 = Storage::disk($storage)->exists($p1);
            if ($e1) {
                Storage::disk($storage)->delete($p1);
            }
        }
    }

    public function fitImage($imagePath,$filename,$W,$H,$IsRounded,$disk="profile",$profile_root="PROFILE_ROOT")
    {
        try{
            $image = Image::make($imagePath)
                ->fit($W,$H);
            if ($IsRounded){
                $image->encode('png');
                $width = $image->getWidth();
                $height = $image->getHeight();
                $mask = Image::canvas($width, $height);
                $mask->circle($width, $width/2, $height/2, function ($draw) {
                    $draw->background('#fff');
                });
                $image->mask($mask, false);
                $filePath = public_path(env($profile_root)).'/'.$filename;
                $image->save($filePath);
                Storage::disk($disk)->put($filename, $image);
                if (File::exists($filePath)) {
                    unlink($filePath);
                }
            }else{
                Storage::disk($disk)->put($filename, $image);
            }
        }catch (NotWritableException $e){
            return "Error ";
        }
        return $image;
    }

    public function deleteImageDropZone($image,$storage){
        $e1 = Storage::disk($storage)->exists($image);
        if ($e1) {
            Storage::disk($storage)->delete($image);
        }
    }

/*

    public function getDatosFromCURPRENAPO($value){

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://curp-renapo.p.rapidapi.com/v1/curp/".$value,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: curp-renapo.p.rapidapi.com",
                "x-rapidapi-key: 443ebd50abmsh706bc0616bc2595p1dacbajsn5d699f5df978"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }

    }


    public function getCURPFromRENAPO($value){
        try {

            $ch = curl_init();
            $skipper = "luxury assault recreational vehicle";
            $header1 = ['Accept' => 'text/html; charset=iso-8859-1', 'Content-Type' => 'text/html;charset=iso-8859-1'];
            $parametros = ['curp' => 'HIRC711126HTCDZR01'];
            $postvars = '';
            foreach ($parametros as $key => $value) {
                $postvars .= $key . "=" . $value . "&";
            }

            // dd( $postvars );

            // $url = "http://api_cloud.factorumweb.com/ApiTimbrado/Timbrado/FactorumGenYaSelladoConArchivoTest/";
            $url = "http://www.renapo.sep.gob.mx/wsrenapo/MainControllerParam";

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parametros));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
                    'Content-Type:text/html',
                    'Content-Length: ' . strlen(json_encode($parametros)),
                    'Accept: text/html'
                )
            );

            $result = curl_exec($ch);
            curl_close($ch);

        } catch (curl_error $E) {
            echo $E->faultstring;
            return false;
        }

        return $result;

//        $result = json_decode($result, true);
//        $data = $result["returnStringXML"];
//        $img  = base64_decode( $result["returnFileQRCode"] );

    }
*/


}
