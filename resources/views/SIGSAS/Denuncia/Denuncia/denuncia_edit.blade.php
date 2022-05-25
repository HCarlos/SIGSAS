 @extends(Auth::user()->Home)

@section('body-home')

@component('components.denuncia')
    @slot('contenido')
            @component('components.card')
                @slot('title_card','')
                @slot('body_card')
                    @include('SIGSAS.xFiles.Codes.__errors')
                    <form method="POST" action="{{ route('updateDenuncia') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="formData" id="formData" >
                        @csrf
                        {{ method_field('PUT') }}
                        @include('SIGSAS.Denuncia.Denuncia.__denuncia.__denuncia_edit')
                        @component('components.tools.buttons-form-denuncia')
                            @slot('msgLeft',' ')
                            @slot('item',$items)
                        @endcomponent
                    </form>
                @endslot
            @endcomponent
    @endslot
@endcomponent

@endsection
