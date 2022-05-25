@extends(Auth::user()->Home)

@section('body-home')

    @component('components.form.form-dropzone')

        @slot('metodo','POST')
        @slot('action','saveImagenAImagenDen')
        @slot('_csrf')
            @csrf
            {{--{{method_field('PUT')}}--}}
        @endslot
        @slot('titulo_dropzone',"Subir Imágenes")
        @slot('body_full_modal')
            @include('SIGSAS.Denuncia.Images.__images.__imagene_upload')
        @endslot
        @slot('removeItem',$removeItem)

    @endcomponent

@endsection
