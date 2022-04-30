
<script src="{{ asset('node_modules/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('node_modules/popper.js/dist/umd/popper.js') }}"></script>
<script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('node_modules/chart.js/dist/Chart.js') }}"></script>
<script src="{{ asset('node_modules/sortablejs/Sortable.js') }}"></script>

<script src="{{ asset('node_modules/free-jqgrid/js/jquery.jqgrid.src.js') }}"></script>
<script src="{{ asset('dist/js/ace.js') }}"></script>
{{--<script src="{{ asset('app/browser/demo.js') }}"></script>--}}
{{--<script src="{{ asset('node_modules/free-jqgrid/js/jquery.jqgrid.src.j') }}s"></script>--}}
{{--<script src="{{ asset('views/pages/cards/@page-script.js') }}"></script>--}}


@yield('scripts')

<script src="{{ asset('js/atemun.js') }}"></script>
<script src="{{ asset('js/servimun.js') }}"></script>
{{--<script src="{{ asset('js/servimun.autocomplete.js') }}"></script>--}}

@yield('script_autocomplete')
