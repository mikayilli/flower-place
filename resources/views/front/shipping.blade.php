@extends('front.layouts.app')

@section('css')
@endsection

@section('content')
    <main>
        <div class="custom_container_fluid">
            <ul class="bread_crumb">
                <li>
                    <span>Flower place</span>
                </li>
                <li>
                    <span class="active">/ Доставка и оплата</span>
                </li>
            </ul>
            <div class="page_head_block">
                <h1 class="title_head">Вам понравилось</h1>
                <p>Заказы принимаются круглые сутки</p>
            </div>
        </div>
        <section class="shipping_and_payment">
            <div class="shipping_row">
                <div class="custom_container_fluid">
                    <h3 class="title">Доставка и оплата</h3>
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
                </div>
            </div>
            <div class="custom_container_fluid">
                <div class="shipping_method">
                    <div class="item">
                        <img src="/assets/images/icons/shipping-icons/gPay.svg" alt="#" />
                        <span>Google Pay</span>
                    </div>
                    <div class="item">
                        <img src="/assets/images/icons/shipping-icons/aPay.svg" alt="#" />
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
                        <img src="/assets/images/icons/shipping-icons/cart.svg" alt="#" />
                        <span>Оплата картой</span>
                    </div>
                    <div class="item">
                        <img src="/assets/images/icons/shipping-icons/cash.svg" alt="#" />
                        <span>Оплата наличными</span>
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
@endsection
