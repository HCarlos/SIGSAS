@extends(Auth::user()->Home)

@section('body-home')

@component('components.home')
    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Nueva')
    @slot('contenido')
        <div class="col-md-8">
            @component('components.card')
                @slot('title_card','')
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
                    <form method="POST" action="{{ route('createCiudad') }}">
                        @csrf
                        @include('SIGSAS.Domicilio.ciudad.__ciudad.__ciudad_new')
                        @include('SIGSAS.xFiles.UI_Kit.__button_form_normal')
                    </form>
                @endslot
            @endcomponent
        </div>
    @endslot
@endcomponent

@endsection
