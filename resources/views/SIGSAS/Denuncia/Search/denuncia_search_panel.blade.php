@component('components.tools.form-full-modal-search')
    @slot('metodo','POST')
    @slot('action','findDataInDenuncia')
    @slot('_csrf')
        @csrf
        {{method_field('PUT')}}
    @endslot
    @slot('titulo_full_modal',"Búsqueda de denuncia")
    @slot('body_full_modal')
        @include('SIGSAS.Denuncia.Search.__search.__search_denuncia_in_list')
    @endslot
@endcomponent
