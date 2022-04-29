<?php

namespace App\Models\SIGSAS\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\ComunidadFilter;
use App\Traits\Catalogos\Domicilio\Comunidad\ComunidadTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comunidad extends Model
{

    use SoftDeletes;
    use ComunidadTrait;

    protected $guard_name = 'web';
    protected $table = 'comunidades';

    protected $fillable = [
        'id', 'comunidad','delegado_id','tipocomunidad_id','ciudad_id','municipio_id','estado_id','nomenclatura',
        'comunidad_mig_id',
    ];
    protected $hidden = ['deleted_at','created_at','updated_at'];

    public function scopeFilterBy($query, $filters){
        return (new ComunidadFilter())->applyTo($query, $filters);
    }

    public function delegado() {
        return $this->hasOne(User::class,'id','delegado_id');
    }

    public function tipoComunidad() {
        return $this->hasOne(Tipocomunidad::class,'id','tipocomunidad_id');
    }

    public function ciudad() {
        return $this->hasOne(Ciudad::class,'id','ciudad_id');
    }

    public function municipio() {
        return $this->hasOne(Municipio::class,'id','municipio_id');
    }

    public function estado() {
        return $this->hasOne(Estado::class,'id','estado_id');
    }


}
