@extends('front.layouts.main')

@section('main')
    <div class="custom_container_fluid">
        <ul class="bread_crumb">
            <li>
                <span>Flower place</span>
            </li>
            <li>
                <span class="active">/ Скидки</span>
            </li>
        </ul>
        <div class="page_head_block">
            <h1 class="title_head">Скидки</h1>
            <p>Только у нас самые выгодные цены</p>
        </div>
        <section class="sale_section">
            <select name="#" class="select_filter">
                <option value="#">Сначала новые</option>
                <option value="#">Сначала новые2</option>
                <option value="#">Сначала новые3</option>
            </select>
            @forelse($collections as $collection)
                <div class="sale_block">
                    <div class="block_head">
                        <span class="title_block">{{ $collection->name }}</span>
                        <a href="{{ route("menu.collection",["collection" => $collection->slug]) }}" class="show_all_sales">Посмотреть все</a>
                    </div>
                    <div class="block_items product_slider_popup">
                        @forelse($collection->products->take(4) as $product)
                            <div class="item">
                            <div class="img">
                                <img src="{{ url("/storage/products/thumb_". $product->image) }}" alt="#" />
                                <div class="rating">
                                    <span>4,2</span>
                                    <img src="/assets/images/icons/star.svg" alt="#" />
                                </div>
                                <div class="sale">
                                    <img src="/assets/images/icons/saleBg.svg" alt="#" />
                                    <span>{{ $collection?->discount?->percent }}%</span>
                                </div>
                                <div class="bottom_actions">
                                    <add-to-favorite  :product='@json($product)' :url='@json(route("menu.collection",["collection" => $collection->slug]) ."/". $product->slug)'>
                                        <button type="button" class="btn_action_cr">
                                            <img src="/assets/images/icons/heart.svg" alt="#" />
                                        </button>
                                    </add-to-favorite>
                                    <add-to-card :product='@json($product)'>
                                        <button type="button" class="btn_action_cr">
                                            <img src="/assets/images/icons/basket.svg" alt="#" />
                                        </button>
                                    </add-to-card>
                                    <button
                                        type="button"
                                        class="btn_action_cr show_btn"
                                        href="{{ url("/storage/products/thumb_". $product->image) }}"
                                    >
                                        <img src="/assets/images/icons/eyeVisible.svg" alt="#" />
                                    </button>
                                </div>
                            </div>
                            <div class="content">
                                <h3 class="content_title">{{ $product->name }}</h3>
                                <span class="price_product_sale">{{ $product->price }} руб</span>
                                <span class="price_product">{{ get_product_price($product->price, $collection?->discount?->percent) }} руб.</span>
                                <a href="{{ route("menu.collection",["collection" => $collection->slug]) ."/". $product->slug }}" class="order_btn">Заказать</a>
                            </div>
                        </div>
                            @empty
                        @endforelse
                    </div>
                    <div class="block_foot">
                        <span>Срок действия скидки :</span>
                        <span class="date">{{ $collection->discount->start_date->format("Y.m.d") }} - {{ $collection->discount->end_date->format("Y.m.d") }}</span>
                    </div>
                </div>
                @empty
            @endforelse
        </section>
    </div>
@endsection
