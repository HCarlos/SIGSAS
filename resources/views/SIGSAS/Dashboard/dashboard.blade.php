{{--@extends(Auth::user()->Home)--}}
{{--@section('body-home')--}}
{{--    @include('layouts.partials.__dashboard.__dashboard')--}}
{{--@endsection--}}


@extends('layouts.app_auth')
@section('content')
    @include('layouts.partials.__dashboard.__dashboard')
@endsection
