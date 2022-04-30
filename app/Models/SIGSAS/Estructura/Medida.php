<?php

namespace App\Models\SIGSAS\Estructura;

use App\Filters\SIGSAS\Estructura\MedidaFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medida extends Model
{
    use SoftDeletes;

    protected $guard_name = 'web';
    protected $table = 'medidas';

    protected $fillable = [
        'id', 'medida',
    ];

    public function scopeFilterBy($query, $filters){
        return ( new MedidaFilter())->applyTo($query, $filters);
    }
    protected $hidden = ['deleted_at','created_at','updated_at'];

    public static function findOrImport($medida){
        $obj = static::where('medida', trim($medida))->first();
        if (!$obj) {
            $obj = static::create([
                'medida' => strtoupper(trim($medida)),
            ]);
        }
        return $obj;
    }



}
