<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts.partials.header_script')
</head>
<body >
    @auth()
        @include('layouts.partials.navbar')
        <div class="main-container">
            @include('layouts.partials.left_sidebar')
            <div class="main-content " >
{{--                <div class="page-content " >--}}
                    @yield('content')
{{--                </div>--}}
            </div>
        </div>
    @else
        @yield('content')
    @endauth


{{--<div class="modal fade " id="modalFull" data-backdrop-bg="bgc-grey-tp4" data-blur="true" tabindex="-1" role="dialog" aria-labelledby="modalFull" aria-hidden="true"  >--}}
{{--    <div class="modal-dialog " role="document"  >--}}
{{--        <div class="modal-content border-0 shadow radius-1"  >--}}
{{--            @yield('ModalBlurred')--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="modal fade " id="modalFullScreen" tabindex="-1" role="dialog" data-backdrop-bg="bgc-grey-tp4"  data-blur="true"  aria-labelledby="modalFullScreen" aria-hidden="true">--}}
{{--    <div class="modal-dialog " role="document"  >--}}
{{--        <div class="modal-content border-0 shadow radius-1"  style="width: 800px !important;">--}}
{{--            @yield('ModalBlurredFS')--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@include('layouts.partials.full_modal')

@include('layouts.partials.footer_script')

</body>
</html>
