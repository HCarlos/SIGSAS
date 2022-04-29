<form autocomplete="off" class="border-t-3 brc-blue-m2">
    <table class="d-style w-100 table text-dark-m1 text-95 border-y-1 brc-black-tp11 collapsed dtr-table dt-responsive dataTable nowrap" role="grid" aria-describedby="datatable-buttons_info"  width="100%" >
        <thead class="text-secondary-m1 text-uppercase text-85">
        <tr>
            <th class="td-toggle-details border-0 bgc-white shadow-sm">
                <i class="fa fa-angle-double-down ml-2"></i>
            </th>
            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">ID</th>
            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Username</th>
            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Nombre Completo</th>
            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">CURP</th>
            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Roles</th>
            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm">Ubicaciones</th>
            <th class="border-0 bgc-white bgc-h-yellow-l3 shadow-sm"></th>
        </tr>
        </thead>
        <tbody class="pos-rel">
            @foreach($items as $item)
            <tr class="d-style bgc-h-default-l4">
                <td class="td-toggle-details pos-rel">{{$item->id}}</td>
                <td class="pl-3 pl-md-4 align-middle pos-rel">{{$item->username}}</td>
                <td>{{($item->FullName)}}</td>
                <td>{{($item->curp)}}</td>
                <td>
                    @foreach($item->roles as $role)
                        <span class="badge badge-primary">{{$role->name ?? 'none'}}</span>
                        @if($role->name=="ENLACE")
                            <b class="{{ isset($item->dependencias->first()->abreviatura) ? '' : 'badge badge-danger' }}">
                                {{$item->dependencias->first()->abreviatura ?? 'none'}}
                            </b>
                        @endif
                    @endforeach
                </td>
                <td class="text-right">{{($item->ubicacion_id)}}</td>
                <td class="table-action w-100">
                    <div class="button-list w-100">
                        @include('SIGSAS.xFiles.UI_Kit.__edit_item')
                        @if (Auth::user()->hasRole('Administrator'))
                            @include('SIGSAS.xFiles.UI_Kit.__remove_item')
                        @endif
                        {{--                                @include('shared.ui_kit.__edit_item_becas')--}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
