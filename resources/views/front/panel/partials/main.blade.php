@extends('front.layouts.app')

@section('css')

@endsection

@section('content')
    <main>
        <div class="custom_container_fluid">
            <div class="page_head_block">
                <h1 class="title_head">
                    Добро пожаловать! Ваша регистрация пройдена успешна
                </h1>
            </div>
            <div class="cabinet_block">
                @include("front.panel.partials.menu")
                @yield('page')
            </div>
        </div>
        <card-component></card-component>
    </main>
@endsection

@section('js')

@endsection
