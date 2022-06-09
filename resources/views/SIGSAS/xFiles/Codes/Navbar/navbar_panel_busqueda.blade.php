<!-- panel de busqueda -->
<div class="dropdown d-inline-block">
    <a class="btn btn-icon btn-outline-info ml-1 btn-rounded" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Buscar algo<i class="fa fa-question mr-2 f-n-hover"></i>
    </a>

    <div style="min-width: 240px;" class="dropdown-menu dropdown-caret px-1px py-2px border-1 brc-default-l1 shadow radius-1 dropdown-animated animated-2">
        <a  href="{{route($showModalSearchDenuncia)}}" id="{{$showModalSearchDenuncia}}" class="active dropdown-item btn btn-outline-lightgrey border-l-3 btn-brc-tp btn-h-lighter-grey btn-h-brc-tp btn-a-outline-primary btn-a-text-dark btn-a-bold m-0 radius-l-0 py-2 px-3 btnFullModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Búsqueda Avanzada">
            <i class="fa fa-search w-3 text-green text-110"></i>
            Panel de Consulta
        </a>

        {{--                    <div class="dropdown-divider my-0"></div>--}}

        {{--                    <a href="#" class="dropdown-item btn btn-outline-lightgrey border-l-3 btn-brc-tp btn-h-lighter-grey btn-h-brc-tp btn-a-outline-primary btn-a-text-dark btn-a-bold m-0 radius-l-0 py-2 px-3">--}}
        {{--                        <i class="far fa-file-pdf w-3 text-danger text-110"></i>--}}
        {{--                        PDF document--}}
        {{--                    </a>--}}

        {{--                    <div class="dropdown-divider my-0"></div>--}}

        {{--                    <a href="#" class="dropdown-item btn btn-outline-lightgrey border-l-3 btn-brc-tp btn-h-lighter-grey btn-h-brc-tp btn-a-outline-primary btn-a-text-dark btn-a-bold m-0 radius-l-0 py-2 px-3">--}}
        {{--                        <i class="far fa-file-word w-3 text-blue text-110"></i>--}}
        {{--                        Word document--}}
        {{--                    </a>--}}

        {{--                    <div class="dropdown-divider my-0"></div>--}}

        {{--                    <a href="#" class="dropdown-item btn btn-outline-lightgrey border-l-3 btn-brc-tp btn-h-lighter-grey btn-h-brc-tp btn-a-outline-primary btn-a-text-dark btn-a-bold m-0 radius-l-0 py-2 px-3">--}}
        {{--                        <i class="far fa-image w-3 text-purple text-110"></i>--}}
        {{--                        JPG image--}}
        {{--                    </a>--}}
    </div>
</div><!-- /.fin panel de búsqueda -->
