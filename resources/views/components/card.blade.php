<div class="card">
    <div class="card-body">

{{--        <h5 class="header-title text-primary mt-0 mb-3">{{$titulo_catalogo ?? ''}}</h5>--}}
{{--        <h5 class="header-title text-secondary mt-0 mb-3">{{$title_card ?? ''}}</h5>--}}

        <div class="card-header bgc-primary-d1">
            <h6 class="card-title text-white font-normal">
                <i class="nav-icon fa fa-table text-130 mr-1"></i>
                <span class="text-110">
                        {{$titulo_catalogo ?? ''}}
                    </span>
{{--                <span class="text-95 d-block d-sm-inline text-center">--}}
{{--                        (6 online)--}}
{{--                    </span>--}}
            </h6>

            <div class="card-toolbar align-self-center text-white text-90 no-border p-2px">
                {{$title_card ?? ''}}
                <div class="typing-dots text-160 text-white mx-md-1">
                    <span class="typing-dot">.</span>
                    <span class="typing-dot">.</span>
                    <span class="typing-dot">.</span>
                </div>
            </div>

{{--            <div class="card-toolbar align-self-center">--}}
{{--                <a href="#" data-action="reload" class="card-toolbar-btn text-white">--}}
{{--                    <i class="fas fa-sync-alt"></i>--}}
{{--                </a>--}}
{{--            </div>--}}

        </div>


        <hr>

        {{$body_card}}
    </div>
</div>

