@extends(Auth::user()->Home)

@section('body-home')

@component('components.home')
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Usuario')
    @slot('contenido')

        <div class="col-md-12">
            @component('components.card')
                @slot('titulo_catalogo',$titulo_catalogo ?? '')
                @slot('title_card', $titulo_header ?? '')
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
                    <form method="POST" action="{{ route('createUser') }}">
                        @csrf
                        @include('SIGSAS.User.__User.__user_new')
                        @include('SIGSAS.xFiles.UI_Kit.__button_form_normal')
                    </form>
                @endslot
            @endcomponent
        </div>
    @endslot
@endcomponent

@endsection
