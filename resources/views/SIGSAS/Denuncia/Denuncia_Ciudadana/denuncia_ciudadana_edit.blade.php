@extends(Auth::user()->Home)

@section('body-home')

@component('components.denuncia')
{{--    @slot('titulo_catalogo',$titulo_catalogo)--}}
{{--    @slot('titulo_header','Folio: '. $items->id)--}}
    @slot('contenido')
            @component('components.card')
                @slot('title_card','Editando... ')
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
{{--                    @include('shared.search.__search_denuncia_adress_list')--}}
                    <form method="POST" action="{{ route('updateDenuncia') }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include('SIGSAS.Denuncia.Denuncia_Ciudadana.__denuncia_ciudadana.__denuncia_ciudadana_edit')
                        @component('components.tools.buttons-form-denuncia')
                            @slot('msgLeft',' ')
                        @endcomponent
                    </form>
                @endslot
            @endcomponent
    @endslot
@endcomponent

@endsection
