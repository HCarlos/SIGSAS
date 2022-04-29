<?php

namespace App\Models\SIGSAS\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\EstadoFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'estados';

    protected $fillable = [
        'id', 'estado', 'estado_mig_id',
    ];
    protected $hidden = ['deleted_at','created_at','updated_at'];

    public function scopeFilterBy($query, $filters){
        return (new EstadoFilter())->applyTo($query, $filters);
    }

    public static function findOrImport($estado){
        $obj = static::where('estado', trim($estado))->first();
        if (!$obj) {
            $obj = static::create([
                'estado' => strtoupper(trim($estado)),
            ]);
        }
        return $obj;
    }



}
