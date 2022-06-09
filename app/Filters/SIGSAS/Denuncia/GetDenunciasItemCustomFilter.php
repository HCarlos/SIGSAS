<?php
/*
 * Copyright (c) 2021. Realizado por Carlos Hidalgo
 */

namespace App\Filters\SIGSAS\Denuncia;

use App\Filters\Common\QueryFilter;
use Illuminate\Support\Facades\Auth;

class GetDenunciasItemCustomFilter extends QueryFilter{


    public function rules(): array{
        return [
            'filterdata' => ''
        ];
    }

    public function filterdata($query, $search){
        $search = isset($search['search']) ? $search['search'] : '';
        $search = strtoupper($search);
        $filters['dependencia_id'] = config("sigsas.sas_id");
        $filters['search'] = $search;

        return $query->filterBy($filters);

    }


}
