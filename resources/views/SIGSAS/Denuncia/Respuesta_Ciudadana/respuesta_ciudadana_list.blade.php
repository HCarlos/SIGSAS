@extends(Auth::user()->Home)

@section('body-home')

    @component('components.catalogo')

        @slot('buttons')
            @include('SIGSAS.xFiles.UI_Kit.__menu_respuesta')
        @endslot
        @slot('body_catalogo')
            @include('SIGSAS.Denuncia.Respuesta_Ciudadana.__respuesta_ciudadana.__respuesta_ciudadana_list')
        @endslot

    @endcomponent

@endsection

