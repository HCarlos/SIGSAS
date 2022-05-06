@extends(Auth::user()->Home)

@section('body-home')

@component('components.home')
    @slot('titulo_header','Nueva')
    @slot('contenido')
        <div class="col-md-8">
            @component('components.card')
                @slot('titulo_catalogo',$titulo_catalogo)
                @slot('title_card', $titulo_header ?? '')
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
                    <form method="POST" action="{{ route('createUbicacion') }}" id="frmUbicacion">
                        @csrf
                        @include('SIGSAS.Domicilio.ubicacion.__ubicacion.__ubicacion_new')
                        @include('SIGSAS.xFiles.UI_Kit.__button_form_normal')
                    </form>
                @endslot
            @endcomponent
        </div>
    @endslot
@endcomponent

@endsection
