<nav class="navbar navbar-expand-lg navbar-fixed navbar-blue">
    <div class="navbar-inner">

        <div class="navbar-intro justify-content-xl-between">

            <button type="button" class="btn btn-burger burger-arrowed static collapsed ml-2 d-flex d-xl-none"
                    data-toggle-mobile="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false"
                    aria-label="Toggle sidebar">
                <span class="bars"></span>
            </button><!-- mobile sidebar toggler button -->

            <a class="navbar-brand text-white" href="#">
                <i class="fa fa-leaf"></i>
                <span>{{ config('app.name') }}</span>
                <span></span>
            </a><!-- /.navbar-brand -->

            <button type="button" class="btn btn-burger mr-2 d-none d-xl-flex" data-toggle="sidebar"
                    data-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
                <span class="bars"></span>
            </button><!-- sidebar toggler button -->

        </div><!-- /.navbar-intro -->



        <!-- mobile #navbarMenu toggler button -->
        <button class="navbar-toggler ml-1 mr-2 px-1" type="button" data-toggle="collapse" data-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navbar menu">
            <span class="pos-rel">
                  <img class="border-2 brc-white-tp1 radius-round" width="36" src="assets/image/avatar/avatar6.jpg"
                       alt="Jason's Photo">
                  <span class="bgc-warning radius-round border-2 brc-white p-1 position-tr mr-n1px mt-n1px"></span>
            </span>
        </button>


        <div class="navbar-menu collapse navbar-collapse navbar-backdrop" id="navbarMenu">

            @include('SIGSAS.xFiles.Codes.Navbar.navbar_search')

            <div class="navbar-nav">
                <ul class="nav">

                    {{--                    @include('SIGSAS.Codes.navbar_mega')--}}
                    {{--                    @include('SIGSAS.Codes.navbar_notifications')--}}
                    {{--                    @include('SIGSAS.Codes.navbar_tasks')--}}

                    @include('SIGSAS.xFiles.Codes.Navbar.navbar_profile')

                </ul><!-- /.navbar-nav menu -->
            </div><!-- /.navbar-nav -->

        </div><!-- /#navbarMenu -->


    </div><!-- /.navbar-inner -->
</nav>
