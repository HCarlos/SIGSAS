<?php

namespace App\Http\Requests\SIGSAS\Denuncia;

use App\Models\SIGSAS\Estructura\Servicio;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;
use App\Classes\MessageAlertClass;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServicioRequest extends FormRequest
{


    protected $redirectRoute = 'editServicio';

    public function authorize()
    {
        return true;
    }

    public function validationData(){
        $attributes = parent::all();
        $attributes['servicio'] = strtoupper(trim($attributes['servicio']));
        $this->replace($attributes);
        return parent::all();
    }

    public function rules()
    {
        return [
            'servicio' => ['required','min:2',new Uppercase,'unique:servicios,servicio,'.$this->id],
        ];
    }

    public function messages()
    {
        return [
            'servicio.required' => 'La :attribute requiere por lo menos de 2 caracteres',
            'servicio.unique' => 'La :attribute ya existe',
        ];
    }

    public function attributes()
    {
        return [
            'servicio' => 'Servicio',
        ];
    }

    public function manage()
    {

        $Item = [
            'servicio' => strtoupper($this->servicio),
            'class_css' => $this->class_css,
            'habilitado' => $this->habilitado==1?true:false,
            'medida_id' => $this->medida_id,
            'subarea_id' => $this->subarea_id,
        ];

        try {
            if ($this->id == 0) {
                $item = Servicio::create($Item);
                $item->subareas()->attach($this->subarea_id);
            } else {
                $item = Servicio::find($this->id);
                $item->update($Item);
            }
        }catch (QueryException $e){
            $Msg = new MessageAlertClass();
            throw new HttpResponseException(response()->json( $Msg->Message($e), 422));
        }
        return $item;
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('newServicio');
        }
    }



}
