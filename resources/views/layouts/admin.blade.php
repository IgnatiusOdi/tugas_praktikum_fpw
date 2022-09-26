@extends('layouts.main')

@section('main')
    <div class="flex">
        @include('includes.sidebar')
        @yield('content')
    </div>
@endsection
