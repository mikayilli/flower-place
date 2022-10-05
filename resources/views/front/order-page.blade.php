@extends('front.layouts.app')

@section('css')
@endsection

@section('content')
    <main>
        <div class="custom_container_fluid">
            <div class="status_order_block">
                <div class="head_status">
                    <div class="item">
                        <span class="label">Номер заказа:</span>
                        <span class="value">№8569654</span>
                    </div>
                    <div class="item center">
                        <span class="label">Статус:</span>
                        <span class="value">в процессе</span>
                    </div>
                    <div class="item right">
                        <span class="label">Время доставки:</span>
                        <span class="value">02/09/2021/16:30</span>
                    </div>
                </div>
                <div class="status_items">
                    <div class="item complete_status">
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/pencil.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Заказ получен</span>
                            <span class="date">11:05</span>
                            <a href="tel:0555555555" class="number">
                                <img src="/assets/images/icons/phone-order.svg" alt="#" />
                                <span>8 (000) 777-0016</span>
                            </a>
                        </div>
                        <span class="line"></span>
                    </div>
                    <div class="item active_status">
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/progress-circle.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Подтвержден, в процессе</span>
                            <span class="date">11:05</span>
                            <a href="tel:0555555555" class="number">
                                <img src="/assets/images/icons/phone-order.svg" alt="#" />
                                <span>8 (000) 777-0016</span>
                            </a>
                            <div class="img">
                                <img src="/assets/images/img/product1.png" alt="#" />
                            </div>
                        </div>
                        <div class="right">
                            <div class="buttons">
                                <button type="button" class="btn_action">
                                    <img src="/assets/images/icons/phone-order-mobile.svg" alt="#">
                                </button>
                                <button type="button" class="btn_action">
                                    <img src="/assets/images/icons/chat.svg" alt="#">
                                </button>
                            </div>
                        </div>
                        <span class="line"></span>
                    </div>
                    <div class="item active_status">
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/clock.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Готов, ожидает курьера</span>
                            <span class="date">11:05</span>
                            <div class="add_order_img_block">
                                <div class="img_courier">
                                    <input type="file" class="file-upload" />
                                    <img
                                        class="empty_img product-pic"
                                        src="/assets/images/icons/picture.svg"
                                        alt="#"
                                    />
                                </div>
                                <button type="button" class="btn_status">Готов</button>
                            </div>
                        </div>
                        <div class="right">
                            <button type="button" class="btn_status">Готов</button>
                        </div>
                        <span class="line"></span>
                    </div>
                    <div class="item">
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/forward.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Передан курьеру, в пути</span>
                            <span class="date">-- : --</span>
                        </div>
                        <span class="line"></span>
                    </div>
                    <div class="item complete_status">
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/chech-status.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Заказ доставлен</span>
                            <span class="date">11:05</span>
                            <a href="tel:0555555555" class="number">
                                <img src="/assets/images/icons/phone-order.svg" alt="#" />
                                <span>8 (000) 777-0016</span>
                            </a>
                            <div class="img">
                                <img src="/assets/images/img/product1.png" alt="#" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
