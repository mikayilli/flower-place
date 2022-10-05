<div class="left_column">
    <ul class="side_menu">
        <li @class(["active_li" => request()->routeIs('panel.settings')])>
            <img
                src="../assets/images/icons/cabinet-icons/user.svg"
                alt="#"
            />
            <a href="{{ route('panel.settings') }}"> Мои данные </a>
        </li>
        <li @class(["active_li" => request()->routeIs('panel.orders')])>
            <img
                src="../assets/images/icons/cabinet-icons/flower.svg"
                alt="#"
            />
            <a href="{{ route('panel.orders') }}"> Мои заказы </a>
        </li>
        <li @class(["active_li" => request()->routeIs('panel.address')])>
            <img
                src="../assets/images/icons/cabinet-icons/marker.svg"
                alt="#"
            />
            <a href="{{ route('panel.address') }}"> Адресса </a>
        </li>
        <li>
            <img
                src="../assets/images/icons/cabinet-icons/logout.svg"
                alt="#"
            />
            <a href="./settings.html"> Выход </a>
        </li>
    </ul>
</div>
