@extends('front.layouts.main')


@section('css')
    <link
        rel="stylesheet"
        href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
    />
@endsection

@section('main')
    <div class="custom_container_fluid">
        <ul class="bread_crumb">
            <li>
                <span>Flower place</span>
            </li>
            <li>
                <span>/ Кому</span>
            </li>
            <li>
                <span>/ Маме</span>
            </li>
            <li>
                <span>/ Нежность</span>
            </li>
            <li>
                <span class="active">/ Корзина</span>
            </li>
        </ul>
        <checkout-component :user='@json($user)'></checkout-component>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            // $("#datepicker").datepicker();
            $("#column2").find("input, select, button").attr("disabled", true);
            $("#column3").find("input, select, button").attr("disabled", true);
            // $(".required_error").fadeOut()

            $('.datepickerMy').datetimepicker({
                format: 'DD/MM/YYYY HH:mm:ss'
            });
        });
    </script>
@endsection
