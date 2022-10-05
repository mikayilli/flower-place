<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/media.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/front-app.css') }}" />
    <link
        rel="stylesheet"
        href="{{ asset('/assets/css/magic-poopup.css') }}"
    />
    <script>
        window.frontBaseUrl = "{{ route('front-home') }}";
        window.user = {{ auth('customer')->check() ? 'true' : 'false' }};
    </script>
    @yield('css')
</head>
<body >
<div id="app">
    @include('front.layouts.partials.header')
    @yield('content')
    @include('front.layouts.partials.footer')

    @guest('customer')
        <div id="modal-1" class="my_modal">
            <div class="modal_center">
                <div class="modal_inner login_modal">
                    <div class="login_head">
                        <span class="login_title">Вход</span>
                        <button type="button" class="btn_auth btn_popup" data-id="modal-2">
                            Регистрация
                        </button>
                    </div>
                    @error('x', 'login') <h6>{{ $message }}</h6>@enderror
                    <form action="{{ route('customer.login') }}" method="post">
                        @csrf
                        <div class="input">
                            <label for="phone">Телефон *</label>
                            <input
                                type="number"
                                name="phone"
                                id="phone"
                                placeholder="+7(000)    ***  **  *** "
                            />
                            @error('phone','login')<span>{{ $message }}</span>@enderror
                        </div>
                        <div class="input">
                            <label for="password">Пароль</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Введите пароль"
                            />
                            @error('password','login')<span>{{ $message }}</span>@enderror
                        </div>
                        <button class="submit_btn" type="submit">Войти</button>
                        <div class="login_foot">
                            <label class="custom_checkbox">
                                Запомнить меня
                                <input type="checkbox" name="remember_me"/>
                                <span class="checkmark"></span>
                            </label>
                            <button type="button" class="forgot_pass" onclick="$('#modal-9').fadeIn('fast')">Забыли пароль?</button>
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
                    <form action="{{ route('customer.register') }}" method="post">
                        @csrf
                        <div class="input">
                            <label for="name">Имя/Фамилия</label>
                            <input type="text" name="full_name" id="name" placeholder="Имя/Фамилия" />
                            @error('full_name','register')<span>{{ $message }}</span>@enderror
                        </div>
                        <div class="input">
                            <label for="phone">Номер телефона</label>
                            <input type="number" name="phone" id="phone" placeholder="Номер телефона" />
                            @error('phone','register')<span>{{ $message }}</span>@enderror
                        </div>
                        <div class="input">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" placeholder="E-mail" />
                            @error('email','register')<span>{{ $message }}</span>@enderror
                        </div>
                        <div class="input">
                            <label for="password">Пароль</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Введите пароль"
                            />
                            @error('password','register')<span>{{ $message }}</span>@enderror
                        </div>
                        <label class="custom_checkbox">
                            Хочу получать информацию о скидках и акциях
                            <input type="checkbox" name="subscribe"/>
                            <span class="checkmark"></span>
                        </label>
                        <label class="custom_checkbox">
                            Согласен с обработкой персональных данных
                            <input type="checkbox" name="personal_info"/>
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
                    <form action="{{ route('customer.otp') }}" method="post">
                        @csrf
                        <div class="input">
                            <label for="code">Введите код *</label>
                            <input type="text" name="code" id="code" placeholder="Введите код *" />
                            @error('code','otp')<span>{{ $message }}</span>@enderror
                        </div>
                        <button class="submit_btn" type="submit">Подтвердить</button>
                    </form>
                </div>
            </div>
        </div>
        <form action="{{ route('customer.reset_password') }}" method="post">
            @csrf
            <div id="modal-9" class="my_modal">
                <div class="modal_center">
                    <div class="modal_inner forgot_pasword_modal">
                        <img class="warning_icn" src="/assets/images/icons/question.svg" alt="#">
                        <span class="title">Забыли пароль?</span>
                        <span class="desc">Введите свой номер телефона для обновления пароля</span>
                        <div class="input">
                            <label for="phone">Номер телефона</label>
                            <input
                                type="number"
                                id="phone"
                                placeholder="Введите номер телефона"
                                name="phone"
                            />
                            @error('reset_customer') <span>{{ $message }}</span>@enderror
                        </div>
                        <button href="#" type="submit" class="btn_submit">Далее</button>
                    </div>
                </div>
            </div>
        </form>
        @if(session()->has('reset_otp'))
            <form action="{{ route('customer.reset_password_otp_check') }}" method="post">
                @csrf
                <div id="modal-10" class="my_modal">
                    <div class="modal_center">
                        <div class="modal_inner forgot_pasword_otp_modal">
                            <img class="warning_icn" src="/assets/images/icons/otp_time.svg" alt="#">
                            <span class="desc">Мы отправили <span class="bold_text">код</span> для подтверждния на номер <span class="bold_text"> +7 (901) *** - ** - 85</span></span>
                            <div class="input">
                                <label for="phone">Введите код *</label>
                                <input
                                    type="hidden"
                                    name="phone"
                                    value="{{ old('phone', session('reset_otp_phone')) }}"
                                    required
                                /><input
                                    type="number"
                                    id="phone"
                                    placeholder="Введите код *"
                                    name="reset_otp"
                                    required
                                />
                                @error('reset_otp','reset') <span>{{ $message }}</span>@enderror
                            </div>
                            <div class="timer_row">
                                <span>Отправить код еще раз</span>
                                <span>24 сек.</span>
                            </div>
                            <button href="#" class="btn_submit">Подтвердить</button>
                        </div>
                    </div>
                </div>
            </form>
        @endif

        @if(session()->has('open_reset'))
            <form action="{{ route('customer.password-reset') }}" method="post">
                @csrf
                <div id="modal-11" class="my_modal">
                    <div class="modal_center">
                        <div class="modal_inner set_password_modal">
                            <img class="icn" src="/assets/images/icons/reverse.svg" alt="#">
                            <div class="input">
                                <label for="phone">Введите новый пароль</label>
                                <input
                                    type="password"
                                    id="phone"
                                    name="password"
                                    placeholder="Введите новый пароль"
                                />
                                @error('password', 'reset_last_modal') <span>{{ $message }}</span>@enderror
                            </div>
                            <div class="input">
                                <label for="phone">Повторите пароль</label>
                                <input
                                    type="password"
                                    id="phone"
                                    name="password_confirmation"
                                    placeholder="Повторите пароль"
                                />
                            </div>

                            <button href="#" class="btn_submit">Подтвердить</button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    @endguest
</div>
<script src="{{ mix('js/front-app.js') }}"></script>
<script src="{{ asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('/assets/js/svg-inject.min.js') }}"></script>
<script src="{{ asset('assets/js/magic-popup.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@yield('js')

<script>
    $(document).ready(function(){
        @if(session()->has('login') || $errors->login->any())
            $(`#modal-1`).fadeIn("fast");
        @endif

        @if($errors->register->any())
            $(`#modal-2`).fadeIn("fast");
        @endif

        @if(session()->has('otp') || $errors->otp->any())
            $(`#modal-3`).fadeIn("fast");
        @endif

        @if(session()->has('open_reset_modal'))
            $(`#modal-9`).fadeIn("fast");
        @endif

        @if(session()->has('reset_otp'))
            $(`#modal-10`).fadeIn("fast");
        @endif

        @if(session()->has('open_reset'))
            $(`#modal-11`).fadeIn("fast");
        @endif
    });

    function open_card() {
        $(".basket_overlay").fadeIn("fast");
        $(".basket_inner").addClass("active_basket");
    }
</script>

</body>
</html>
