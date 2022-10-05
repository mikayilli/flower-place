@extends('front.layouts.app')

@section('css')
@endsection

@section('content')
    <main>
        <div class="custom_container">
            <button
                type="button"
                class="btn_popup popup_test_btn"
                data-id="modal-1"
            >
                Login popup
            </button>
            <button
                type="button"
                class="btn_popup popup_test_btn"
                data-id="modal-2"
            >
                Register popup
            </button>
            <button
                type="button"
                class="btn_popup popup_test_btn"
                data-id="modal-3"
            >
                OTP code popup
            </button>
            <button
                type="button"
                class="btn_popup popup_test_btn"
                data-id="modal-4"
            >
                Call me popup
            </button>
            <button
                type="button"
                class="btn_popup popup_test_btn"
                data-id="modal-5"
            >
                Comment popup
            </button>
            <button
                type="button"
                class="btn_popup popup_test_btn"
                data-id="modal-6"
            >
                Logout popup
            </button>
            <button
                type="button"
                class="btn_popup popup_test_btn"
                data-id="modal-7"
            >
                Order success popup
            </button>
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
    <div id="modal-1" class="my_modal">
        <div class="modal_center">
            <div class="modal_inner login_modal">
                <div class="login_head">
                    <span class="login_title">Вход</span>
                    <button type="button" class="btn_auth btn_popup" data-id="modal-2">
                        Регистрация
                    </button>
                </div>
                <form action="#">
                    <div class="input">
                        <label for="phone">Телефон *</label>
                        <input
                            type="number"
                            id="phone"
                            placeholder="+7(000)    ***  **  *** "
                        />
                    </div>
                    <div class="input">
                        <label for="password">Пароль</label>
                        <input
                            type="password"
                            id="password"
                            placeholder="Введите пароль"
                        />
                    </div>
                    <button class="submit_btn" type="submit">Войти</button>
                    <div class="login_foot">
                        <label class="custom_checkbox">
                            Запомнить меня
                            <input type="checkbox" />
                            <span class="checkmark"></span>
                        </label>
                        <button type="button" class="forgot_pass">Забыли пароль?</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-2" class="my_modal">
        <div class="modal_center">
            <div class="modal_inner register_modal">
                <div class="login_head">
                    <span class="login_title">Регистрация</span>
                    <button type="button" class="btn_auth btn_popup" data-id="modal-1">
                        Вход
                    </button>
                </div>
                <form action="#">
                    <div class="input">
                        <label for="name">Имя/Фамилия</label>
                        <input type="text" id="name" placeholder="Имя/Фамилия" />
                    </div>
                    <div class="input">
                        <label for="phone">Номер телефона</label>
                        <input type="number" id="phone" placeholder="Номер телефона" />
                    </div>
                    <div class="input">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" placeholder="E-mail" />
                    </div>
                    <div class="input">
                        <label for="password">Пароль</label>
                        <input
                            type="password"
                            id="password"
                            placeholder="Введите пароль"
                        />
                    </div>
                    <label class="custom_checkbox">
                        Хочу получать информацию о скидках и акциях
                        <input type="checkbox" />
                        <span class="checkmark"></span>
                    </label>
                    <label class="custom_checkbox">
                        Согласен с обработкой персональных данных
                        <input type="checkbox" />
                        <span class="checkmark"></span>
                    </label>
                    <button class="submit_btn" type="submit">Регистрация</button>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-3" class="my_modal">
        <div class="modal_center">
            <div class="modal_inner otp_modal">
                <div class="login_head">
                    <span class="login_title">Регистрация</span>
                    <button type="button" class="btn_auth btn_popup" data-id="modal-1">
                        Вход
                    </button>
                </div>
                <p class="otp_code_desc">
                    Мы отправили код для подтверждния на ваш номер/почту.
                </p>
                <form action="#">
                    <div class="input">
                        <label for="code">Введите код *</label>
                        <input type="text" id="code" placeholder="Введите код *" />
                    </div>
                    <button class="submit_btn" type="submit">Подтвердить</button>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-4" class="my_modal">
        <div class="modal_center">
            <div class="modal_inner call_me_modal">
                <span class="title_call_me_modal">Заказать обратный звонок</span>
                <p class="desc_call_me_modal">
                    Оставьте номер Вашего телефона и мы свяжемся с Вами в ближайшее
                    время (09:00-21:00 по Московскому времени, ежедневно)
                </p>
                <form action="#">
                    <div class="input">
                        <label for="name">Имя/Фамилия</label>
                        <input type="text" id="name" placeholder="Имя/Фамилия" />
                    </div>
                    <div class="input">
                        <label for="name">Контактный номер</label>
                        <input type="text" id="name" placeholder="Контактный номер" />
                    </div>
                    <label class="custom_checkbox">
                        Связаться по Whatsapp
                        <input type="checkbox" />
                        <span class="checkmark"></span>
                    </label>
                    <button class="submit_btn" type="submit">Звонок</button>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-5" class="my_modal">
        <div class="modal_center">
            <div class="modal_inner comment_modal">
                <p class="title_comment_modal">Оставит отзыв</p>
                <form action="#">
                    <div class="input">
                        <label for="name">Имя/Фамилия</label>
                        <input type="text" id="name" placeholder="Имя/Фамилия" />
                    </div>
                    <div class="input">
                        <label for="textarea">Ваш отзыв</label>
                        <textarea id="textarea" placeholder="Ваш отзыв ..."></textarea>
                    </div>
                    <div class="rating_row">
                        <span class="label_rating">Ваша оценка</span>
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
                    <div class="add_comment_img">
                        <input type="file" id="file_input">
                        <span>Прикрепить фото</span>
                    </div>
                    <div class="upload_block">
                    </div>
                    <button type="submit" class="btn_submit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-6" class="my_modal">
        <div class="modal_center">
            <div class="modal_inner logout_modal">
                <span class="question">Вы уверены что хотите выйти?</span>
                <div class="answers_buttons">
                    <button type="button" class="btn_answer">Нет</button>
                    <button type="button" class="btn_answer">Да</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-7" class="my_modal">
        <div class="modal_center">
            <div class="modal_inner order_modal_success">
                <img class="icn" src="/assets/images/icons/success.svg" alt="#">
                <p class="content">Ваш заказ был успешно зарегистрирован!</p>
                <p class="content">Скоро мы с вами свяжемся</p>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
