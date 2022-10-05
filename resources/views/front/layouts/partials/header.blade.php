<header>
    <div class="top_of_header">
        <div class="custom_container_fluid">
            <div class="left_column">
                <div class="card_logos">
                    <img src="/assets/images/icons/mir.svg" alt="#" width="52px" height="15px">
                    <img src="/assets/images/icons/masterLogo.svg" alt="#" width="36px" height="20px">
                    <img src="/assets/images/icons/visaLogo.svg" alt="#" width="45px" height="45px">
                </div>
                <p class="top_label">
                    Бесплатная доставка для всех заказов от 2000 RUB
                </p>
            </div>
            <div class="right_column">
                @if(!auth('customer')->check())
                    <button type="button" class="btn_login btn_popup" data-id="modal-1" >Войти</button>
                @else
                    <button type="button" class="btn_login btn_popup" >{{ auth('customer')->user()->full_name }}</button>
                @endif
                <a href="#" class="top_label">Oтслеживание вашего заказа</a>
            </div>
        </div>
    </div>
    <div class="center_of_header">
        <div class="custom_container_fluid">
            <a href="{{ route('front-home') }}">
                <img class="logo" src="/assets/images/icons/siteLogo.svg" alt="#"></a>
            <ul class="center_menu">
                <li>
                    <a href="{{route('shipping')}}"> Доставка и оплата </a>
                </li>
                <li>
                    <a href="{{route('how-to-order')}}"> Как заказать </a>
                </li>
                <li>
                    <a href="{{route('comments')}}"> Отзывы </a>
                </li>
                <li>
                    <a href="{{route('stores')}}"> Магазины </a>
                </li>
            </ul>
            <div class="right_column">
                <a href="tel:8 (000) 777-0016" class="phone_number">8 (000) 777-0016</a>
                <div class="social_icons">
                    <a href="#">
                        <img src="/assets/images/icons/social-icons/whatsapp.svg" alt="#">
                    </a>
                    <a href="#">
                        <img src="/assets/images/icons/social-icons/telegram.svg" alt="#">
                    </a>
                </div>
                <div class="action_buttons">
                    @auth('customer')
                        <button type="button" class="btn_profile">
                            <img src="/assets/images/icons/user.svg" alt="#">
                        </button>
                        <div class="profile_menu" style="display: none;">
                            <ul>
                                <li>
                                    <a href="{{ route('panel.settings') }}" class="btn_menu">Мои данные</a>
                                </li>
                                <li>
                                    <a href="{{ route('panel.orders') }}" class="btn_menu">Мои заказы</a>
                                </li>
                                <li>
                                    <a href="{{ route('panel.address') }}" class="btn_menu">Адресса</a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.logout') }}" class="btn_menu">Выход</a>
                                </li>
                            </ul>
                        </div>
                    @endauth
                    <favorite-count-icon :url="'{{ route('favorites') }}'"></favorite-count-icon>
                    <card-count-icon></card-count-icon>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_of_header">
        <div class="custom_container_fluid">
            <div class="left_column">
                <ul class="bottom_menu">
                    @foreach($categories as $category)
                    <li>
                        <span>{{ $category->name }}</span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#">
                        <div class="sub_menu">
                            @foreach($category->children as $child)
                                <div class="menu_inner">
                                    <a href="{{ route("menu.categories",[ "parent" => $category->slug, "child" => $child->slug]) }}" @class(["menu_title" => $child->children->count()])>{{ $child->name }}</a>
                                    @if($child->children)
                                        <ul>
                                            @foreach($child->children as $grandchild)
                                                <li>
                                                    <a href="{{ route("menu.categories",[ "parent" => $category->slug, "child" => $child->slug, "grandchild" => $grandchild->slug])  }}">{{ $grandchild->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </li>
                    @endforeach
                    <a href="{{ route('sales.index') }}" class="sales_link">Скидки %</a>
                </ul>
            </div>
            <live-search-component></live-search-component>
        </div>
    </div>
    <div class="mobile_header">
        <div class="mobile_header_top">
            <img src="/assets/images/icons/delivery.svg" alt="#">
            <span class="head_title">
            Бесплатная доставка по Москве при заказе от 2500 руб.
          </span>
        </div>
        <div class="mobile_header_bottom">
            <div class="left_column">
                <button type="button" class="mobile_btn_menu">
                    <img src="/assets/images/icons/hamburger.svg" alt="#">
                </button>
            </div>
            <div class="center_column">
                <a href="{{ route('front-home') }}" class="logo">
                    <img src="/assets/images/icons/siteLogo.svg" alt="#">
                </a>
            </div>
            <div class="right_column">
                @auth('customer')
                    <button type="button" class="btn_right_action btn_profile">
                        <img src="/assets/images/icons/user.svg" alt="#">
                    </button>
                    <div class="profile_menu">
                        <ul>
                            <li>
                                <a href="{{ route("panel.settings") }}" class="btn_menu">Мои данные</a>
                            </li>
                            <li>
                                <a href="{{ route("panel.orders") }}" class="btn_menu">Мои заказы</a>
                            </li>
                            <li>
                                <a href="{{ route("panel.address") }}" class="btn_menu">Адресса</a>
                            </li>
                            <li>
                                <a href="{{ route("customer.logout") }}" class="btn_menu">Выход</a>
                            </li>
                        </ul>
                    </div>
                @endauth
                <a href="{{ route('favorites') }}" type="button" class="btn_right_action">
                    <img src="/assets/images/icons/heart.svg" alt="#">
                </a>
                <button type="button" class="btn_right_action btn_basket">
                    <img src="/assets/images/icons/basket.svg" alt="#">
                </button>
            </div>
        </div>
    </div>
    <div class="mobile_overlay">
        <div class="overlay_inner">
            <div class="menu">
                <div class="center">
                    <div class="head">
                        <button type="button" class="close_menu">
                            <img src="/assets/images/icons/close.svg" alt="#">
                        </button>
                        <button type="button" class="search_btn">
                            <img src="/assets/images/icons/search.svg" alt="#">
                        </button>
                    </div>
                    <ul class="top_menu">
                        <li>
                            <a href="{{route('shipping')}}"> Доставка и оплата </a>
                        </li>
                        <li>
                            <a href="{{route('how-to-order')}}">Как заказать</a>
                        </li>
                        <li>
                            <a href="{{route('comments')}}">Отзывы</a>
                        </li>
                        <li>
                            <a href="{{route('stores')}}">Магазины</a>
                        </li>
                    </ul>
                    <ul class="menu_list">
                        @foreach($categories as $category)
                            <li>
                                <div class="list accordion_btn">
                                    <span> {{ $category->name }} </span>
                                    <img src="/assets/images/icons/downArrow.svg" alt="">
                                </div>
                                @if($category->children)
                                    <ul class="submenu accordion">
                                        @foreach($category->children as $child)
                                            <li>
                                                <div class="list accordion_btn">
                                                    <a href="{{ route("menu.categories",[ "parent" => $category->slug, "child" => $child->slug]) }}">{{ $child->name }}</a>
                                                    <img src="/assets/images/icons/downArrow.svg" alt="">
                                                </div>
                                                @if($child->children)
                                                    <ul class="submenu accordion">
                                                        @foreach($child->children as $grandchild)
                                                            <li>
                                                                <a href="{{ route("menu.categories",[ "parent" => $category->slug, "child" => $child->slug, "grandchild" => $grandchild->slug])  }}">
                                                                    <span>{{ $grandchild->name }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                            <a href="{{ route('sales.index') }}" class="sales_link">Скидки %</a>
                    </ul>
                </div>
                <div class="foot">
                    <div class="contact_foot">
                        <span class="number">8 (000) 777-0016</span>
                        <div class="social_icons">
                            <a href="#">
                                <img src="/assets/images/icons/social-icons/whatsapp.svg" alt="#">
                            </a>
                            <a href="#">
                                <img src="/assets/images/icons/social-icons/telegram.svg" alt="#">
                            </a>
                            <a href="#">
                                <img src="/assets/images/icons/social-icons/insta.svg" alt="#">
                            </a>
                        </div>
                    </div>
                    <p class="desc_foot">
                        Бесплатная доставка по Москве для всех заказов от 2000 RUB
                    </p>
                    <a href="#" class="follow_order_btn">
                        Oтслеживание вашего заказа
                    </a>
                    <div class="card_types">
                        <img src="/assets/images/icons/masterLogo.svg" alt="#" width="53px" height="25px">
                        <img style="position: relative; top: 2px; left: -5px" src="/assets/images/icons/visaLogo.svg" alt="#" width="45px" height="40px">
                        <img src="/assets/images/icons/mir.svg" alt="#" width="42px" height="12px">
                    </div>
                </div>
            </div>
        </div>
        <div class="search_block">
            <div class="search_inner">
                <button type="button" class="close_menu">
                    <img src="/assets/images/icons/close.svg" alt="#">
                </button>
                <form action="#">
                    <input type="text" placeholder="Поиск">
                    <button type="submit">
                        <img src="/assets/images/icons/search.svg" alt="#">
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
