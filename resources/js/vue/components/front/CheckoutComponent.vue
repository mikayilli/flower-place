<template>
    <div class="card_page_block">
        <div class="card_page_inner">
            <div class="columns_card">
                <!-- cards -->
                <div class="column_card">
                    <div class="column_head">
                        <span class="column_head_nav" data-id="column1">Корзина</span>
                        <span class="head_price">{{ getTotalPrice(cards) }} руб</span>
                    </div>
                    <div class="column_main" id="column1">
                        <div class="item" v-for="(card, index) in cards">
                            <div class="left_column">
                                <div class="img">
                                    <img :src="frontUrl + '/storage/products/thumb_' + card.image" alt="#"/>
                                </div>
                                <span class="info" v-if="card.height">Длина: {{ card.height }} см</span>
                            </div>
                            <div class="right_column">
                                <div class="right_top">
                                    <div class="head_column">
                                        <span class="item_title"> {{ card.name }} </span>
                                        <button type="button" class="btn_trash" @click="remove(index)">
                                            <img src="/assets/images/icons/trash.svg" alt="#"/>
                                        </button>
                                    </div>
                                    <div class="counter">
                                        <button type="button" class="decrease" @click="decrease(card)">
                                            <img src="/assets/images/icons/minus.svg" alt="#"/>
                                        </button>
                                        <span class="count">{{ card.count }}</span>
                                        <button type="button" class="increase" @click="increase(card)">
                                            <img src="/assets/images/icons/pluse.svg" alt="#"/>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <span class="sale_price" v-if="card.discount">{{ card.price }}  руб.</span>
                                    <span class="price"> {{ getPrice(card) }}  руб. </span>
                                </div>
                            </div>
                        </div>

                        <span class="item-span" v-for="(card, cardIndex) in cards" v-if="card.items.length">
                            <div class="item" v-for="(item, index) in card.items">
                                <div class="left_column">
                                    <div class="img">
                                        <img :src="frontUrl + '/storage/products/thumb_' + item.image" alt="#"/>
                                    </div>
                                    <span class="info" v-if="item.height">Длина: {{ item.height }} см</span>
                                </div>
                                <div class="right_column">
                                    <div class="right_top">
                                        <div class="head_column">
                                            <span class="item_title"> {{ item.name }} </span>

                                            <button type="button" class="btn_trash"
                                                    @click="removeItem(cardIndex, index)">
                                                <img src="/assets/images/icons/trash.svg" alt="#"/>
                                            </button>
                                        </div>
                                        <div class="counter">
                                            <button type="button" class="decrease" @click="decrease(item)">
                                                <img src="/assets/images/icons/minus.svg" alt="#"/>
                                            </button>
                                            <span class="count">{{ item.count }}</span>
                                            <button type="button" class="increase" @click="increase(item)">
                                                <img src="/assets/images/icons/pluse.svg" alt="#"/>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="info_item">
                                        <span class="info_title">{{ item.type.name }}</span>
                                        <span class="info_desc" v-if="item.type.description">({{ item.type.description }})</span>
                                      </div>
                                    <div>
                                        <span class="sale_price" v-if="item.discount">{{ getPriceWithDiscount(item) }}  руб.</span>
                                        <span class="price"> {{ getItemPrice(item) }}  руб. </span>
                                    </div>
                                </div>
                            </div>
                        </span>
                        <div class="foot_column">
                            <div class="head_foot_column">
                                <span>Итог</span>
                                <span>{{ getTotalPrice(cards) }} руб</span>
                            </div>
                            <button type="button" class="btn_confirm" @click="step.delivery_active = true">
                                Подтвердить
                            </button>
                        </div>
                    </div>
                </div>

                <!-- delivery -->
                <div class="column_card">
                    <div class="column_head">
                        <span class="column_head_nav" data-id="column2">Доставка</span>
                    </div>
                    <div :class="{'disable_column': !step.delivery_active, 'column_main': true }" id="column2">
                        <div class="flexable_checkbox_courier">
                            <div class="checkboxes">
                                <label
                                    class="custom_checkbox btn_tab"
                                    data-id="courier_teb"
                                >
                                    Доставка
                                    <input type="radio" name="courier" :disabled="!step.delivery_active" v-model="checkout.delivery.method" value="delivery"/>
                                    <span class="checkmark radio_checkmark"></span>
                                </label>

                                <label class="custom_checkbox btn_tab" data-id="tome">
                                    Доставка мне
                                    <input type="radio" name="courier" :disabled="!step.delivery_active"   v-model="checkout.delivery.method" value="tome"/>
                                    <span class="checkmark radio_checkmark"></span>
                                </label>

                                <label class="custom_checkbox btn_tab" data-id="pikap">
                                    Самовывоз
                                    <input type="radio" name="courier" :disabled="!step.delivery_active"   v-model="checkout.delivery.method" value="pickup"/>
                                    <span class="checkmark radio_checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="tabs_container">
                            <!-- 1 -->
                            <div class="tab delivery" :class="{'active_tab': checkout.delivery.method === 'delivery'}">
                                <div class="input">
                                    <label for="d_name">Имя/Фамилия отправителя *</label>
                                    <input
                                        class="required"
                                        type="text"
                                        id="d_name"
                                        placeholder="Имя/Фамилия отправителя"
                                        v-model="checkout.delivery.sender.full_name"
                                    />
                                    <span class="required_error">Required</span>
                                </div>
                                <div class="input agree_check">
                                    <label for="d_phone">Телефон *</label>
                                    <input
                                        class="required"
                                        type="number"
                                        id="d_phone"
                                        placeholder="+7(000)    ***  **  *** "
                                        v-model="checkout.delivery.sender.phone"
                                    />
                                    <span class="required_error">Required</span>
                                </div>

                                <div class="input">
                                    <label for="recipient_name">Имя/Фамилия отправителя *</label>
                                    <input
                                        class="required"
                                        type="text"
                                        id="recipient_name"
                                        placeholder="Имя/Фамилия отправителя"
                                        v-model="checkout.delivery.recipient.full_name"
                                    />
                                    <span class="required_error">Required</span>
                                </div>
                                <div class="input">
                                    <label for="recipient_phone">Телефон *</label>
                                    <input
                                        class="required"
                                        type="number"
                                        id="recipient_phone"
                                        placeholder="+7(000)    ***  **  *** "
                                        v-model="checkout.delivery.recipient.phone"
                                    />
                                    <span class="required_error">Required</span>
                                </div>

                                <div class="input">
                                    <label for="email">Адрес *</label>
                                    <select class="select required" v-model="checkout.delivery.address.county">
                                        <option value="#">Округ</option>
                                        <option value="#">Округ 2</option>
                                        <option value="#">Округ 3</option>
                                    </select>
                                    <span class="required_error">Required</span>
                                </div>
                                <div class="input">
                                    <input
                                        type="text"
                                        class="required"
                                        id="dom1"
                                        placeholder="ул. Примерная,  дом 1"
                                        v-model="checkout.delivery.address.address"
                                    />
                                    <span class="required_error">Required</span>
                                </div>

                                <div class="input col-50 f-l">
                                    <label for="datepicker">Дата/время *</label>
                                    <input
                                        type="text"
                                        placeholder="Выбрать дата/время"
                                        class="date_input datepickerMy required"
                                        v-model="checkout.delivery.send_date"
                                    />
                                    <span class="required_error">Required</span>
                                </div>
                                <div class="input col-50 f-r">
                                    <label for="datepicker">Дата/время *</label>
                                    <input
                                        type="text"
                                        placeholder="Выбрать дата/время"
                                        class="date_input datepickerMy required"
                                        v-model="checkout.delivery.send_time"
                                    />
                                    <span class="required_error">Required</span>
                                </div>

                                <label class="custom_checkbox agree_check clear-fix">
                                    Доставить анонимно
                                    <input type="checkbox" v-model="checkout.delivery.recipient.anonymous"/>
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <!-- 2 -->
                            <div class="tab tome" :class="{'active_tab': checkout.delivery.method === 'tome'}">
                                <div class="input">
                                    <label for="d_name">Имя/Фамилия отправителя *</label>
                                    <input
                                        class="required"
                                        type="text"
                                        id="name"
                                        placeholder="Имя/Фамилия отправителя"
                                        v-model="checkout.delivery.sender.full_name"
                                    />
                                    <span class="required_error">Required</span>
                                </div>
                                <div class="input agree_check">
                                    <label for="d_phone">Телефон *</label>
                                    <input
                                        class="required"
                                        type="number"
                                        id="phone"
                                        placeholder="+7(000)    ***  **  *** "
                                        v-model="checkout.delivery.sender.phone"
                                    />
                                    <span class="required_error">Required</span>
                                </div>

                                <div class="input">
                                    <label for="email">Адрес *</label>
                                    <select class="select required" v-model="checkout.delivery.address.county">
                                        <option value="#">Округ</option>
                                        <option value="#">Округ 2</option>
                                        <option value="#">Округ 3</option>
                                    </select>
                                    <span class="required_error">Required</span>
                                    <input
                                        class="required"
                                        type="text"
                                        id="tab_2dom1"
                                        placeholder="ул. Примерная,  дом 1"
                                        v-model="checkout.delivery.address.address"
                                    />
                                    <span class="required_error">Required</span>
                                </div>

                                <div class="input col-50 f-l">
                                    <label for="datepicker">Дата/время *</label>
                                    <input
                                        type="text"
                                        placeholder="Выбрать дата/время"
                                        class="date_input datepickerMy"
                                        v-model="checkout.delivery.send_date"
                                    />
                                </div>
                                <div class="input col-50 f-r">
                                    <label for="datepicker">Дата/время *</label>
                                    <input
                                        type="text"
                                        placeholder="Выбрать дата/время"
                                        class="date_input datepickerMy"
                                        v-model="checkout.delivery.send_time"
                                    />
                                </div>
                            </div>

                            <!-- 3 -->
                            <div class="tab pickup"  :class="{'active_tab': checkout.delivery.method === 'pickup'}">
                                <div class="pikap_block">
                                    <div class="input">
                                        <label for="d_name">Имя/Фамилия отправителя *</label>
                                        <input
                                            class="required"
                                            type="text"
                                            id="d_name"
                                            placeholder="Имя/Фамилия отправителя"
                                            v-model="checkout.delivery.sender.full_name"
                                        />
                                        <span class="required_error">Required</span>
                                    </div>
                                    <div class="input agree_check">
                                        <label for="d_phone">Телефон *</label>
                                        <input
                                            class="required"
                                            type="number"
                                            id="d_phone"
                                            placeholder="+7(000)    ***  **  *** "
                                            v-model="checkout.delivery.sender.phone"
                                        />
                                        <span class="required_error">Required</span>
                                    </div>

                                    <span class="pikap_title">
                                        Выберите магазин
                                        <br>
                                        <span class="required_error">please select a store</span>
                                    </span>
                                    <label class="custom_checkbox" data-id="pikap"  v-for="store in stores">
                                        <span class="bold_label">{{ store.name }}</span>
                                        <span class="item_check">{{ store.address }}</span>
                                        <span class="item_check">{{ store.phone }}</span>
                                        <input type="radio" name="pikab_radio" v-model="checkout.delivery.pickup" :value="store.slug" checked/>
                                        <span class="checkmark radio_checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn_confirm"
                            @click="changeStep('payment_active')"
                            :disabled="!step.delivery_active"
                        >
                            Перейти к оплате
                        </button>
                    </div>
                </div>

                <!-- payment -->
                <div class="column_card">
                    <div class="column_head">
                        <span class="column_head_nav" data-id="column3">Оплата</span>
                    </div>
                    <div :class="{'disable_column': !step.payment_active, 'column_main': true }" id="column3">
                        <div class="head_payment">
                            <span class="label">Итог</span>
                            <span class="price">{{ getTotalPrice(cards) }} руб</span>
                        </div>
                        <label class="custom_checkbox">
                            Хочу получать информацию о скидках и акциях
                            <input type="checkbox" v-model="checkout.payment.subscribe"/>
                            <span class="checkmark"></span>
                        </label>
                        <label class="custom_checkbox">
                            Я согласен с условиями работы и с обработкой персональных
                            данных *
                            <input type="checkbox"  v-model="checkout.payment.terms"/>
                            <span class="checkmark"></span>
                        </label>
                        <div class="flexable_checkbox">
                            <span class="title_row">Способ оплаты</span>
                            <div class="checkboxes">
                                <label class="custom_checkbox">
                                    Карта
                                    <input type="radio" name="type" value="cart" v-model="checkout.payment.type" checked="checked"/>
                                    <span class="checkmark radio_checkmark"></span>
                                </label>
                                <label class="custom_checkbox">
                                    Наличные
                                    <span class="in_addition">(При доставке) ̰</span>
                                    <input type="radio"  name="type" value="cash" v-model="checkout.payment.type" />
                                    <span class="checkmark radio_checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="input">
                            <label for="promo">Применить промокод</label>
                            <input
                                type="text"
                                id="promo"
                                placeholder="Применить промокод"
                            />
                        </div>
                        <button type="button" class="btn_get_promo">
                            Как получить?
                        </button>
                        <button type="button" class="btn_confirm" @click="order()">Подтвердить</button>
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
    </div>
