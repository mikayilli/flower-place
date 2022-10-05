@extends('front.layouts.main')

@section('css')
    <link href="{{ asset('/assets/css/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <style>
        body main .introduction_main .custom_container_fluid .main_img_block .content_block .btn_block_content {
            text-align: center;
            line-height: 38px;
        }
    </style>
@endsection

@section('main')
        <!-- done -->
        <section class="introduction_main">
            @if($results['collections_3'])
                <div class="custom_container_fluid">
                    <div class="owl-carousel index_head_carousel">
                        @foreach($results['collections_3'] as $collection)
                            <div class="main_img_block">
                                <img src="assets/images/img/homeMainImg.png" alt="#" />
                                <div class="content_block">
                                    <h1>{{ $collection->name }}</h1>
                                    <p>{{ $collection->description }}</p>
                                    <a href="{{ route('menu.collection', ['collection' => $collection->slug]) }}" type="button" class="btn_block_content">
                                        Спеши приобрести
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="custom_container">
                <div class="link_card_items">
                    @include('front.includes.banners.collection_under_main_slider')
                </div>
            </div>
        </section>
        <section class="site_info_items">
            <div class="custom_container">
                <div class="item_info delete_mobile">
                    <img src="/assets/images/icons/delivery.svg" alt="#" />
                    <span class="title_item"
                    >Бесплатная доставка по Москве при заказе от 2500 руб.</span
                    >
                </div>
                <div class="item_info">
                    <img src="/assets/images/icons/message.svg" alt="#" />
                    <span class="title_item">Любого типа записки к вашим букетам</span>
                </div>
                <div class="item_info">
                    <img src="/assets/images/icons/time.svg" alt="#" />
                    <span class="title_item">Доставка во времяи без опозданий</span>
                </div>
                <div class="item_info delete_mobile">
                    <img src="/assets/images/icons/date.svg" alt="#" />
                    <span class="title_item"
                    >Работаем без выходных,<br />
              7/24</span
                    >
                </div>
                <div class="item_info">
                    <img src="/assets/images/icons/camera.svg" alt="#" />
                    <span class="title_item"
                    >Фото букета перед отправкой по вашему желанию</span
                    >
                </div>
            </div>
        </section>

        @if($results['slider_1'] || $results['slider_1']?->products)
            <!-- done -->
            <section class="product_carousel_section">
                <div class="custom_container">
                    <div class="product_carousel_head">
                        <h3 class="title_head">Популярные букеты</h3>
                        <a href="{{ route("menu.collection",["collection" => $results['slider_1']?->slug]) }}"> Смотреть все </a>
                    </div>
                    <div class="owl-carousel product_carousel product_slider_popup">
                       @include('front.includes.sliders.main', ["sliders" => $results['slider_1']->products])
                    </div>
                </div>
            </section>
        @endif

        @if($results['slider_1'] || $results['slider_1']?->products)
        <section class="mobile_product_items">
            <div class="custom_container">
                <h3 class="title_products">Популярные букеты</h3>
                <div class="items">
                    @foreach($results['slider_1']->products as $product)
                        <div class="item">
                            <div class="img">
                                <img src="{{ url("/storage/products/thumb_". $product->image) }}" alt="#" />
                                @if($product->disocunt)
                                    <div class="sale">
                                        <img src="/assets/images/icons/saleBg.svg" alt="#" />
                                        <span>{{ $prooduct->discount->percent }}%</span>
                                    </div>
                                @endif
                                <div class="bottom_actions">
                                    <add-to-favorite :product='@json($product)' :url='@json(route("menu.collection",["collection" => $results['slider_1']?->slug])."/". $product->slug)'>
                                        <button type="button" class="btn_action_cr">
                                            <img src="/assets/images/icons/heart.svg" alt="#" />
                                        </button>
                                    </add-to-favorite>

                                    <add-to-card  :product='@json($product)' >
                                        <button type="button" class="btn_action_cr">
                                            <img src="/assets/images/icons/basket.svg" alt="#" />
                                        </button>
                                    </add-to-card>

                                    <button type="button" class="btn_action_cr">
                                        <img src="/assets/images/icons/eyeVisible.svg" alt="#" />
                                    </button>
                                </div>
                            </div>
                            <div class="content">
                                <div class="content_title">
                                    <span class="name">{{ $product->name }}</span>
                                    <div class="rating">
                                        <span>4,2</span>
                                        <img src="/assets/images/icons/star.svg" alt="#" />
                                    </div>
                                </div>
                                <span class="price_product">{{ get_product_price($product->price,$product?->discount?->percent) }} руб.</span>
                                <a href="{{ product_url($product->slug) }}" class="order_btn">Заказать</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- done -->
        <section class="for_you_interesting">
            <div class="custom_container">
                <h2 class="title_block">Вас заинтересует</h2>
                <div class="interesting_block">
                    @include('front.includes.banners.collection_middle_section')
                </div>
                <div class="interesting_carousel owl-carousel">
                    @include('front.includes.banners.collection_middle_section')
                </div>
            </div>
        </section>

        @if($results['slider_2'] || $results['slider_2']?->products)
            <!-- done -->
            <section class="product_carousel_section">
                <div class="custom_container">
                    <div class="product_carousel_head">
                        <h3 class="title_head">Рекомендуется для вас</h3>
                        <a href="{{ route("menu.collection",["collection" => $results['slider_2']->slug]) }}"> Смотреть все </a>
                    </div>
                    <div class="owl-carousel product_carousel product_slider_popup">
                        @include('front.includes.sliders.main', ["sliders" => $results['slider_2']->products])
                    </div>
                </div>
            </section>
        @endif

        @if($results['slider_1'] || $results['slider_1']?->products)
            <section class="mobile_product_items">
            <div class="custom_container">
                <h3 class="title_products">Популярные букеты</h3>
                <div class="items">
                    @forelse($results['slider_1']->products->take(4) as $slider)
                     <div class="item">
                        <div class="img">
                            <img src="{{ url('storage/products/thumb_'. $slider->image ) }}" alt="{{ $slider->name }}" />
                            @if($slider->discount)
                                <div class="sale">
                                    <img src="/assets/images/icons/saleBg.svg" alt="#" />
                                    <span>{{ $slider->discount->percent }}%</span>
                                </div>
                            @endif
                            <div class="bottom_actions">
                                <button type="button" class="btn_action_cr">
                                    <img src="/assets/images/icons/heart.svg" alt="#" />
                                </button>
                                <button type="button" class="btn_action_cr">
                                    <img src="/assets/images/icons/basket.svg" alt="#" />
                                </button>
                                <button type="button" class="btn_action_cr">
                                    <img src="/assets/images/icons/eyeVisible.svg" alt="#" />
                                </button>
                            </div>
                        </div>
                        <div class="content">
                            <div class="content_title">
                                <span class="name">{{ $slider->name }}</span>
                                <div class="rating">
                                    <span>4,2</span>
                                    <img src="/assets/images/icons/star.svg" alt="#" />
                                </div>
                            </div>
                            <span class="price_product">{{ get_product_price($slider->price, $slider?->discount?->percent) }} руб.</span>
                            <a href="#" class="order_btn">Заказать</a>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
        @endif
        <section class="insta_section">
            <div class="custom_container">
                <div class="insta_block">
                    <a href="#" target="_blank" class="inner_block">
                        <div class="insta_head">
                            <div class="avatar_block">
                                <div class="avatar">
                                    <img src="/assets/images/img/product1.png" alt="#" />
                                </div>
                                <span class="insta_name"> flower.24.place </span>
                            </div>
                            <img src="/assets/images/icons/instaLogo.png" alt="#" />
                        </div>
                        <div class="insta_img">
                            <img src="/assets/images/img/instaImg.png" alt="#" />
                        </div>
                        <div class="insta_actions">
                            <div class="buttons">
                                <img src="/assets/images/icons/instaHeart.svg" alt="#" />
                                <img src="/assets/images/icons/instaComment.svg" alt="#" />
                                <img src="/assets/images/icons/instaDm.svg" alt="#" />
                            </div>
                            <span class="goInsta">Перейти в инстаграмм</span>
                        </div>
                        <div class="like_block">
                            <span class="label">Liked by:</span>
                            <span class="count">214</span>
                        </div>
                        <p class="content_block">
                            <span class="insta_name">flower.24.place</span>
                            Радуга: Стоимость букета: 4300. Для заказа обращаться в direct.
                            Или по номеру +7(999)999-03-97 Доставка в пределах МКАД
                            БЕСПЛАТНО
                        </p>
                    </a>
                </div>
                <div class="product_items">
                    @if($results['insta_feed'] || $results['insta_feed']?->products)
                        @foreach($results['insta_feed']->products as $feed)
                            <div class="item">
                                <img class="img" src="{{ url('storage/products/thumb_'. $feed->image ) }}" alt="{{ $feed->name }}" />
                                <div class="footer">
                                    <span class="price">{{ get_product_price($feed->price, $feed?->discount?->percent) }} руб.</span>
                                    <a href="{{ product_url($feed->slug) }}" class="order_btn">Заказать</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        @if($results['slider_3'] || $results['slider_3']?->products)
            <section class="product_carousel_section">
            <div class="custom_container">
                <div class="product_carousel_head">
                    <h3 class="title_head">Новые букеты</h3>
                    <a href="{{ route("menu.collection",["collection" => $results['slider_3']->slug]) }}"> Смотреть все </a>
                </div>
                <div class="owl-carousel product_carousel product_slider_popup">
                    @include('front.includes.sliders.main', ["sliders" => $results['slider_3']->products])
                </div>
            </div>
        </section>
        @endif
        <section class="our_advantages">
            <div class="custom_container">
                <h3 class="title_advantages">Наши преимущества</h3>
                <p class="content_advantages">
                    Каждый день мы усердно работаем, чтобы сделать жизнь наших клиентов
                    лучше и счастливее
                </p>
                <div class="advantage_items">
                    <div class="item only_image">
                        <img class="img" src="/assets/images/img/cardImg1.png" alt="#" />
                    </div>
                    <div class="item">
                        <img
                            class="icn"
                            src="/assets/images/img/advantage1.svg"
                            alt="#"
                        />
                        <span class="title_item">Особая гарантия</span>
                        <span class="content_item"
                        >Если не понравится букет, сообщите нам в течение 24 часов и мы
                заменим его бесплатно.</span
                        >
                    </div>
                    <div class="item only_image">
                        <img class="img" src="/assets/images/img/cardImg2.png" alt="#" />
                    </div>
                    <div class="item">
                        <img
                            class="icn"
                            src="/assets/images/img/advantage2.svg"
                            alt="#"
                        />
                        <span class="title_item">Особая гарантия</span>
                        <span class="content_item"
                        >Если не понравится букет, сообщите нам в течение 24 часов и мы
                заменим его бесплатно.</span
                        >
                    </div>
                    <div class="item only_image">
                        <img class="img" src="/assets/images/img/cardImg3.png" alt="#" />
                    </div>
                    <div class="item">
                        <img
                            class="icn"
                            src="/assets/images/img/advantage3.svg"
                            alt="#"
                        />
                        <span class="title_item">Особая гарантия</span>
                        <span class="content_item"
                        >Если не понравится букет, сообщите нам в течение 24 часов и мы
                заменим его бесплатно.</span
                        >
                    </div>
                </div>
            </div>
        </section>
        <section class="impressions_sect">
            <div class="custom_container">
                <h3 class="title_impressions">Ваши впечатления</h3>
                <div class="owl-carousel impressions_carousel">
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                    <div class="item">
                        <img class="quote" src="/assets/images/icons/quote.svg" alt="" />
                        <p class="item_content">
                            “ Большое спасибо, прекрасный букет. Доставили во время. Хорошая
                            обраная связь. Приятные цены. “
                        </p>
                        <span class="item_name">Александр Петрович</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="call_me_block">
            <div class="custom_container">
                <div class="block_inner">
                    <h3 class="title">Не нашли подходящий букет?</h3>
                    <span class="desc">
                      Тогда свяжитесь с нашими специалистами и они вам помогут
                    </span>
                    <a class="action_item" href="tel:+994505005050">
                        <img
                            class="injectable"
                            src="/assets/images/icons/phone-call.svg"
                            alt=""
                        />
                        <span>8 (000) 777-0016</span>
                    </a>
                    <a class="action_item" href="mailto:placeflower@yandex.ru">
                        <img
                            class="injectable"
                            src="/assets/images/icons/email.svg"
                            alt=""
                        />
                        <span>placeflower@yandex.ru</span>
                    </a>
                    <a href="#" class="btn_order btn_popup popup_test_btn" data-id="modal-4">
                        Заказать бесплатный звонок
                    </a>
                </div>
            </div>
        </section>
        <div id="modal-4" class="my_modal">
            <div class="modal_center">
                <div class="modal_inner call_me_modal">
                    <span class="title_call_me_modal">Заказать обратный звонок</span>
                    <p class="desc_call_me_modal">
                        Оставьте номер Вашего телефона и мы свяжемся с Вами в ближайшее
                        время (09:00-21:00 по Московскому времени, ежедневно)
                    </p>
                    @if(session()->has('call_req'))
                        <h6>{{ session()->get('call_req') }}</h6>
                    @endif
                    <form action="{{ route('callRequest') }}" method="POST">
                        @csrf
                        <div class="input">
                            <label for="name">Имя/Фамилия</label>
                            <input type="text" id="name" placeholder="Имя/Фамилия" name="call_full_name" value="{{ old('call_full_name') }}"/>
                            @error('call_full_name', 'call_req')<span>{{ $message }}</span>@enderror
                        </div>
                        <div class="input">
                            <label for="name">Контактный номер</label>
                            <input type="number" id="name" placeholder="Контактный номер"  name="call_phone" value="{{ old('call_phone') }}"/>
                            @error('call_phone', 'call_req')<span>{{ $message }}</span>@enderror
                        </div>
                        <label class="custom_checkbox">
                            Связаться по Whatsapp
                            <input type="checkbox"  name="wp"/>
                            <span class="checkmark"></span>
                        </label>
                        <button class="submit_btn" type="submit">Звонок</button>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
    <script>
        @if($errors->call_req->any() || session()->has('call_req'))
            $(document).ready(function(){
                $("#modal-4").fadeIn('fast');
            })
        @endif
    </script>
@endsection
