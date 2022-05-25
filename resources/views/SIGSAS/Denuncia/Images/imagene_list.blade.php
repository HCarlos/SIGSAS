@extends(Auth::user()->Home)

@section('body-home')

    @component('components.catalogo')

        @slot('buttons')
            @include('SIGSAS.xFiles.UI_Kit.__menu_imagene')
        @endslot
        @slot('body_catalogo')
            @include('SIGSAS.Denuncia.Images.__images.__imagene_list')
        @endslot

    @endcomponent

@endsection

