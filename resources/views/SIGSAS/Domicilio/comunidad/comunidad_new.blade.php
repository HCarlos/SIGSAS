@extends(Auth::user()->Home)

@section('container')

@component('components.home')
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Nuevo')
    @slot('contenido')
        <div class="col-md-8">
            @component('components.card')
                @slot('titulo_catalogo',$titulo_catalogo ?? '')
                @slot('title_card', $titulo_header ?? '')
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
                    <form method="POST" action="{{ route('createComunidad') }}" id="frmComunidad">
                        @csrf
                        @include('SIGSAS.Domicilio.comunidad.__comunidad.__comunidad_new')
                        @include('SIGSAS.xFiles.UI_Kit.__button_form_normal')
                    </form>
                @endslot
            @endcomponent
        </div>
    @endslot
@endcomponent

@endsection
