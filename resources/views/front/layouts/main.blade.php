@extends('front.layouts.app')

@section('content')
    <main>

        @yield('main')

        <mini-card-component></mini-card-component>

        <card-component></card-component>
    </main>
@endsection
