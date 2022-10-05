<template>
    <div class="right_column address_block_right">
        <div class="mobile_head_block">
            <span class="title">Мой адресс</span>
        </div>
        <div class="address_block">
            <div class="address_head">
                <form action="#" class="input_form">
                    <input type="text" placeholder="Поиск" name="#" />
                    <img :src="frontUrl + '/assets/images/icons/search.svg'" alt="#" />
                </form>
                <div class="right">
                    <select class="select">
                        <option value="#">Старые</option>
                        <option value="#">empty</option>
                        <option value="#">empty</option>
                        <option value="#">empty</option>
                    </select>
                    <button type="button" class="btn_add_address">
                        Добавить адресс
                    </button>
                </div>
            </div>
            <div class="address_table">
                <div class="table">
                    <table>
                        <tr>
                            <th>№</th>
                            <th>Имя/Фамилия</th>
                            <th>Адресса доставки</th>
                            <th>Телефон</th>
                            <th>Поводы</th>
                        </tr>
                        <tr v-for="(address, index) in addresses.data">
                            <td>{{ index + 1 }}</td>
                            <td>{{ address.full_name}}</td>
                            <td class="adress_td">
                                <span>г. Москва, Можайское шоссе, д. 41,к.1.</span>
                            </td>
                            <td>+7 (400) 727-14-06</td>
                            <td class="motives">
                                <span> День рождения </span>
                                <button type="button" class="btn_edit_remember">
                                    <img src="/assets/images/icons/edit.svg" alt="#" />
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <pagination class="" :data="addresses" @pagination-change-page="getAddress"></pagination>
<!--            <ul class="pagination">-->
<!--                <li class="left_icn">-->
<!--                    <a href="#">-->
<!--                        <img src="../assets/images/icons/arrowLeft.svg" alt="#" />-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#1"> 1 </a>-->
<!--                </li>-->
<!--                <li class="active_li">-->
<!--                    <a href="#2"> 2 </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#3"> 3 </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#4"> 4 </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#5"> 5 </a>-->
<!--                </li>-->
<!--                <li>...</li>-->
<!--                <li>-->
<!--                    <a href="#5"> 728 </a>-->
<!--                </li>-->
<!--                <li class="right_icn">-->
<!--                    <a href="#">-->
<!--                        <img src="../assets/images/icons/arrowRight.svg" alt="#" />-->
<!--                    </a>-->
<!--                </li>-->
<!--            </ul>-->
        </div>
        <div class="edit_adress_block">
            <div class="edit_block_inner">
                <div class="left_column_edit">
                    <div class="input">
                        <label for="name">Ваше Имя/Фамилия</label>
                        <input
                            type="text"
                            id="name"
                            placeholder="Ваше Имя/Фамилия"
                        />
                    </div>
                    <div class="input">
                        <label for="name">Номер телефона</label>
                        <input type="text" id="name" placeholder="Номер телефона" />
                    </div>
                    <div class="input">
                        <label for="name">Адресс доставки</label>
                        <input
                            type="text"
                            id="name"
                            placeholder="Адресс доставки"
                        />
                    </div>
                </div>
                <div class="right_column_edit">
                    <span class="edit_title">Напоминание</span>
                    <p class="desc">
                        Заказы принимаются за сутки до отправления.Наличие цветов
                        уточняйте у продавца.
                    </p>
                    <table>
                        <tr>
                            <th>Поводы</th>
                            <th>Дата</th>
                            <th style="text-align: center">Напомнить</th>
                        </tr>
                        <tr>
                            <td>День рождения</td>
                            <td>19.08.21</td>
                            <td class="remember_td">
                                <label class="custom_checkbox">
                                    <input type="checkbox" />
                                    <span class="checkmark"></span>
                                </label>
                                <button class="remove_btn" type="button">
                                    <img :src="frontUrl + 'assets/images/icons/close.svg'" alt="#" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>День рождения</td>
                            <td>19.08.21</td>
                            <td class="remember_td">
                                <label class="custom_checkbox">
                                    <input type="checkbox" />
                                    <span class="checkmark"></span>
                                </label>
                                <button class="remove_btn" type="button">
                                    <img :src="frontUrl + '/assets/images/icons/close.svg'" alt="#" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>День рождения</td>
                            <td>19.08.21</td>
                            <td class="remember_td">
                                <label class="custom_checkbox">
                                    <input type="checkbox" />
                                    <span class="checkmark"></span>
                                </label>
                                <button class="remove_btn" type="button">
                                    <img :src="frontUrl + '/assets/images/icons/close.svg'" alt="#" />
                                </button>
                            </td>
                        </tr>
                    </table>
                    <div class="edit_foot">
                        <select class="select">
                            <option value="#">Выбрать</option>
                            <option value="#">empty1</option>
                            <option value="#">empty2</option>
                            <option value="#">empty3</option>
                        </select>
                        <div class="input">
                            <input
                                type="text"
                                id="datepicker"
                                placeholder="Выбрать дату"
                                class="date_input"
                            />
                            <img :src="frontUrl + '/assets/images/icons/calendar.svg'" alt="#" />
                        </div>
                    </div>
                    <button type="button" class="add_remember">
                        Добавить повод
                    </button>
                    <button type="submit" class="btn_save_edit">
                        Сохранить изменения
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddressComponent",
    data: function(){
        return {
            frontUrl: window.frontBaseUrl + "/panel",
            filter: {},
            addresses: []
        }
    },
    methods: {
        getAddress() {
            axios.post(frontBaseUrl + "/address", this.filter)
                .then(response => {
                    this.addresses = response.data;
                });
        }
    }
}
</script>

<style scoped>

</style>
