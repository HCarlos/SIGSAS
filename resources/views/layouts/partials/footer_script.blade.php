<!-- include common vendor scripts used in demo pages -->
<script src="{{ asset('node_modules/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('node_modules/popper.js/dist/umd/popper.js') }}"></script>
<script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.js') }}"></script>


<!-- include vendor scripts used in "Dashboard" page. see "/views//pages/partials/dashboard/@vendor-scripts.hbs" -->
<script src="{{ asset('node_modules/chart.js/dist/Chart.js') }}"></script>


<script src="{{ asset('node_modules/sortablejs/Sortable.js') }}"></script>

<!-- include ace.js -->
<script src="{{ asset('dist/js/ace.js') }}"></script>



<!-- demo.js is only for Ace's demo and you shouldn't use it -->
<script src="{{ asset('app/browser/demo.js') }}"></script>

<!-- "Dashboard" page script to enable its demo functionality -->
<script src="{{ asset('views/pages/dashboard/@page-script.js') }}"></script>
