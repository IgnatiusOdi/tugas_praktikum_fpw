@extends('layouts.main')

@section('main')
    @include('includes.navigation')
    <div class="flex">
        @yield('content')
    </div>
@endsection
