<?php

namespace App\Http\Controllers\SIGSAS\External;

use App\Classes\LoadTemplateExcel;
use App\Http\Controllers\Controller;
use App\Models\SIGSAS\Denuncias\Denuncia;
use App\Models\SIGSAS\Denuncias\Denuncia_Dependencia_Servicio;
use App\Models\SIGSAS\Domicilios\Ubicacion;
use App\Models\SIGSAS\Estructura\Dependencia;
use App\Models\SIGSAS\Estructura\Estatu;
use App\Models\SIGSAS\Estructura\Origen;
use App\Models\SIGSAS\Estructura\Prioridad;
use App\Models\SIGSAS\Estructura\Servicio;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ListDenunciaXLSXController extends Controller
{

    public function getListDenunciaXLSX(Request $request){
        ini_set('max_execution_time', 900);
//        $data = $request->only(['search','items']);
        $Items = $request->session()->get('items');

        $C0 = 6;
        $C = $C0;

        try {
            $file_external = trim(config("atemun.archivos.fmt_lista_denuncias"));
            //dd($file_external);
            $arrFE = explode('.',$file_external);
            $extension = Str::ucfirst($arrFE[1]);

            $archivo =  LoadTemplateExcel::getFileTemplate($file_external);
            $reader = IOFactory::createReader($extension);
            $spreadsheet = $reader->load($archivo);
            $sh = $spreadsheet->setActiveSheetIndex(0);

            $sh->setCellValue('S1', Carbon::now()->format('d-m-Y h:m:s'));
            foreach ($Items as $item){

                $ciudadano   = User::find($item->ciudadano_id);
                $prioridad   = Prioridad::find($item->prioridad_id);
                $origen      = Origen::find($item->origen_id);
                $dependencia = Dependencia::find($item->dependencia_id);
                $servicio    = Servicio::find($item->servicio_id);
                $ubicacion   = Ubicacion::find($item->ubicacion_id);
                $estatus     = Estatu::find($item->estatus_id);
                $creadopor   = User::find($item->creadopor_id);

                $fechaIngreso   = date_format($item->fecha_ingreso,'d-m-Y');
                $fechaLimite    = Carbon::parse($item->fecha_limite)->format('d-m-Y'); //Carbon::createFromFormat('d-m-Y', $item->fecha_nacimiento);
                $fechaEjecucion = Carbon::parse($item->fecha_ejecucion)->format('d-m-Y'); //Carbon::createFromFormat('d-m-Y', $item->fecha_nacimiento);

                $resp = Denuncia_Dependencia_Servicio::query()->where('denuncia_id',$item->id)->orderByDesc('id')->get();
                $respuesta = "";
                foreach ($resp as $r){
                    $res = trim($r->observaciones);
                    if ( $res != ""){
                        $dep = Dependencia::find($r->dependencia_id);
                        $respuesta.=$dep->abreviatura.' - '.$res.'. ';
                    }
                }

                $sh
                    ->setCellValue('A'.$C, $item->id ?? 0)
                    ->setCellValue('B'.$C, $ciudadano->curp ?? '')
                    ->setCellValue('C'.$C, $ciudadano->ap_paterno ?? '')
                    ->setCellValue('D'.$C, $ciudadano->ap_materno ?? '')
                    ->setCellValue('E'.$C, $ciudadano->nombre ?? '')

                    ->setCellValue('F'.$C, trim($ubicacion->calle) ?? '')
                    ->setCellValue('G'.$C, trim($ubicacion->num_ext) ?? '')
                    ->setCellValue('H'.$C, trim($ubicacion->num_int) ?? '')
                    ->setCellValue('I'.$C, trim($ubicacion->colonia) ?? '')
                    ->setCellValue('J'.$C, trim($ubicacion->cp) ?? '')

                    ->setCellValue('K'.$C, $ubicacion->Ubicacion ?? '')
                    ->setCellValue('L'.$C, $ciudadano->TelefonosCelularesEmails ?? '')
                    ->setCellValue('M'.$C, $fechaIngreso ?? '')
                    ->setCellValue('N'.$C, $servicio->subarea->area->dependencia->dependencia ?? '')
                    ->setCellValue('O'.$C, $servicio->subarea->area->area ?? '')
                    ->setCellValue('P'.$C, $servicio->subarea->subarea ?? '')
                    ->setCellValue('Q'.$C, $servicio->servicio ?? '')
                    ->setCellValue('R'.$C, $item->descripcion ?? '')
                    ->setCellValue('S'.$C, $item->referencia ?? '')
                    ->setCellValue('T'.$C, $prioridad->prioridad ?? '')
                    ->setCellValue('U'.$C, $origen->origen ?? '')
                    ->setCellValue('V'.$C, $item->ultimo_estatus ?? '')
                    ->setCellValue('W'.$C, $item->ultima_fecha_estatus ?? '')
                    ->setCellValue('X'.$C, $respuesta )
                    ->setCellValue('Y'.$C, $item->observaciones )
                    ->setCellValue('Z'.$C, $item->creadopor->username )
                    ->setCellValue('AA'.$C, $item->uuid );

                $C++;
            }
            $Cx = $C  - 1;
            $oVal = $sh->getCell('G1')->getValue();
            $sh->setCellValue('B'.$C, 'TOTAL DE REGISTROS')
                ->setCellValue('C'.$C, '=COUNT(A'.$C0.':A'.$Cx.')')
                ->setCellValue('G'.$C, $oVal);

            $sh->getStyle('A'.$C0.':G'.$C)->getFont()
                ->setName('Arial')
                ->setSize(8);

            $sh->getStyle('A'.$C.':G'.$C)->getFont()->setBold(true);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="_'.$arrFE[0].'.'.$arrFE[1].'"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: cache, must-revalidate');
            header('Pragma: public');
            $writer = IOFactory::createWriter($spreadsheet, $extension);
            $writer->save('php://output');
            exit;

        } catch (Exception $e) {
            echo 'Ocurrio un error al intentar abrir el archivo ' . $e;
        }

    }

    public function showDataListDenunciaRespuestaExcel1A(Request $request){
        ini_set('max_execution_time', 900);
//        $data = $request->only(['search','items']);
        $Items = $request->session()->get('items');

        $C0 = 7;
        $C = $C0;

        try {
            $file_external = trim(config("atemun.archivos.fmt_lista_respuestas"));
            //dd($file_external);
            $arrFE = explode('.',$file_external);
            $extension = Str::ucfirst($arrFE[1]);

            $archivo =  LoadTemplateExcel::getFileTemplate($file_external);
            $reader = IOFactory::createReader($extension);
            $spreadsheet = $reader->load($archivo);
            $sh = $spreadsheet->setActiveSheetIndex(0);

            $sh->setCellValue('H1', Carbon::now()->format('d-m-Y h:m:s'));
            foreach ($Items as $item){

                $Id               = $item->id;
                $denuncia_id      = $item->denuncia_id;
                $dependencia_id   = $item->dependencia_id;
                $servicio_id      = $item->servicio_id;
                $estatu_id        = $item->estatu_id;
                $fecha_movimiento = $item->fecha_movimiento;
                $respuesta        = $item->observaciones;

                $Denuncia    = Denuncia::find($denuncia_id);
                $Dependencia = Dependencia::find($dependencia_id);
                $Servicio    = Servicio::find($servicio_id);
                $Estatus     = Estatu::find($estatu_id);

                $ciudadano   = User::find($Denuncia->ciudadano_id);
                $prioridad   = Prioridad::find($Denuncia->prioridad_id);
                $origen      = Origen::find($Denuncia->origen_id);
                $dependencia = Dependencia::find($Denuncia->dependencia_id);
                $servicio    = Servicio::find($Denuncia->servicio_id);
                $ubicacion   = Ubicacion::find($Denuncia->ubicacion_id);
                $estatus     = Estatu::find($Denuncia->estatus_id);
                $creadopor   = User::find($Denuncia->creadopor_id);

                $fechaIngreso   = Carbon::parse($Denuncia->fecha_ingreso)->format('d-m-Y'); //Carbon::createFromFormat('d-m-Y', $item->fecha_nacimiento);
                $fechaLimite    = Carbon::parse($Denuncia->fecha_limite)->format('d-m-Y'); //Carbon::createFromFormat('d-m-Y', $item->fecha_nacimiento);
                $fechaEjecucion = Carbon::parse($Denuncia->fecha_ejecucion)->format('d-m-Y'); //Carbon::createFromFormat('d-m-Y', $item->fecha_nacimiento);

                $sh
                    ->setCellValue('A'.$C, $item->id)
                    ->setCellValue('B'.$C, trim($Dependencia->dependencia))
                    ->setCellValue('C'.$C, trim($Servicio->servicio))
                    ->setCellValue('D'.$C, trim($Estatus->estatus))
                    ->setCellValue('E'.$C, trim($Denuncia->descripcion))
                    ->setCellValue('F'.$C, trim($Denuncia->referencia))
                    ->setCellValue('G'.$C, trim($respuesta))
                    ->setCellValue('H'.$C,  date('d-m-Y H:i:s', strtotime($fecha_movimiento)) );

                $C++;
            }
            $Cx = $C  - 1;
            $sh->setCellValue('B'.$C, 'TOTAL DE REGISTROS')
                ->setCellValue('C'.$C, '=COUNT(A'.$C0.':A'.$Cx.')');

            $sh->getStyle('A'.$C0.':G'.$C)->getFont()
                ->setName('Arial')
                ->setSize(8);

            $sh->getStyle('A'.$C.':G'.$C)->getFont()->setBold(true);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="_'.$arrFE[0].'.'.$arrFE[1].'"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: cache, must-revalidate');
            header('Pragma: public');
            $writer = IOFactory::createWriter($spreadsheet, $extension);
            $writer->save('php://output');
            exit;

        } catch (Exception $e) {
            echo 'Ocurrio un error al intentar abrir el archivo ' . $e;
        }



    }









}
