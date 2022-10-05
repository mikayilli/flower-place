require('./bootstrap');

import Vue from 'vue'

Vue.component('pagination', require('laravel-vue-pagination'));

import CardComponent from "./vue/components/front/CardComponent";
import ProductPageComponent from "./vue/components/front/ProductPageComponent";
import AddToCard from "./vue/components/front/partials/product/AddToCard";
import AddAddition from "./vue/components/front/partials/product/AddAddition";
import CheckoutComponent from "./vue/components/front/CheckoutComponent";
import AddressComponent from "./vue/components/front/AddressComponent";
import MiniCardComponent from "./vue/components/front/MiniCardComponent";
import FavoriteComponent from "./vue/components/front/FavoriteComponent";
import AddToFavorite from "./vue/components/front/partials/product/AddToFavorite";
import GoToCheckout from "./vue/components/front/partials/product/GoToCheckout";
import FavoriteCountIcon from "./vue/components/front/partials/product/FavoriteCountIcon";
import CardCountIcon from "./vue/components/front/partials/product/CardCountIcon";
import LiveSearchComponent from "./vue/components/front/LiveSearchComponent";
const app = new Vue({
    components: {
        ProductPageComponent,
        CardComponent,
        AddToCard,
        AddAddition,
        CheckoutComponent,
        AddressComponent,
        MiniCardComponent,
        FavoriteComponent,
        AddToFavorite,
        GoToCheckout,
        FavoriteCountIcon,
        CardCountIcon,
        LiveSearchComponent
    }
}).$mount("#app");
