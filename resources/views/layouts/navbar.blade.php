@extends('layouts.master')

@section('main')
    @include('partials.logout')

    @include('partials.navbar')

    <div class="container py-5 min-vh-100">
        @yield('content')
    </div>

    @include('partials.footer')
@stop
