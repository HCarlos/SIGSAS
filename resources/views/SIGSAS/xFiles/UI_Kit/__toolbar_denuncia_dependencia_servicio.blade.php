
<div class="button-list pt-2 pb-0 mr-4 mb-2">
    @isset($newItem)
        <a href="{{route($newItem,['Id'=>$Id])}}"  @isset($newWindow) @endisset class="btn btn-icon btn-outline-warning ml-1 btn-rounded " data-toggle="tooltip" data-placement="top" data-original-title="Agregar Dependencia a Denuncia">
            <i class="fas fa-plus"></i> Agregar Dependencia
        </a>
    @endisset
    @isset($showProcess1)
        <a href="{{ route($showProcess1)}} " @isset($newWindow)  @endisset class="btn btn-icon btn-outline-success ml-1 btn-rounded btnGetItems" data-toggle="tooltip" data-placement="top" data-original-title="Exportar a XLSX">
            <i class="fas fa-file-excel"></i> Exportar a MS Excel
        </a>
    @endisset
    @isset($showModalSearchDenuncia)
        <span data-toggle="modal" data-target="#modalFull" >
            <a href="{{route($showModalSearchDenuncia)}}" id="{{$showModalSearchDenuncia}}" class="btn btn-icon btn-outline-primary ml-1 btn-rounded btnFullModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Búsqueda Avanzada">
                <i class="fas fa-search"></i> Buscar
            </a>
        </span>
    @endisset

        <a href="#" class="btn btn-icon btn-outline-info ml-1 btn-rounded float-right" data-toggle="tooltip" data-placement="top" data-original-title="Actualizar" onclick="window.location.reload(true);">
            <i class="fas fa-sync-alt"></i> Refrescar pantalla
        </a>

</div>
