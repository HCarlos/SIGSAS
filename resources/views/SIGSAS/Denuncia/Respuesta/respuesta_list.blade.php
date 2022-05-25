@extends(Auth::user()->Home)

@section('body-home')

    @component('components.catalogo')

        @slot('buttons')
            @include('SIGSAS.xFiles.UI_Kit.__menu_respuesta')
        @endslot
        @slot('body_catalogo')
            @include('SIGSAS.Denuncia.Respuesta.__respuesta.__respuesta_list')
        @endslot

    @endcomponent

@endsection

