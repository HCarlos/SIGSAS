@extends(Auth::user()->home)

@section('body-home')

    @component('components.catalogo')
        @slot('buttons')
            @include('SIGSAS.xFiles.UI_Kit.__menu_denuncia')
        @endslot
        @slot('body_catalogo')
            @include('SIGSAS.Denuncia.Denuncia.__denuncia.__denuncia_list')
        @endslot
    @endcomponent

@endsection

