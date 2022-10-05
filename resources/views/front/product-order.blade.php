@extends('front.layouts.main')

@section('css')
    <link href="{{ asset('/assets/css/owl.carousel.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/assets/css/owl.theme.default.min.css') }}" rel="stylesheet"/>
    <style>
        .card_label {
            text-transform: none !important;
        }

        .card_label:empty {
            display: none;
        }
    </style>
@endsection

@section('main')
        <div class="custom_container_fluid">
            <ul class="bread_crumb">
                <li>
                    <span>Flower place</span>
                </li>
                <li>
                    <span> / Кому </span>
                </li>
                <li>
                    <span> / Маме </span>
                </li>
                <li>
                    <span class="active">/ Нежность</span>
                </li>
            </ul>
            <div class="page_head_block">
                <h1 class="title_head">{{ $product->name }}</h1>
                <p>
                    {{ $product->short_description }}
                </p>
            </div>
        </div>
        <section class="product_slider_and_info">
            <div class="custom_container_fluid">
                <div class="columns">
                    <div class="left_column">
                        <div class="card">
                            <div class="product-imgs">
                                <div class="img-display">
                                    <div class="product_main_popup img-showcase">
                                        @forelse($product->gallery as $gallery)
                                            <img
                                                href="{{ url('storage/products/gallery/'. $gallery->photo) }}"
                                                class="item"
                                                src="{{ url('storage/products/gallery/'. $gallery->photo) }}"
                                                alt="#"
                                            />
                                        @empty @endforelse

                                    </div>
                                </div>
                                <div class="img-select">
                                    @forelse($product->gallery as $gallery)
                                        <div class="img-item">
                                            <a href="#" data-id="{{$loop->index + 1}}">
                                                <img src="{{ url('storage/products/gallery/thumb_'. $gallery->photo) }}"
                                                     alt="#"/>
                                            </a>
                                        </div>
                                    @empty @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right_column">
                        <div class="rating_and_sale">
                            <div class="rating">
                                <span class="label">Оценка:</span>
                                <div class="stars">
                                    <span class="star_count">4.2</span>
                                    <img src="/assets/images/icons/star-active.svg" alt="#"/>
                                    <img src="/assets/images/icons/star-active.svg" alt="#"/>
                                    <img src="/assets/images/icons/star-active.svg" alt="#"/>
                                    <img src="/assets/images/icons/star-active.svg" alt="#"/>
                                    <img src="/assets/images/icons/star-disable.svg" alt="#"/>
                                </div>
                            </div>
                            @if($product->discount)
                                <span class="sale"> {{$product->discount?->percent}}% скидка </span>
                            @endif
                        </div>
                        <div class="prices">
                                <span class="price">{{get_product_price($product->price, $product?->discount?->percent)}} руб.</span>
                            @if($product->discount)
                                <span class="sale_price">{{$product->price}} руб.</span>
                            @endif

                        </div>
                        @forelse($product->additions as $addition)
                            <div class="card_row">
                                <span class="card_label">{{ $addition[0]->type->description }}</span>
                                <button
                                    type="button"
                                    class="btn_show_card btn_show_slider"
                                    data-id="{{$loop->index}}_slider"
                                >
                                    {{ $addition[0]->type->name }}
                                </button>
                            </div>
                            @if($addition[0]->type->name === 'Выбрать открытку')
                                <!-- commentary -->
                                <div class="added_paper"  style="display: none">
                                    <div class="img">
                                        <img src="/assets/images/img/cardImg1.png" alt="#"/>
                                    </div>
                                    <div class="right">
                                        <span class="title_paper">Ваш комментарий</span>
                                        <p class="desc_paper"></p>
                                    </div>
                                </div>
                            @endif
                            <div class="slider_block" id="{{$loop->index}}_slider">
                                <div class="card_slider owl-carousel">
                                    @forelse($addition as $slider)
                                        <div class="item">
                                            <img src="{{ url("/storage/products/thumb_". $slider->image) }}" alt="#"/>
                                            <div class="overlay">
                                                <span class="title_overlay">{{ $slider->name }}</span>
                                                <div class="buttons_action">
                                                    <a
                                                        class="btn_action"
                                                        href="{{ url("/storage/products/thumb_". $slider->image) }}"
                                                    >
                                                        <img src="/assets/images/icons/eye.svg" alt="#"/>
                                                    </a>
                                                    <add-addition :product='@json($product)' :addition='@json($slider)'>
                                                        <button type="button" class="btn_action">
                                                            <img
                                                                src="/assets/images/icons/basket.svg"
                                                                class="injectable"
                                                                alt="#"
                                                            />
                                                        </button>
                                                    </add-addition>
                                                </div>
                                            </div>
                                        </div>
                                    @empty @endforelse
                                </div>
                                @if($addition[0]->type->name === 'Выбрать открытку')
                                    <label class="custom_checkbox">
                                        Добавить комментарий
                                        <input type="checkbox" id="add_comment"/>
                                        <span class="checkmark"></span>
                                    </label>
                                    <div class="comment_block">
                                        <div class="block_in">
                                            <textarea id="comment" placeholder="Напишите что - нибудь ..."></textarea>
                                            <span class="postcard-alert" style="display: none">комментарий добавлен</span>
                                            <button type="button" class="btn_add_comment" onclick="addComment()">
                                                Добавить
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty @endforelse

                        @if($product->sizes)
                            <!-- size -->
                            <div class="size_product_checkboxes">
                                <span class="label">Выбери свой размер</span>
                                <div class="checkboxes">
                                    @foreach(["small", "medium", "big"] as $tag)
                                        @if($product->sizes->{"name_".$tag})
                                            <div class="item" onclick="add_size('{{ $product->sizes->{"name_".$tag} }}', '{{ $product->slug }}', '{{ $product->sizes->{"price_".$tag} }}')">
                                                <input
                                                    id="sizeCard{{$loop->index + 1}}"
                                                    type="radio"
                                                    class="{{ $product->sizes->{"name_".$tag} }}"
                                                    name="sizeCard"
                                                    {{ get_product_price($product->price, $product?->discount?->percent) == get_product_price($product->sizes->{"price_".$tag},$product?->discount?->percent) ? 'checked' : null }}
                                                />
                                                <label for="sizeCard{{$loop->index + 1}}" class="size_card" name="sizeCard">
                                                    @if($product?->discount?->percent)
                                                        <span class="sale_price">{{ $product->sizes->{"price_".$tag} }} руб.</span>
                                                    @endif
                                                    <span class="price">{{get_product_price($product->sizes->{"price_".$tag},$product?->discount?->percent) }} руб.</span>
                                                    <p class="info">{{ $product->sizes->{"name_".$tag} }}</p>
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <go-to-checkout>
                            <a href="/checkout" type="button" class="fast_order">Быстрый заказ</a>
                        </go-to-checkout>
                        <add-to-card :product='@json($product)'>
                            <button type="button" class="add_basket">
                                Добавить в корзину
                            </button>
                        </add-to-card>
                    </div>
                </div>
            </div>
        </section>
        <section class="order_product_tabs">
            <div class="custom_container_fluid">
                <div class="tab_navbar">
                    <button type="button" class="btn_tab active_tab" data-id="tab1">
                        Описание
                    </button>
                    <button type="button" class="btn_tab" data-id="tab2">Отзывы</button>
                    <button type="button" class="btn_tab" data-id="tab3">
                        Совет от профессионала
                    </button>
                </div>
                <div class="tabs_container">
                    <div class="tab active_tab" id="tab1">
                        <div class="description_tab">
                            {!! $product->description !!}
                        </div>
                    </div>
                    <div class="tab" id="tab2">
                        <section class="impressions_sect">
                            <div class="owl-carousel impressions_carousel">
                                <div class="item">
                                    <img
                                        class="quote"
                                        src="/assets/images/icons/quote.svg"
                                        alt=""
                                    />
                                    <p class="item_content">
                                        “ Большое спасибо, прекрасный букет. Доставили во время.
                                        Хорошая обраная связь. Приятные цены. “
                                    </p>
                                    <span class="item_name">Александр Петрович</span>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="tab" id="tab3">
                        <div class="description_tab">
                           {!! $product->specification !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="shipping_and_payment">
            <div class="custom_container_fluid">
                <h3 class="title">Варианты доставки</h3>
                <div class="columns">
                    <div class="list_block">
                        <h4 class="column_title">Курьер до двери</h4>
                        <div class="list_pay">
                            <p>
                                Доставка по Москве осуществляется бесплатно в пределах МКАД.
                            </p>
                        </div>
                        <div class="list_pay">
                            <p>Доставка за пределами МКАД оплачивается отдельно.</p>
                        </div>
                        <div class="list_pay">
                            <p>Перед отправкой вам будет выслано фото на согласование.</p>
                        </div>
                        <div class="list_pay">
                            <p>Есть возможность бесконтактной доставки</p>
                        </div>
                    </div>
                    <div class="list_block">
                        <h4 class="column_title">Самовызов</h4>
                        <div class="list_pay">
                            <p>г. Москва, Можайское шоссе, д. 41,к.1.</p>
                            <p>г. Москва, м. Фили, Новозаводская улица, д. 2, к.1.</p>
                            <p>г. Москва, ул. Новый Арбат, 3, стр. 1,</p>
                        </div>
                        <div class="list_pay">
                            <p>Для выдачи заказа Вам нужно приехать в магазин</p>
                        </div>
                        <div class="list_pay">
                            <p>Назвать свою ФИО и номер заказа</p>
                        </div>
                    </div>
                </div>
                <div class="shipping_method">
                    <div class="item">
                        <img src="/assets/images/icons/shipping-icons/gPay.svg" alt="#"/>
                        <span>Google Pay</span>
                    </div>
                    <div class="item">
                        <img src="/assets/images/icons/shipping-icons/aPay.svg" alt="#"/>
                        <span>Apple Pay</span>
                    </div>
                    <div class="item">
                        <img
                            src="/assets/images/icons/shipping-icons/online.svg"
                            alt="#"
                        />
                        <span>Оплата онлайн</span>
                    </div>
                    <div class="item">
                        <img src="/assets/images/icons/shipping-icons/cart.svg" alt="#"/>
                        <span>Оплата картой</span>
                    </div>
                    <div class="item">
                        <img src="/assets/images/icons/shipping-icons/cash.svg" alt="#"/>
                        <span>Оплата наличными</span>
                    </div>
                </div>
            </div>
        </section>
        @if($product_slider && $product_slider?->products)
            <section class="product_order_page product_carousel_section">
                <div class="custom_container_fluid">
                    <div class="product_carousel_head">
                        <h3 class="title_head">Подарки для вас</h3>
                    </div>
                    <div class="owl-carousel product_carousel">
                        @forelse($product_slider->products as $slider)
                            <div class="item">
                            <div class="img">
                                <img src="{{ url('/storage/products/thumb_'. $slider->image) }}" alt="#"/>
                                <div class="overlay">
                                    <div class="in">
                                        <span class="overlay_title">{{ $slider->name }}</span>
                                        <p class="info">{{ $slider->short_description }}</p>
                                    </div>
                                    <div class="in">
                                        <span class="price">{{ get_product_price($slider->price, $slider?->discount?->percent) }} руб</span>
                                        <a type="button" href="{{ product_url($slider->slug) }}" class="add_btn">Добавить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty @endforelse
                    </div>
                    <a href="{{ route("menu.collection",["collection" => $product_slider->slug]) }}" class="show_all"> Смотреть все </a>
                </div>
            </section>
        @endif
@endsection

@section('js')
    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
    <script>
        function setCommentPhoto() {
            let vue = document.getElementById('app').__vue__;
            let vueIndex = vue.$children.findIndex(item => item.$options['_componentTag'] === 'card-component');
            let slug = "{{ $product->slug }}";
            let cards = vue.$children[vueIndex]._data.cards;
            let productIndex = cards.findIndex(item => item.slug === slug);
            if(productIndex >= 0){
                let product = cards[productIndex];
                if(product.items) {
                    let photo = product.items[0].image;
                    $(".added_paper img").attr('src', `/storage/products/thumb_${photo}`);
                    $(".added_paper").show();
                }
            }
        }

        function add_size(name,slug,price) {
            localStorage.setItem('sizes', JSON.stringify({slug,name,price}));
            let cards = localStorage.getItem('cards') ? JSON.parse(localStorage.getItem('cards')) : [];
            let index = cards.findIndex(item => item.slug === slug);

            if(index >= 0) {
                cards[index].selected_size = {slug,name,price};
                cards[index].price = price;
                localStorage.setItem('cards', JSON.stringify(cards));
                let vue = document.getElementById('app').__vue__;
                let vueIndex = vue.$children.findIndex(item => item.$options['_componentTag'] === 'card-component');
                vue.$children[vueIndex]._data.cards = cards;
            }
        }

        function  addComment(){
            let comments = localStorage.getItem('comments')
            comments = comments ? JSON.parse(comments) : {};
            comments.postcard = $("#comment").val();
            localStorage.setItem('comments', JSON.stringify(comments));
            $(".postcard-alert").show();
            $(".added_paper .desc_paper").text($("#comment").val())
            setCommentPhoto();
        }

        function getComment() {
            let comments = localStorage.getItem('comments')
            comments = comments ? JSON.parse(comments) : [];
            if(comments.postcard) {
                $("#comment").val(comments.postcard);
                $(".postcard-alert").show();
                $(".added_paper .desc_paper").text(comments.postcard);
                setCommentPhoto();
            }
        }

        getComment();

        $(document).ready(function (){
            let slug = '{{ $product->slug }}';
            let cards = localStorage.getItem('cards') ? JSON.parse(localStorage.getItem('cards')) : [];
            let index = cards.findIndex(item => item.slug === slug);

            if(index >= 0) {
                if(cards[index].selected_size !== undefined){
                    $("input[name='sizeCard']").prop("checked", false);
                    $(`.${cards[index].selected_size.name}`).prop("checked", true);
                }
            }

            // $("#add_comment").click(function(){
            //     if(!$(this).is(":checked")) {
            //         localStorage.removeItem('comments');
            //         $(".added_paper").hide();
            //     }
            // })
        })

    </script>
@endsection
