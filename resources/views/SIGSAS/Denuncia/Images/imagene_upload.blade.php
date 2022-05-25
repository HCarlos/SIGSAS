@extends(Auth::user()->Home)

@section('body-home')

    @component('components.form.form-dropzone')

        @slot('metodo','POST')
        @slot('action','saveImageneDen')
        @slot('_csrf')
            @csrf
        @endslot
        @slot('titulo_dropzone',"Subir Imágenes")
        @slot('body_full_modal')
            @include('SIGSAS.Denuncia.Images.__images.__imagene_upload')
        @endslot
        @slot('removeItem',$removeItem)

    @endcomponent

    @endsection