</template>

<script>
export default {
    name: "CheckoutComponent",
    props: ["user"],
    data: function () {
        return {
            checkout: {
              delivery: {
                  method: 'delivery',
                  sender: {
                       full_name: this.user.full_name,
                       phone: this.user.phone,
                       provide_name: false
                  },
                  recipient: {
                      full_name: "",
                      phone: "",
                      anonymous: false
                  },
                  address: {
                      county : "",
                      address: ""
                  },
                  send_date: null,
                  send_time: null,
                  pickup: null
              },
              payment: {
                  subscribe: false,
                  terms: false,
                  type: "cart"
              }
            },
            cards: [],
            frontUrl: window.frontBaseUrl,
            step: {
                delivery_active: false,
                payment_active: false
            },
            stores: [],
            isOrderProcessing: false,
            isOrdered:false,
        }
    },
    methods: {
        setDb() {
            localStorage.setItem('cards', JSON.stringify(this.cards));
            this.$root.$emit('updateCard', {cardTotal: this.getTotalPrice(this.cards)});
            this.goHomeIfCardEmpty();
        },
        getDb() {
            this.cards = localStorage.getItem('cards') ? JSON.parse(localStorage.getItem('cards')) : [];
            this.goHomeIfCardEmpty();
        },
        goHomeIfCardEmpty(){
            if(!this.cards.length){
                window.location.href= '/';
            }
        },
        getTotalPrice(cards) {
            let total = cards.reduce((current, item) => {
                //get card additions total
                let additionTotal = item.items.reduce((additionCurrent, addition) => additionCurrent + this.getItemPrice(addition), 0);

                //get card total
                return current + this.getPrice(item) + additionTotal;
            }, 0);

            return total.toFixed(2);
        },
        getPrice(item) {
            let size = localStorage.getItem('sizes') ? JSON.parse(localStorage.getItem('sizes')) : null;
            if (item.sizes && size) {
                if ([item.sizes.name_small, item.sizes.name_medium, item.sizes.name_big].includes(size.name) && item.slug === size.slug) {
                    item.price = size.price;
                    this.setSelectedSize(item, size);
                }
            }

            if (item.discount) {
                let price = +item.count * (+item.price)
                return price - (price * (+item.discount.percent)) / 100;
            }

            return +item.count * (+item.price);
        },
        getPriceWithDiscount(item) {
            if (item.discount) {
                let price = +item.count * (+item.price)
                return price - (price * (+item.discount.percent)) / 100;
            }

            return +item.count * (+item.price);
        },
        getItemPrice(item) {
            if (item.addition_discount) {
                let price = +item.count * this.getPriceWithDiscount(item)
                return price - (price * (+item.addition_discount)) / 100;
            }

            return +item.count * (+item.price);
        },
        decrease(card) {
            if (card.count == 1) return;

            card.count -= 1;
            this.setDb();
        },
        increase(card) {
            card.count += 1;
            this.setDb();
        },
        remove(index) {
            this.cards.splice(index, 1);
            this.setDb();
        },
        removeItem(cardIndex, index) {
            this.cards[cardIndex].items.splice(index, 1);
            this.setDb();
        },
        setSelectedSize(product, size) {
            let index = this.cards.findIndex(item => item.slug === product.slug);
            if (index >= 0) {
                this.cards[index].selected_size = size;
            }
        },
        changeStep(step){
            if(!this.validateInputs()) return false;
            this.step[step] = true;
            $(".required_error").removeClass('d-block')
        },
        validateInputs(){
            let mainClass = this.checkout.delivery.method;

            for(let i= 0; i < $(`.${mainClass} .required`).length; i++){
                $(`.${mainClass} .required:eq(${i})`).parents('div').children('.required_error').removeClass("d-block");
                if(! $(`.${mainClass} .required:eq(${i})`).val() ) {
                    $(`.${mainClass} .required:eq(${i})`).parents('div').children('.required_error:last').addClass("d-block");
                    return this.step.payment_active = false;
                }
            }

            if(this.checkout.delivery.method === 'pickup' && !this.checkout.delivery.pickup) {
                $('.pikap_title .required_error').addClass("d-block");
                return false;
            }

            return true;
        },
        order(){
            if(this.isOrdered || this.isOrderProcessing || !this.validateInputs()) return;
            this.isOrderProcessing = true;
            this.checkout.cards = this.cards;
            self = this;
            axios.post(this.frontUrl + "/order", this.checkout)
                .then(response => {
                    // return console.log(response);
                    this.checkPaymentType(response.data.data)
                    this.isOrdered = true;
                }, error => {
                    //show error again
                    this.validateInputs();
                    this.isOrderProcessing = false;
                })
        },
        checkPaymentType(response) {
            if(this.checkout.payment.type === 'cart' && response.paymentUrl) {
                return window.location.href = response.paymentUrl
            }
            $("#modal-7").fadeIn();
            setTimeout(function(){
                self.cards = [];
                self.setDb();
            })
        },
        getStores() {
            axios.post(this.frontUrl + "/stores")
                .then(response => {
                    this.stores = response.data;
                })
        }
    },
    mounted() {
        this.getDb();
        this.$root.$on('updateMyCard', () => {
            this.getDb();
        });
        this.getStores();
    },
    watch: {
        step: {
            handler: function (val, oldVal) {
                if(val.delivery_active) {
                    $("#column2").find("input, select, button").attr("disabled", false);
                }

                if(val.payment_active) {
                    $("#column3").find("input, select, button").attr("disabled", false);
                }
            },
            deep: true
        }
    }
}
</script>

<style scoped>
    .item-span {
        display: block !important;
        border-bottom: 1px solid #10374270;
        margin-bottom: 25px !important;
        padding-bottom: 35px !important;
    }

    .required_error {
        display: none;
        color: red;
    }
    .d-block {
        display: block;
    }

    .col-50{
        width: 49% !important;
    }

    .col-50:nth-last-child(1){
       margin-right: 1%;
    }

    .f-l{
        float: left;
    }

    .f-r{
        float: right;
    }

    .clear-fix {
        clear: both;
    }

</style>
