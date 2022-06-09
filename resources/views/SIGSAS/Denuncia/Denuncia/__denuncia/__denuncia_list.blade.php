<div class="row" style="width: 100% !important;">
    <div class="col-lg-12">

        <table id="dataTable" class="d-style w-100 table text-dark-m1 text-95 border-y-1 brc-black-tp11 collapsed dtr-table dataTable" >
            <thead class="sticky-nav text-secondary-m1 text-uppercase text-85">
            <tr>
                <th class="td-toggle-details border-0 bgc-white shadow-sm">ID</th>
{{--                <th class="sorting">ID</th>--}}
                <th class="sorting">Ciudadano</th>
                <th class="sorting">Fecha</th>
{{--                <th class="sorting">Área</th>--}}
{{--                <th class="sorting">Resp.</th>--}}
                <th class="sorting">Estatus</th>
                <th class="sorting">Servicio</th>
                <th class="sorting">Ubicación</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($items as $item)
                <tr class="@if($item->cerrado) bg-coral-denuncia-cerrada @endif">
                    <td>{{$item->id}}</td>
                    <td>{{$item->ciudadano->FullName}} </td>
                    <td>{{($item->fecha_ingreso)}}</td>
                    <td class="w-6">
                        <div class="pos-rel d-flex">
                            <span class=" m-0 p-0  mr-3px">
                                {{( $item->ultimo_estatus )}}
                            </span>
                            @if($item->TotalRespuestas > 0)
                            <span class="badge ml-auto bgc-red-d2 text-white radius-round  px-25">
									{{($item->TotalRespuestas)}}
								</span>
                            @endif
                        </div>
                    </td>
                    <td class="w-25">{{($item->servicio->servicio)}}</td>
                    <td class="w-75">{{$item->fullUbication}}</td>
                    <td class="table-action w-25">
                        <div class="button-list">
                            @if($item->cerrado == false && $item->firmado == false)
                                @include('SIGSAS.xFiles.UI_Kit.__remove_item')
            {{--                    @include('shared.ui_kit.__respuestas_list_item')--}}
                                @include('SIGSAS.xFiles.UI_Kit.__imagenes_list_item')
                                @if( Auth::user()->isPermission('rsd_sas|consultar|all') )
                                    @include('SIGSAS.xFiles.UI_Kit.__edit_denuncia_dependencia_servicio_item')
                                @endif
                            @endif
                            @if( ($item->cerrado == false && $item->firmado == false) &&
                                 auth()->user()->can('elimina_denuncia_general') )
                                @include('SIGSAS.xFiles.UI_Kit.__remove_item')
                            @endif
                            @include('SIGSAS.xFiles.UI_Kit.__edit_item')
                            @include('SIGSAS.xFiles.UI_Kit.__print_denuncia_item')
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
