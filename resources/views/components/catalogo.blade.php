@section('styles')
<link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/responsive.dataTables.css') }}" rel="stylesheet" type="text/css" >
@endsection
{{--<div class="page-content  m-0 p-0" style="background-color: #0acf97">--}}
{{--    <div class="page-header m-0 p-0 ">--}}
        {{$buttons}}
{{--    </div>--}}
{{--    <div class="page-body row ">--}}
        {{$body_catalogo}}
{{--    </div>--}}
{{--</div>--}}
@section('scripts')
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
{{--<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>--}}
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/dataTables.keyTable.min.js') }}"></script>
{{--<script src="{{ asset('js/dataTables.select.min.js') }}"></script>--}}
@endsection
