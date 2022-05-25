@extends(Auth::user()->Home)

@section('body-home')

@component('components.denuncia')
    @slot('contenido')
            @component('components.card')
                @slot('title_card','')
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
                    <form method="POST" action="{{ route($postNew) }}">
                        @csrf
                        @include('SIGSAS.Denuncia.Denuncia_Dependencia_Servicio.__denuncia_dependencia_servicio.__denuncia_dependencia_servicio_edit')
                        @component('components.tools.buttons-form-denuncia')
                            @slot('msgLeft',' ')
                        @endcomponent
                    </form>
                @endslot
            @endcomponent
    @endslot
@endcomponent

@endsection
