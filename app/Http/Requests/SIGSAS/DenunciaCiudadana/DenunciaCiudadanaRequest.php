<?php

namespace App\Http\Requests\SIGSAS\DenunciaCiudadana;

use App\Models\SIGSAS\Domicilios\Ubicacion;
use App\Models\SIGSAS\Denuncias\Denuncia;
use App\Models\SIGSAS\Denuncias\DenunciaEstatu;
//use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
//use PhpOffice\PhpSpreadsheet\Shared\Date;

class DenunciaCiudadanaRequest extends FormRequest
{


    protected $redirectRoute = 'newDenunciaCiudadana';

    public function authorize(){
        return true;
    }

    public function rules()
    {

        return [
            'descripcion'      => ['required'],
            'referencia'       => ['required'],
            'fecha_ingreso'    => ['required','date'],
            'servicio_id'      => ['required'],
        ];
    }

    public function messages(){
        return [
            'descripcion.required'      => 'La :attribute requiere por lo menos de 4 caracter',
            'referencia.required'       => 'La :attribute es requerida',
            'fecha_ingreso.required'    => 'La :attribute es requerida',
            'servicio_id.required'      => 'El :attribute es requerida',
        ];
    }

    public function attributes(){
        return [
            'descripcion'     => 'Denuncia',
            'referencia'      => 'Referencia',
            'fecha_ingreso'   => 'Fecha de Ingreso',
            'servicio_id'     => 'Servicio',
        ];
    }

    public function manageDC(){

        // dd( $this->all() );

        try {

            $this->ubicacion_id = Auth::user()->Ubicacion->id;

            $Ubicacion = Ubicacion::findOrFail( $this->ubicacion_id );

            $Item = [
                'fecha_ingreso'                => $this->fecha_ingreso,
                'fecha_limite'                 => $this->fecha_limite,
                'fecha_ejecucion'              => $this->fecha_ejecucion,

                'descripcion'                  => strtoupper(trim($this->descripcion)),
                'referencia'                   => strtoupper(trim($this->referencia)),

                'calle'                        => strtoupper($Ubicacion->calle),
                'num_ext'                      => strtoupper($Ubicacion->num_ext),
                'num_int'                      => strtoupper($Ubicacion->num_int),
                'colonia'                      => strtoupper($Ubicacion->colonia),
                'comunidad'                    => strtoupper($Ubicacion->comunidad),
                'ciudad'                       => strtoupper($Ubicacion->ciudad),
                'municipio'                    => strtoupper($Ubicacion->municipio),
                'estado'                       => strtoupper($Ubicacion->estado),
                'cp'                           => strtoupper($Ubicacion->cp),

                'prioridad_id'                 => 2,
                'origen_id'                    => 4,
                'dependencia_id'               => intval($this->dependencia_id),
                'ubicacion_id'                 => floatval($this->ubicacion_id),
                'servicio_id'                  => intval($this->servicio_id),
                'estatus_id'                   => 8,
                'ciudadano_id'                 => Auth::id(),
                'creadopor_id'                 => Auth::id(),
                'modificadopor_id'             => floatval($this->modificadopor_id),
                'domicilio_ciudadano_internet' => strtoupper(trim($this->domicilio_ciudadano_internet)),

            ];

            //dd($Item);

            if ( intval($this->id) == 0) {
                $item = Denuncia::create($Item);
            }
            $item = $this->attaches($item);
        }catch (QueryException $e){
            Log::alert( "Error del Sistema: " . $e->getMessage() );
            $Msg = new MessageAlertClass();
            return $Msg->Message($e);
        }
        return $item;

    }

    public function attaches($Item){
        $Item->prioridades()->attach($this->prioridad_id);
        $Item->origenes()->attach($this->origen_id);
        $Item->dependencias()->attach($this->dependencia_id,['servicio_id'=>$this->servicio_id,'estatu_id'=>$this->estatus_id,'fecha_movimiento' => now() ]);
        $Item->ubicaciones()->attach($this->ubicacion_id);
        $Item->servicios()->attach($this->servicio_id);

//        DenunciaEstatu::where('denuncia_id',$this->id)->update(['ultimo'=>false]);
        $Item->estatus()->attach($this->estatus_id,['ultimo'=>true]);
        $Item->ciudadanos()->attach($this->ciudadano_id);
        $Item->creadospor()->attach($this->creadopor_id);
        $Item->modificadospor()->attach($this->modificadopor_id);
        return $Item;
    }

    public function detaches($Item){
        $Item->prioridades()->detach($this->prioridad_id);
        $Item->origenes()->detach($this->origen_id);
        $Item->dependencias()->detach($this->dependencia_id);
        $Item->ubicaciones()->detach($this->ubicacion_id);
        $Item->servicios()->detach($this->servicio_id);

        $Item->estatus()->detach($this->estatus_id);
        DenunciaEstatu::where('denuncia_id',$this->id)->orderByDesc('id')->update(['ultimo'=>true]);
        $Item->ciudadanos()->detach($this->ciudadano_id);
        $Item->creadospor()->detach($this->creadopor_id);
        $Item->modificadospor()->detach($this->modificadopor_id);
        return $Item;
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('newDenunciaCiudadana');
        }
    }







}
