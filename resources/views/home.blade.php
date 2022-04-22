@extends('layouts.app_auth')
@section('content')
    @include('layouts.partials.navbar')
    @include('layouts.partials.left_sidebar')
    <div class="main-content">
        @yield('body-home')
    </div>
@endsection
