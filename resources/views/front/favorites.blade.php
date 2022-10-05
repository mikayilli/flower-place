@extends('front.layouts.main')

@section('css')
@endsection

@section('main')
        <div class="custom_container_fluid">
            <ul class="bread_crumb">
                <li>
                    <span>Flower place</span>
                </li>
                <li>
                    <span>/ Кому</span>
                </li>
                <li>
                    <span>/ Маме</span>
                </li>
                <li>
                    <span class="active">/ Вам понравилось</span>
                </li>
            </ul>
            <div class="page_head_block">
                <h1 class="title_head">Вам понравилось</h1>
            </div>
        </div>
        <favorite-component></favorite-component>
@endsection

@section('js')
@endsection
