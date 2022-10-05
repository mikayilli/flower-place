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
                        <span class="value">№{{ $order->uuid }}</span>
                    </div>
                    <div class="item center">
                        <span class="label">Статус:</span>
                        <span class="value">{{ $status[$order->status] }}</span>
                    </div>
                    <div class="item right">
                            <span class="label">Время доставки:</span>
                            <span class="value">{{ getStatusDate($order, 2, 'd/m/Y/H:i') }}</span>
                    </div>
                </div>
                <div class="status_items">
                    <div @class(["item", checkStatus($order, 2)])>
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/pencil.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Заказ получен</span>
                            <span class="date">{{ getStatusDate($order, 2, 'H:i') }}</span>
                            <a href="tel:0555555555" class="number">
                                <img src="/assets/images/icons/phone-order.svg" alt="#" />
                                <span>8 (000) 777-0016</span>
                            </a>
                        </div>
                        <span class="line"></span>
                    </div>
                    <div @class(["item", checkStatus($order, 3)])>
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/progress-circle.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Подтвержден, в процессе</span>
                            <span class="date">{{ getStatusDate($order, 3, 'H:i') }}</span>
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
                                    <img
                                        src="/assets/images/icons/phone-order-mobile.svg"
                                        alt="#"
                                    />
                                </button>
                                <button type="button" class="btn_action">
                                    <img src="/assets/images/icons/chat.svg" alt="#" />
                                </button>
                            </div>
                        </div>
                        <span class="line"></span>
                    </div>
                    <div @class(["item", checkStatus($order, 4)])>
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/clock.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Готов, ожидает курьера</span>
                            <span class="date">{{ getStatusDate($order, 4, 'H:i') }}</span>
                        </div>
                        <div class="right">
                            <button type="button" class="btn_status">Готов</button>
                        </div>
                        <span class="line"></span>
                    </div>
                    <div @class(["item", checkStatus($order, 5)])>
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/forward.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Передан курьеру, в пути</span>
                            <span class="date">{{ getStatusDate($order, 5, 'H:i') }}</span>
                        </div>
                        <span class="line"></span>
                    </div>
                    <div @class(["item", checkStatus($order, 6)])>
                        <div class="left">
                            <div class="icn">
                                <img
                                    class="injectable"
                                    src="/assets/images/icons/chech-status.svg"
                                    alt="#"
                                />
                            </div>
                            <span class="desc">Заказ доставлен</span>
                            <span class="date">{{ getStatusDate($order, 6, 'H:i') }}</span>
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
            <div class="info_order_block">
                <div class="left_col">
                    <div class="left_item">
                        <span class="title_col">Отправитель</span>
                        <p class="text">Борис Петрович</p>
                        <p class="text">Тел: +87556522369854</p>
                        <p class="text">Номер заказа: №87569</p>
                    </div>
                    <div class="left_item">
                        <span class="title_col">Получатель</span>
                        <p class="text">Борис Петрович</p>
                        <p class="text">Тел: +87556522369854</p>
                        <p class="text">Адресс: Комсомольская пл., 5,</p>
                        <p class="text">Москва, Россия, 107140</p>
                    </div>
                </div>
                <div class="center_col">
                    <span class="title_col">Заказ</span>
                    <div class="center_item">
                        <div class="left">
                            <span class="label">Букет:</span>
                            <a class="link" href="#">“Розы”</a>
                        </div>
                        <div class="img">
                            <img src="/assets/images/img/cardImg1.png" alt="#" />
                        </div>
                    </div>
                    <div class="center_item">
                        <div class="left">
                            <span class="label">Подарок:</span>
                            <a class="link" href="#">“Мишка Тедди”</a>
                        </div>
                        <div class="img">
                            <img src="/assets/images/img/cardImg1.png" alt="#" />
                        </div>
                    </div>
                    <div class="center_item">
                        <div class="left">
                            <span class="label">Подарок:</span>
                            <a class="link" href="#">Открытка</a>
                        </div>
                        <div class="img">
                            <img src="/assets/images/img/cardImg1.png" alt="#" />
                            <span class="desc">“Желаю счастья, здоровья,любви “Желаю счастья, здоровья,любви”</span>
                        </div>
                    </div>
                </div>
                <div class="right_col">
                    <div class="left_item">
                        <span class="title_col">Оплата</span>
                        <p class="text">Сумма: 2550 руб.</p>
                        <p class="text">Доставка: 250 руб.</p>
                        <p class="text">Скидка: 0 руб.</p>
                    </div>
                    <span class="total_price">Итоговая сумма: 2800 руб.</span>
                    <div class="status_order">
                        <span>Статус оплаты: </span>
                        <span class="status">Оплачено</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')

@endsection

