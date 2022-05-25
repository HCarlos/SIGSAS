@extends(Auth::user()->Home)

@section('body-home')

@component('components.catalogo')
    @slot('buttons')
        @include('SIGSAS.xFiles.UI_Kit.__menu_catalogo')
    @endslot
    @slot('body_catalogo')
        <div class="col-md-12">
            @include('SIGSAS.Estructura.prioridad.__prioridad.__prioridad_list')
        </div>
    @endslot
@endcomponent

@endsection
