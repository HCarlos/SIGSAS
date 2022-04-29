<?php

namespace App\Models\SIGSAS\Catalogos\Domicilios;

use App\Filters\Catalogo\Domicilio\CalleFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calle extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'calles';

    protected $fillable = [
        'id', 'calle', 'calle_mig_id',
    ];
    protected $hidden = ['deleted_at','created_at','updated_at'];

    public function scopeFilterBy($query, $filters)
    {
        return (new CalleFilter())->applyTo($query, $filters);
    }

    public static function findOrImport($calle){
        $obj = static::where('calle', trim($calle))->first();
        if (!$obj) {
            $obj = static::create([
                'calle' => strtoupper(trim($calle)),
            ]);
        }
        return $obj;
    }



}
