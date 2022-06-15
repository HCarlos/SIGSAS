
<div class="navbar-content d-xl-flex flex-grow-0 flex-lg-grow-1 float-right mr-2">
    @if(  isset($searchTopBar) )
        <form method="get"  action="{{ route($searchTopBar) }}" class="form-inline frmGetItems float-right" data-toggle="tooltip" title="Buscar...">
            <div class="collapse navbar-collapse navbar-backdrop" id="navbarSearch">
                <div class="d-flex align-items-center pl-4 py-1 py-lg-0">
                    <input type="search" id="search" name="search" value="{{ request('search') }}" class="navbar-input pl-45 pr-3 py-3 py-lg-2 ml-n3 ml-lg-n4 bgc-black-tp7 radius-round border-0 w-100 h-auto autofocus"  placeholder="Buscar por: Denuncia, Referencia, Calle, Colonia, Localidad" title="Buscar por: {{$searchTopBarLabels}}">
                    <button class="btn btn-sm " type="submit">
                        <i class="fab fa-searchengin text-white fa-lg"></i>
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>
