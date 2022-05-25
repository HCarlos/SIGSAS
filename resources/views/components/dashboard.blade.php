@extends('layouts.app')

@section('content')

    <body>
    <div class="wrapper">
        @include('layouts.partials.left_sidebar')
        <div class="content-page">
            <div class="content">
                @include('layouts.partials.navbar')
                <div class="container-fluid home">
                    @yield('container')
                </div>
                <!-- container -->
            </div>
        </div>
        <!-- content -->
{{--        @include('layouts.partials.footer_script')--}}
    </div>

{{--    @include('layouts.partials.full_modal')--}}
{{--    @include('layouts.partials.footer_script')--}}

    </body>

@endsection
