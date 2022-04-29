{{--<div class="navbar-content">--}}
{{--    <button class="navbar-toggler py-2" type="button" data-toggle="collapse" data-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle navbar search">--}}
{{--        <i class="fa fa-search text-white text-90 py-1"></i>--}}
{{--    </button><!-- mobile #navbarSearch toggler -->--}}

{{--    <div class="collapse navbar-collapse navbar-backdrop" id="navbarSearch">--}}
{{--        <form class="d-flex align-items-center ml-lg-4 py-1" data-submit="dismiss">--}}
{{--            <i class="fa fa-search text-white d-none d-lg-block pos-rel"></i>--}}
{{--            <input type="text" class="navbar-input mx-3 flex-grow-1 mx-md-auto pr-1 pl-lg-4 ml-lg-n3 py-2 autofocus" placeholder="BUSCAR ..." aria-label="Search" />--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="navbar-content d-xl-flex flex-grow-0 flex-lg-grow-1 float-right mr-2">
{{--    @if(  isset($listItems) )--}}
{{--        <form method="get" action="{{route($listItems)}}"  data-toggle="tooltip" title="Buscar...">--}}
            <form method="get"  action="/userList" data-toggle="tooltip" title="Buscar...">
            <div class="collapse navbar-collapse navbar-backdrop" id="navbarSearch">
                <div class="d-flex align-items-center pl-4 py-1 py-lg-0">
                    <input type="search" id="search" name="search" value="{{ request('search') }}" class="navbar-input pl-45 pr-3 py-3 py-lg-2 ml-n3 ml-lg-n4 bgc-black-tp7 radius-round border-0 w-100 h-auto autofocus" placeholder="Buscar...">
                    <button class="btn btn-sm " type="submit">
                        <i class="fab fa-searchengin text-white fa-lg"></i>
                    </button>
                </div>
            </div>
        </form>
{{--    @endif--}}
</div>
