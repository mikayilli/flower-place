require('./bootstrap');

import Vue from 'vue'

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(require('vue-moment'));

// Admin Components...
import userComponent from './vue/components/userComponent.vue';
import CategoryComponent from "./vue/components/CategoryComponent";
import CollectionComponent from "./vue/components/CollectionComponent";
import ProductComponent from "./vue/components/ProductComponent";
import ProductFind from "./vue/components/ProductFind";
import ProductCollectionFind from "./vue/components/ProductCollectionFind";
import OriginComponent from "./vue/components/OriginComponent";
import DiscountComponent from "./vue/components/DiscountComponent";
import LabelComponent from "./vue/components/LabelComponent";
import ColorComponent from "./vue/components/ColorComponent";
import PromoComponent from "./vue/components/PromoComponent";
import FreeShippingComponent from "./vue/components/FreeShippingComponent";
import TypeComponent from "./vue/components/TypeComponent";
import ProductAdditionFind from "./vue/components/ProductAdditionFind";
import StoreComponent from "./vue/components/StoreComponent";
import CustomerComponent from "./vue/components/CustomerComponent";
import OrderComponent from "./vue/components/OrderComponent";
import CallRequestComponent from "./vue/components/CallRequestComponent";

var vuejs = new Vue({
    components: {
        userComponent,
        CategoryComponent,
        CollectionComponent,
        ProductComponent,
        ProductFind,
        ProductCollectionFind,
        OriginComponent,
        DiscountComponent,
        LabelComponent,
        ColorComponent,
        PromoComponent,
        FreeShippingComponent,
        TypeComponent,
        ProductAdditionFind,
        StoreComponent,
        CustomerComponent,
        OrderComponent,
        CallRequestComponent
    }
}).$mount("#app");

