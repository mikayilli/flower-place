@extends('front.panel.partials.main')

@section('page')
    <div class="right_column">
        <div class="my_order_block">
            <div class="head_my_order">
                <span class="order_title"> Заказы </span>
                <span class="other_title">Дата</span>
                <span class="other_title">Статус</span>
                <span class="other_title">Количество</span>
                <span class="other_title">Цена</span>
            </div>
            <div class="my_order_row">
                <div class="order_column">
                    <div class="title_row">
                        <span class="label">Кому:</span>
                        <span class="name">Татьяна Николаевна Татьяна</span>
                    </div>
                    <div class="order_info">
                        <div class="img">
                            <img src="/assets/images/img/product3.png" alt="#" />
                        </div>
                        <div class="right">
                            <p class="content">
                                Тюльпан фиолетовый - 7 шт Ирис синий - 5 шт Альстромерия
                                белая - 4 шт Лизиантус синий - 4 шт Орхидея Цимбидиум
                                белая - 3 штТюльпан фиолетовый - 7 шт Ирис синий - 5 шт
                                Альстромерия белая - 4 шт Лизиантус синий - 4 шт Орхидея
                                Цимбидиум белая - 3 шт
                            </p>
                            <button type="button" class="btn_go">Перейти</button>
                        </div>
                    </div>
                    <div class="order_foot">
                        <span class="label">Нежность</span>
                        <span class="value">
                      Длина:
                      <img src="/assets/images/icons/cmArrow.svg" alt="#" />
                      40cm
                    </span>
                    </div>
                </div>
                <div class="other_column">
                    <span class="info_text">18.08.2021</span>
                </div>
                <div class="other_column">
                    <span class="info_text">Доставлено</span>
                </div>
                <div class="other_column">
                    <span class="info_text">2 букета</span>
                </div>
                <div class="other_column">
                    <span class="info_text">2350 руб.</span>
                </div>
            </div>
            <div class="my_order_row">
                <div class="order_column">
                    <div class="title_row">
                        <span class="label">Кому:</span>
                        <span class="name">Татьяна Николаевна Татьяна</span>
                    </div>
                    <div class="order_info">
                        <div class="img">
                            <img src="/assets/images/img/product4.png" alt="#" />
                        </div>
                        <div class="right">
                            <p class="content">
                                Тюльпан фиолетовый - 7 шт Ирис синий - 5 шт Альстромерия
                                белая - 4 шт Лизиантус синий - 4 шт Орхидея Цимбидиум
                                белая - 3 штТюльпан фиолетовый - 7 шт Ирис синий - 5 шт
                                Альстромерия белая - 4 шт Лизиантус синий - 4 шт Орхидея
                                Цимбидиум белая - 3 шт
                            </p>
                            <button type="button" class="btn_go">Перейти</button>
                        </div>
                    </div>
                    <div class="order_foot">
                        <span class="label">Нежность</span>
                        <span class="value">
                      Длина:
                      <img src="/assets/images/icons/cmArrow.svg" alt="#" />
                      40cm
                    </span>
                    </div>
                </div>
                <div class="other_column">
                    <span class="info_text">18.08.2021</span>
                </div>
                <div class="other_column">
                    <span class="info_text">Доставлено</span>
                </div>
                <div class="other_column">
                    <span class="info_text">2 букета</span>
                </div>
                <div class="other_column">
                    <span class="info_text">2350 руб.</span>
                </div>
            </div>
        </div>
    </div>
@endsection

