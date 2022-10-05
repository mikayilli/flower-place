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
                    <span class="active">/ Как заказать</span>
                </li>
            </ul>
            <div class="page_head_block">
                <h1 class="title_head">Оформление заказа</h1>
                <p>
                    Принимаем заказы круглосуточно и без выходных.Оформить заказ можно
                    на сайте или по телефону
                </p>
            </div>
        </div>
        <section class="how_to_order_sect">
            <div class="custom_container_fluid">
                <div class="left_column">
                    <h3 class="title">Как заказать букет</h3>
                    <div class="list_row">
                        <div class="number_col">
                            <span class="circle"></span>
                            <span class="number">1.</span>
                        </div>
                        <p class="content">
                            Вы можете выбрать наиболее соответствующий букет <br />
                            или обратиться за помощью к нашим консультантам по телефону
                            <br />
                            или на почту
                        </p>
                    </div>
                    <div class="list_row">
                        <div class="number_col">
                            <span class="circle"></span>
                            <span class="number">2.</span>
                        </div>
                        <p class="content">
                            Добавьте нужные цветы в корзину и оформите заказ. <br />
                            Укажите свои контактные данные в оформлении заказа <br />
                            — они нужны, чтобы информировать вас о статусе заказа <br />
                            и отправить чек оплаты
                        </p>
                    </div>
                    <div class="list_row">
                        <div class="number_col">
                            <span class="circle"></span>
                            <span class="number">3.</span>
                        </div>
                        <p class="content">
                            Если вы дарите кому-то, то укажите известные вам данные
                            получателя.<br />
                            Если вы не знаете адреса и удобного времени доставки,<br />
                            оставьте эти поля пустыми и мы сами уточним их у получателя в
                            день доставки
                        </p>
                    </div>
                    <div class="list_row">
                        <div class="number_col">
                            <span class="circle"></span>
                            <span class="number">4.</span>
                        </div>
                        <p class="content">
                            В корзине также есть возможность выбрать шоколад <br />
                            и другие дополнительные подарки
                        </p>
                    </div>
                </div>
                <div class="right_column">
                    <img
                        class="img_bg"
                        src="/assets/images/img/how-to-order-bg.png"
                        alt="#"
                    />
                </div>
            </div>
        </section>
        <div class="mail_row">
            <p>
                Мы всегда готовы помочь вам в выборе букета, оформлении заказа <br />
                или в любых других вопросах. При необходимости свяжитесь с нами по
                телефону <a href="tel:8 (000) 777-0016">8 (000) 777-0016</a> <br />
                или по электронной почте
                <a href="mailto:placeflower@yandex.ru.">placeflower@yandex.ru.</a>
            </p>
        </div>
        <section class="faq_section">
            <div class="custom_container_fluid">
                <span class="title_faq">Часто задаваемые вопросы</span>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
              <span>
                Что делать, если нужного мне населённого пункта Московской
                области нет в вашем списке?
              </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
                    </div>
                </div>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
              <span>
                Отличается ли стоимость доставки в удалённые районы Москвы и
                населённые пункты Московской области?
              </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
                    </div>
                </div>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
                        <span> Как оплатить заказ букета в Москву? </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
                    </div>
                </div>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
                        <span> Как узнать статус заказа? </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
                    </div>
                </div>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
                        <span> Как изменить или отменить заказ? </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
                    </div>
                </div>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
                        <span> Чем отличаются три варианта букета, представленные на странице с описанием? </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
                    </div>
                </div>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
                        <span> Вы гарантируете безопасность оплаты банковской картой через интернет? </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
                    </div>
                </div>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
                        <span> Как вы собираете и используете персональную информацию клиентов? </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
                    </div>
                </div>
                <div class="accordion_list">
                    <button class="btn_accordion_list">
              <span>
                Что делать, если нужного мне населённого пункта Московской
                области нет в вашем списке?
              </span>
                        <img src="/assets/images/icons/downArrow.svg" alt="#" />
                    </button>
                    <div class="accordion_list_in">
                        <p>
                            Если вы не обнаружили нужный населённый пункт в списке,
                            свяжитесь с нами по телефону 8 (000) 777-00-16, и мы сообщим вам
                            о возможности и стоимости доставки.
                        </p>
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
