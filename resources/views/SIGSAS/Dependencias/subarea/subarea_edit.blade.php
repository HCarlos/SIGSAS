@extends(Auth::user()->Home)

@section('body-home')

@component('components.home')

    @slot('titulo_catalogo',$titulo_catalogo)
    @slot('titulo_header','Editando el registro '. $items->id)
    @slot('contenido')
        <div class="col-md-8">
            <!-- Chart-->
            @component('components.card')
                @slot('title_card','')
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
                    <form method="POST" action="{{ route('updateSubarea') }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include('SIGSAS.Dependencias.subarea.__subarea.__subarea_edit')
                        @include('SIGSAS.xFiles.UI_Kit.__button_form_normal')
                    </form>
                @endslot
            @endcomponent
        </div>
    @endslot
@endcomponent

@endsection
