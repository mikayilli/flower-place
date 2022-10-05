@extends('front.panel.partials.main')
@section('css')
    <style>
        .color-red {
            color:red
        }
    </style>
@endsection
@section('page')
    <div class="right_column">
        <div class="mobile_head_block">
            <span class="title">Мои данные</span>
        </div>
        <div class="settings_form">
            <form action="{{ route('panel.update') }}" method="post">
                @csrf
                @method("PATCH")
                <div class="input">
                    <label for="name">Ваше Имя/Фамилия</label>
                    <input type="text" name="full_name" id="full_name" placeholder="Ваше Имя/Фамилия" value="{{ $user->full_name }}" />
                    @error('full_name')<span class="color-red">{{ $message }}</span>@enderror

                </div>
                <div class="input">
                    <label for="number">Номер телефона</label>
                    <input
                        type="number"
                        id="number"
                        placeholder="Номер телефона"
                        value="{{ $user->phone }}"
                        name="phone"
                    />
                    @error('phone')<span class="color-red">{{ $message }}</span>@enderror
                </div>
                <div class="input">
                    <label for="email">E-mail</label>
                    <input
                        type="email"
                        id="email"
                        placeholder="E-mail"
                        value="{{ $user->email }}"
                        name="email"
                    />
                    @error('email')<span class="color-red">{{ $message }}</span>@enderror
                </div>
                <div class="input">
                    <label for="password">Текущий пароль</label>
                    <input
                        type="password"
                        id="password"
                        placeholder="Текущий пароль"
                        name="password"
                    />
                    @error('password')<span class="color-red">{{ $message }}</span>@enderror
                </div>
                <div class="input">
                    <label for="password2">Новый пароль</label>
                    <input
                        type="password"
                        id="password2"
                        placeholder="Новый пароль"
                        name="password_confirmation"
                    />
                </div>
                <button type="submit" class="btn_submit">
                    Сохранить изменения
                </button>
            </form>
        </div>
    </div>
@endsection

