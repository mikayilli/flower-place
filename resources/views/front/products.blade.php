@extends('front.layouts.main')

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
                    <span class="active">/ Маме</span>
                </li>
            </ul>
            <div class="page_head_block">
                <h1 class="title_head">Для любимой мамы</h1>
                <p>
                    Сделайте так, чтобы ваша мама почувствовала себя любимой, удивив ее
                    живыми цветами. В конце концов, она заслуживает самого лучшего.
                </p>
            </div>
            <product-page-component
                :tags='@json($tags)'
                :categories='@json($current_categories)'
                :main-category='@json($main_category)'
                :current-collection='@json($current_collection)'
                :get-params='@json($_GET)'
                :name='@json(request('name'))'
            >

            </product-page-component>
        </div>
@endsection

