{{--<div class="button-list">--}}
{{--    @php $IsModal = $IsModal ?? false @endphp--}}
{{--    @php $IsModalNew = $IsModalNew ?? false @endphp--}}
{{--    @if( !$IsModal && !$IsModalNew )--}}
{{--        @isset($newItem)--}}
{{--            <a href="{{route($newItem)}}"  @isset($newWindow) @endisset class="btn btn-icon btn-rounded btn-outline-light"> <i class="fas fa-plus"></i> Nuevo</a>--}}
{{--        @endisset--}}
{{--    @else--}}
{{--        @isset($newItem)--}}
{{--            <a href="{{route($newItem)}}"  @isset($newWindow) @endisset id="{{route($newItem)}}" class="btn btn-icon btn-rounded btn-outline-light btnFullModal" data-toggle="modal" data-target="#modalFull"> <i class="fas fa-plus"></i> Nuevo</a>--}}
{{--        @endisset--}}
{{--    @endisset--}}
{{--    @isset($showProcess1)--}}
{{--        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Administrator|SysOp'))--}}
{{--            <a href="{{route($showProcess1)}}" @isset($newWindow)  @endisset class="btn btn-icon btn-rounded btn-outline-success btnFilters"> <i class="fas fa-file-excel text-white"></i> Exportar a Excel</a>--}}
{{--        @endif--}}
{{--    @endisset--}}
{{--    @isset($exportModel)--}}
{{--        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Administrator|SysOp'))--}}
{{--            <a href="{{route('getModelListXlS',['model'=>$exportModel])}}" @isset($newWindow) @endisset class="btn btn-icon btn-rounded btn-outline-info btnFilters"> <i class="fas fa-file-excel text-white"></i> Exportar Modelo a Excel</a>--}}
{{--        @endif--}}
{{--    @endisset--}}

{{--</div>--}}

{{--<div class="sidebar-section-item fadeable-left">--}}
{{--    <div class="fadeinable sidebar-shortcuts-mini">--}}
{{--        <span class="btn btn-success p-0 opacity-1"></span>--}}
{{--        <span class="btn btn-info p-0 opacity-1"></span>--}}
{{--        <span class="btn btn-orange p-0 opacity-1"></span>--}}
{{--        <span class="btn btn-danger p-0 opacity-1"></span>--}}
{{--    </div>--}}



        <div class="button-list pt-2 pb-0">
                @php $IsModal = $IsModal ?? false @endphp
                @php $IsModalNew = $IsModalNew ?? false @endphp
                @if( !$IsModal && !$IsModalNew )
                    @isset($newItem)
                        <a href="{{route($newItem)}}"  @isset($newWindow) @endisset  class="btn btn-icon btn-outline-warning ml-1 btn-rounded " data-toggle="tooltip" data-placement="top" data-original-title="Nuevo">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    @endisset
                @else
                    @isset($newItem)
                        <a href="{{route($newItem)}}"  @isset($newWindow) @endisset id="{{route($newItem)}}"  class="btn btn-icon btn-outline-warning ml-1 btn-rounded  btnFullModal" data-toggle="modal" data-target="#modalFull" title="Nuevo">
                            <i class="fas fa-plus"></i>
                        </a>
                    @endisset
                @endisset
                @isset($showProcess1)
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Administrator|SysOp'))
                        <a href="{{route($showProcess1)}}" @isset($newWindow)  @endisset class="btn btn-icon btn-outline-success ml-1 btn-rounded btnGetItems" data-toggle="tooltip" data-placement="top" data-original-title="Exportar a MS Excel">
                            <i class="fas fa-file-excel"></i> Exportar a MS Excel
                        </a>
                    @endif
                @endisset
                @isset($exportModel)
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Administrator|SysOp'))
                        <a href="{{route('getModelListXlS',['model'=>$exportModel])}}" @isset($newWindow) @endisset class="btn btn-icon btn-outline-orange ml-1 btn-rounded btnFilters" title="Exportar modelo a MS Excel">
                            <i class="fas fa-file-excel"></i> Exportar modelo a MS Excel
                        </a>
                    @endif
                @endisset

        </div>
{{--</div>--}}
