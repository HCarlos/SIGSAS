 @extends(Auth::user()->Home)

@section('body-home')

    @component('components.catalogo')
        @slot('buttons')
            @include('SIGSAS.xFiles.UI_Kit.__menu_denuncia_ciudadana')
        @endslot
        @slot('body_catalogo')
            @include('SIGSAS.Denuncia.Denuncia_Ciudadana.__denuncia_ciudadana.__denuncia_ciudadana_list')
        @endslot
    @endcomponent

@endsection

