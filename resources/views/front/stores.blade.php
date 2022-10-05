@extends('front.layouts.app')

@section('css')
    <link href="{{ asset('/assets/css/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/owl.theme.default.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <main>
        <div class="custom_container_fluid">
            <ul class="bread_crumb">
                <li>
                    <span>Flower place</span>
                </li>
                <li>
                    <span class="active">/ Магазины</span>
                </li>
            </ul>
            <div class="page_head_block">
                <h1 class="title_head">Наши магазины</h1>
                <p>
                    Заходите к нам в магазин,чтобы полюбоваться свежими цветами <br />
                    и пообщаться с профессиональными флористами. А так же получить от
                    них совет по уходу за вашими цветами
                </p>
            </div>
        </div>
        <section class="stores_section">
            <div class="custom_container_fluid">
                <div class="tab_navbar">
                    <button type="button" class="btn_tab active_tab" data-id="tab1">
                        <img
                            src="/assets/images/icons/tabMarker.svg"
                            class="injectable"
                            alt="#"
                        />
                        <span>Магазин на Новом Арбате</span>
                    </button>
                    <button type="button" class="btn_tab" data-id="tab2">
                        <img
                            src="/assets/images/icons/tabMarker.svg"
                            class="injectable"
                            alt="#"
                        />
                        <span>Магазин на Фили</span>
                    </button>
                    <button type="button" class="btn_tab" data-id="tab3">
                        <img
                            src="/assets/images/icons/tabMarker.svg"
                            class="injectable"
                            alt="#"
                        />
                        <span>Магазин на Можайске</span>
                    </button>
                </div>
                <div class="tabs_container">
                    <div class="tab active_tab" id="tab1">
                        <div class="store_tab">
                            <div class="left_column">
                                <div class="contact_block">
                    <span class="title_store_tab">
                      Магазин на Новом Арбате
                    </span>
                                    <div class="list">
                                        <img src="/assets/images/icons/tabMarker.svg" alt="#" />
                                        <span class="list_title"
                                        >г. Москва, Можайское шоссе, д. 41,к.1.</span
                                        >
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/mail.svg" alt="#" />
                                        <span class="list_title">placeflower@yandex.ru</span>
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/phone.svg" alt="#" />
                                        <span class="list_title">+7(999)999-03-97</span>
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/timer.svg" alt="#" />
                                        <div>
                                            <span class="list_title">Режим работы</span>
                                            <p class="content">
                                                Магазин: круглосуточно Доставка: в день заказа
                                            </p>
                                        </div>
                                    </div>
                                    <div class="social_icons">
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/whatsapp.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/telegram.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/fb.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/insta.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/vk.svg"
                                                alt="#"
                                            />
                                        </a>
                                    </div>
                                    <button class="btn_show_map" type="button">
                                        Показать на карте
                                    </button>
                                </div>
                            </div>
                            <div class="right_column">
                                <div class="stores_carousel_main owl-carousel">
                                    <div class="item">
                                        <img src="/assets/images/img/map.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg1.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product4.png" alt="#" />
                                    </div>
                                </div>
                                <div class="stores_carousel_thumbnails owl-carousel">
                                    <div class="item">
                                        <img src="/assets/images/img/map.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg1.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product4.png" alt="#" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab" id="tab2">
                        <div class="store_tab">
                            <div class="left_column">
                                <div class="contact_block">
                                    <span class="title_store_tab"> Магазин на Фили </span>
                                    <div class="list">
                                        <img src="/assets/images/icons/tabMarker.svg" alt="#" />
                                        <span class="list_title"
                                        >г. Москва, м. Фили, Новозаводская улица, д. 2,
                        к.1.</span
                                        >
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/mail.svg" alt="#" />
                                        <span class="list_title">placeflower@yandex.ru</span>
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/phone.svg" alt="#" />
                                        <span class="list_title">+7(999)999-03-97</span>
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/timer.svg" alt="#" />
                                        <div>
                                            <span class="list_title">Режим работы</span>
                                            <p class="content">
                                                Магазин: круглосуточно Доставка: в день заказа
                                            </p>
                                        </div>
                                    </div>
                                    <div class="social_icons">
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/whatsapp.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/telegram.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/fb.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/insta.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/vk.svg"
                                                alt="#"
                                            />
                                        </a>
                                    </div>
                                    <button class="btn_show_map" type="button">
                                        Показать на карте
                                    </button>
                                </div>
                            </div>
                            <div class="right_column">
                                <div class="stores_carousel_main owl-carousel">
                                    <div class="item">
                                        <img src="/assets/images/img/map.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg1.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product4.png" alt="#" />
                                    </div>
                                </div>
                                <div class="stores_carousel_thumbnails owl-carousel">
                                    <div class="item">
                                        <img src="/assets/images/img/map.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg1.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product4.png" alt="#" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab" id="tab3">
                        <div class="store_tab">
                            <div class="left_column">
                                <div class="contact_block">
                                    <span class="title_store_tab">Магазин на Можайске</span>
                                    <div class="list">
                                        <img src="/assets/images/icons/tabMarker.svg" alt="#" />
                                        <span class="list_title"
                                        >г. Москва, м. Фили, Новозаводская улица, д. 2,
                        к.1.</span
                                        >
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/mail.svg" alt="#" />
                                        <span class="list_title">placeflower@yandex.ru</span>
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/phone.svg" alt="#" />
                                        <span class="list_title">+7(999)999-03-97</span>
                                    </div>
                                    <div class="list">
                                        <img src="/assets/images/icons/timer.svg" alt="#" />
                                        <div>
                                            <span class="list_title">Режим работы</span>
                                            <p class="content">
                                                Магазин: круглосуточно Доставка: в день заказа
                                            </p>
                                        </div>
                                    </div>
                                    <div class="social_icons">
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/whatsapp.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/telegram.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/fb.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/insta.svg"
                                                alt="#"
                                            />
                                        </a>
                                        <a href="#">
                                            <img
                                                src="/assets/images/icons/social-icons/vk.svg"
                                                alt="#"
                                            />
                                        </a>
                                    </div>
                                    <button class="btn_show_map" type="button">
                                        Показать на карте
                                    </button>
                                </div>
                            </div>
                            <div class="right_column">
                                <div class="stores_carousel_main owl-carousel">
                                    <div class="item">
                                        <img src="/assets/images/img/map.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg1.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product4.png" alt="#" />
                                    </div>
                                </div>
                                <div class="stores_carousel_thumbnails owl-carousel">
                                    <div class="item">
                                        <img src="/assets/images/img/map.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg1.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg3.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/cardImg2.png" alt="#" />
                                    </div>
                                    <div class="item">
                                        <img src="/assets/images/img/product4.png" alt="#" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="basket_overlay">
            <div class="overlay_inner">
                <div class="basket_inner">
                    <button type="button" class="close_basket">
                        <img src="/assets/images/icons/close.svg" alt="#" />
                    </button>
                    <span class="title_basket">Моя корзина</span>
                    <div class="items">
                        <div class="item">
                            <div class="left_column">
                                <div class="img">
                                    <img src="/assets/images/img/product1.png" alt="#" />
                                </div>
                            </div>
                            <div class="right_column">
                                <div class="head_column">
                                    <span class="item_title"> Нежность </span>
                                    <button type="button">
                                        <img src="/assets/images/icons/trash.svg" alt="#" />
                                    </button>
                                </div>
                                <div class="foot_column">
                                    <div class="counter">
                                        <button type="button" class="decrease">
                                            <img src="/assets/images/icons/minus.svg" alt="#" />
                                        </button>
                                        <span class="count">1</span>
                                        <button type="button" class="increase">
                                            <img src="/assets/images/icons/pluse.svg" alt="#" />
                                        </button>
                                    </div>
                                    <span class="price"> 2200 руб. </span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="left_column">
                                <div class="img">
                                    <img src="/assets/images/img/product2.png" alt="#" />
                                </div>
                            </div>
                            <div class="right_column">
                                <div class="head_column">
                                    <span class="item_title"> Нежность </span>
                                    <button type="button">
                                        <img src="/assets/images/icons/trash.svg" alt="#" />
                                    </button>
                                </div>
                                <div class="foot_column">
                                    <div class="counter">
                                        <button type="button" class="decrease">
                                            <img src="/assets/images/icons/minus.svg" alt="#" />
                                        </button>
                                        <span class="count">1</span>
                                        <button type="button" class="increase">
                                            <img src="/assets/images/icons/pluse.svg" alt="#" />
                                        </button>
                                    </div>
                                    <span class="price"> 2200 руб. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="total_price">
                        <span class="total_label">Всего</span>
                        <span class="total_count">2200 руб</span>
                    </div>
                    <button type="button" class="btn_order">Заказать</button>
                    <a href="basket.html" class="btn_show_basket">Посмотреть корзину</a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
@endsection
