<?php

namespace App\Models\SIGSAS\Domicilios;

use App\Filters\SIGSAS\Domicilio\AsentamientoFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asentamiento extends Model
{

    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'asentamientos';

    protected $fillable = [
        'id', 'asentamiento','nomenclatura',
    ];
    protected $hidden = ['deleted_at','created_at','updated_at'];

    public function scopeFilterBy($query, $filters){
        return (new AsentamientoFilter())->applyTo($query, $filters);
    }

    public static function findOrImport($asentamiento){
        $obj = static::where('asentamiento', $asentamiento)->first();
        if (!$obj) {
            $obj = static::create([
                'asentamiento' => strtoupper($asentamiento),
            ]);
        }
        return $obj;
    }


}
