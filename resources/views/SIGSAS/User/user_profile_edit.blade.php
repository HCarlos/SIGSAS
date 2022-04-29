@extends(Auth::user()->Home)
@section('body-home')
@component('components.home')
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Perfil')
    @slot('contenido')
        <div class="col-md-4">
            @include('SIGSAS.User.__User.__user_photo_header')
        </div> <!-- end col-->

        <div class="col-md-8">
            <!-- Chart-->
            @component('components.card')
                @slot('title_card',$user->FullName)
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
                    <form method="POST" action="{{ route('updateUser') }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include('SIGSAS.User.__User.__user_edit')
                        @include('SIGSAS.xFiles.UI_Kit.__button_form_normal')
                    </form>
                @endslot
            @endcomponent
        </div>
    @endslot
@endcomponent


@endsection


@section("scripts")
{{--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
{{--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
{{--    <script src="{{asset('/js/servimun.autocomplete.js')}}?time()"></script>--}}
{{--    <script >--}}
{{--        jQuery(function($) {--}}
{{--            $(document).ready(function () {--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
@endsection
