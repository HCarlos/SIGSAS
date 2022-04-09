<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 26/11/18
 * Time: 01:22 PM
 */

namespace App\Filters\Catalogo;


use App\Filters\Common\QueryFilter;

class ServicioFilter extends QueryFilter
{
    public function rules(): array{
        return [
            'search' => '',
        ];
    }

    public function search($query, $search){
        if (is_null($search) || empty ($search) || trim($search) == "") {return $query;}
        $search = strtoupper($search);
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("UPPER(servicio) like ?", "%{$search}%")
                ->orWhereHas('subareas', function ($q) use ($search) {
                    $q->whereRaw("UPPER(subarea) like ?", "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%");
        });
//        ->orWhereHas('medidas', function ($q) use ($search) {
//            $q->whereRaw("UPPER(medida) like ?", "%{$search}%");
//        })


    }
}
