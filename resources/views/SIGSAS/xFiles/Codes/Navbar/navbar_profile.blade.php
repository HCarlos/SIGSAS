<li class="nav-item dropdown order-first order-lg-last">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img id="id-navbar-user-image" class="mr-3 d-none d-sm-block avatar-sm rounded-circle border-2 brc-white-tp1 mr-2 " src="{{ Auth::user()->PathImageThumbProfile }}?timestamp='{{ now() }}'" alt="{{Auth::user()->username}}"  width="40" height="40">
        <span class="d-inline-block d-lg-none d-xl-inline-block">
            <span class="text-90" id="id-user-welcome">
                    <small class="text-overflow m-0">
                        @if( Auth::user()->IsFemale() )
                            Bienvenida!
                        @else
                            Bienvenido!
                        @endif
                    </small>
            </span>
            <span class="nav-user-name">{{ Auth::user()->username }}</span>
        </span>

        <i class="caret fa fa-angle-down d-none d-xl-block"></i>
        <i class="caret fa fa-angle-left d-block d-lg-none"></i>
    </a>

    <div class="dropdown-menu dropdown-caret dropdown-menu-right dropdown-animated brc-primary-m3 py-1">
        <div class="d-none d-lg-block d-xl-none">
            <div class="dropdown-header">
                {{ Auth::user()->username }}
            </div>
            <div class="dropdown-divider"></div>
        </div>

{{--        <div class="dropdown-clickable px-3 py-25 bgc-h-secondary-l3 border-b-1 brc-secondary-l2">--}}
{{--            <div class="d-flex justify-content-center align-items-center tex1t-600">--}}
{{--                <label for="id-user-online" class="text-grey-d1 pt-2 px-2">desconectado</label>--}}
{{--                <input type="checkbox" class="ace-switch ace-switch-sm text-grey-l1 brc-green-d1" id="id-user-online" />--}}
{{--                <label for="id-user-online" class="text-green-d1 text-600 pt-2 px-2">conectado</label>--}}
{{--            </div>--}}
{{--        </div>--}}

        <a class="mt-1 dropdown-item btn btn-outline-grey bgc-h-primary-l3 btn-h-light-primary btn-a-light-primary" href="html/page-profile.html">
            <i class="fa fa-user text-primary-m1 text-105 mr-1"></i>
            Perfil
        </a>

        <a class="dropdown-item btn btn-outline-grey bgc-h-success-l3 btn-h-light-success btn-a-light-success" href="#" data-toggle="modal" data-target="#id-ace-settings-modal">
            <i class="fa fa-key text-success-m1 text-105 mr-1"></i>
            Password
        </a>

        <a class="dropdown-item btn btn-outline-grey bgc-h-orange-l3 btn-h-light-orange btn-a-light-orange" href="#" data-toggle="modal" data-target="#id-ace-settings-modal">
            <i class="fa fa-image text-orange-m1 text-105 mr-1"></i>
            Imagen
        </a>

        <div class="dropdown-divider brc-primary-l2"></div>

        <a class="dropdown-item btn btn-outline-grey bgc-h-danger-l3 btn-h-light-danger btn-a-light-danger" href="{{ route('logout') }}">
            <i class="fa fa-power-off text-danger-d1 text-105 mr-1"></i>
            Cerrar Sesión
        </a>
    </div>
</li><!-- /.nav-item:last -->
