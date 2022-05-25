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
                    <form method="POST" action="{{ route('updateEstatu') }}">
                        @csrf
                        {{method_field('PUT')}}
                        @include('SIGSAS.Estructura.estatu.__estatu.__estatu_edit')
                        @include('SIGSAS.xFiles.UI_Kit.__button_form_normal')
                    </form>
                @endslot
            @endcomponent
        </div>
    @endslot
@endcomponent

@endsection

@section('script_interno')
    <script type="text/javascript">
        $(".depToStatus").on('click',function (event) {
            var arrItem = event.currentTarget.id.split('-');
            var Url   = arrItem[0];
            var Id    = arrItem[1];
            var IdDep = arrItem[2] == 999 ? $("#dependencia_id").val() : arrItem[2];
            if (IdDep > 0){
                $.get( "/"+Url+"/"+Id+"/"+IdDep , function( data ) {
                    data.mensaje === "OK" ? document.location.href = '/editEstatu/'+Id : alert(data.mensaje);
                }, "json" );
            }
        })
    </script>
@endsection
