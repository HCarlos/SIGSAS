@extends(Auth::user()->Home)

@section('body-home')

    @component('components.catalogo')

        @slot('buttons')
            @include('SIGSAS.xFiles.UI_Kit.__menu_denuncia_dependencia_servicio')
        @endslot
        @slot('body_catalogo')
            @include('SIGSAS.Denuncia.Denuncia_Dependencia_Servicio.__denuncia_dependencia_servicio.__denuncia_dependencia_servicio_list')
        @endslot

    @endcomponent

@endsection

