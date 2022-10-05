@extends('front.layouts.app')

@section('css')
@endsection

@section('content')
    <main>
        <div class="custom_container">
            <div class="feedback_block">
                <img src="/assets/images/icons/fire-cracker.svg" alt="#" />
                <span class="title_feedback">Ваш заказ был успешно доставлен!</span>
                <div class="list_feedback">
                    <span class="label">Время доставки:</span>
                    <span class="value">11:25</span>
                </div>
                <div class="list_feedback">
                    <span class="label">Телефон для связи:</span>
                    <span class="value">+99456 899 55 667</span>
                </div>
                <span class="sub_title"> Пожалуйста,оцените наш сервис. </span>
                <span class="desc"
                >Ваши отзывы важны для нас. Мы стараемся улучшить качества наших
            услуг.</span
                >
                <div class="rating_row">
                    <div class="list_row">
                        <div class="number_col">
                            <span class="circle"></span>
                            <span class="number">1.</span>
                        </div>
                        <span class="list_title"> Оценка общего процесса </span>
                    </div>
                    <svg style="display: none;">
                        <symbol id="star" viewBox="0 0 98 92">
                            <title>star</title>
                            <path stroke='#000' stroke-width='5' d='M49 73.5L22.55 87.406l5.05-29.453-21.398-20.86 29.573-4.296L49 6l13.225 26.797 29.573 4.297-21.4 20.86 5.052 29.452z' fill-rule='evenodd'/>
                    </svg>
                    <div class="rating">
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="rating_row">
                    <div class="list_row">
                        <div class="number_col">
                            <span class="circle"></span>
                            <span class="number">2.</span>
                        </div>
                        <span class="list_title"> Оценка работы курьера </span>
                    </div>
                    <svg style="display: none;">
                        <symbol id="star" viewBox="0 0 98 92">
                            <title>star</title>
                            <path stroke='#000' stroke-width='5' d='M49 73.5L22.55 87.406l5.05-29.453-21.398-20.86 29.573-4.296L49 6l13.225 26.797 29.573 4.297-21.4 20.86 5.052 29.452z' fill-rule='evenodd'/>
                    </svg>
                    <div class="rating">
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="rating_row">
                    <div class="list_row">
                        <div class="number_col">
                            <span class="circle"></span>
                            <span class="number">3.</span>
                        </div>
                        <span class="list_title"> Оценка товара </span>
                    </div>
                    <svg style="display: none;">
                        <symbol id="star" viewBox="0 0 98 92">
                            <title>star</title>
                            <path stroke='#000' stroke-width='5' d='M49 73.5L22.55 87.406l5.05-29.453-21.398-20.86 29.573-4.296L49 6l13.225 26.797 29.573 4.297-21.4 20.86 5.052 29.452z' fill-rule='evenodd'/>
                    </svg>
                    <div class="rating">
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                        <a href="javascript:;" class="rating__button" href="#">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <form action="#">
                    <label for="comment">Ваш комментарий</label>
                    <textarea placeholder="Написать ..."></textarea>
                    <div class="add_comment_img">
                        <input type="file" id="file_input">
                        <span>Добавить фото</span>
                    </div>
                    <div class="upload_block">
                    </div>
                    <button type="button" class="btn_submit">Добавить</button>
                </form>
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
