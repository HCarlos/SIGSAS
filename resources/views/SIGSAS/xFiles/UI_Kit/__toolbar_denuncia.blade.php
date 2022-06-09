<div class="button-list pt-2 pb-0">
    @isset($newItem)
{{--        @php dd(\Illuminate\Support\Facades\Auth::user()->isPermission('csd_sas|consultar|all')) @endphp--}}
        @if( \Illuminate\Support\Facades\Auth::user()->isPermission('csd_sas|consultar|all') )
            <a href="{{route($newItem)}}" class="btn btn-icon btn-outline-warning ml-1 btn-rounded " data-toggle="tooltip" data-placement="top" data-original-title="Nueva Denuncia">
                <i class="fas fa-plus"></i> Nueva
            </a>
        @endif
    @endisset
    @isset($showProcess1)
        <a href="{{ route($showProcess1)}} " class="btn btn-icon btn-outline-success ml-1 btn-rounded btnGetItems" data-toggle="tooltip" data-placement="top" data-original-title="Exportar a MS Excel">
            <i class="fas fa-file-excel"></i> Exportar consulta a MS Excel
        </a>
    @endisset

    <a href="" class="btn btn-icon btn-outline-secondary ml-1 btn-rounded" data-toggle="tooltip" data-placement="top" data-original-title="Actualizar" onclick="window.location.reload(true);">
        <i class="fas fa-sync-alt"></i> Refrescar
    </a>
    @isset($showModalSearchDenuncia)
        @include('SIGSAS.xFiles.Codes.Navbar.navbar_panel_busqueda')
    @endisset

</div>
