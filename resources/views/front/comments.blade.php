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
                <span class="active">/ Отзывы</span>
            </li>
        </ul>
        <div class="page_head_block">
            <h1 class="title_head">Отзывы</h1>
            <p>Нам очень важны ваши отзывы</p>
        </div>
    </div>
    <section class="comments_section">
        <div class="custom_container_fluid">
            <div class="head_comments_section">
                <select class="select">
                    <option value="#">Сначала новые</option>
                    <option value="#">empty</option>
                    <option value="#">empty</option>
                </select>
            </div>
            <div class="comments_block">
                <div class="item">
                    <div class="left_column">
                        <span class="user_name">Александр Петрович</span>
                        <div class="stars">
                            <img src="/assets/images/icons/star-active.svg" alt="#" />
                            <img src="/assets/images/icons/star-active.svg" alt="#" />
                            <img src="/assets/images/icons/star-active.svg" alt="#" />
                            <img src="/assets/images/icons/star-active.svg" alt="#" />
                            <img src="/assets/images/icons/star-disable.svg" alt="#" />
                            <span class="rating_count">4.5</span>
                        </div>
                        <span class="date">23.08.2021</span>
                    </div>
                    <div class="right_column">
                        <p class="comment">
                            Сам не спец в цветах, но жене очень понравился оригинальный
                            весенний букет, собранный с позитивным настроением. Оставляю
                            свой положительный отзыв магазину на Авиамоторной улице.
                            Конечно, буду рекомендовать. Лучший на районе цветочный!
                            Молодцы!
                        </p>
                        <img
                            class="empty_img"
                            src="/assets/images/icons/emptyImg.svg"
                            alt="#"
                        />
                    </div>
                </div>
                <div class="item">
                    <div class="left_column">
                        <span class="user_name">Александр Петрович</span>
                        <div class="stars">
                            <img src="/assets/images/icons/star-active.svg" alt="#" />
                            <img src="/assets/images/icons/star-active.svg" alt="#" />
                            <img src="/assets/images/icons/star-active.svg" alt="#" />
                            <img src="/assets/images/icons/star-active.svg" alt="#" />
                            <img src="/assets/images/icons/star-disable.svg" alt="#" />
                            <span class="rating_count">4.5</span>
                        </div>
                        <span class="date">23.08.2021</span>
                    </div>
                    <div class="right_column">
                        <p class="comment">
                            Сам не спец в цветах, но жене очень понравился оригинальный
                            весенний букет, собранный с позитивным настроением. Оставляю
                            свой положительный отзыв магазину на Авиамоторной улице.
                            Конечно, буду рекомендовать. Лучший на районе цветочный!
                            Молодцы!
                        </p>
                        <img
                            class="comment_img"
                            src="/assets/images/img/cardImg1.png"
                            alt="#"
                        />
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
@endsection
