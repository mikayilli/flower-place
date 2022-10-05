<template>
    <div class="right_column">
        <div class="product_items product_slider_popup">
            <div class="item" v-for="product in filteredProducts">
                <div class="img">
                    <img :src="frontUrl + '/storage/products/thumb_' + product.image" alt="#" />
                    <div class="sale" v-if="product.discount">
                        <img src="/assets/images/icons/saleBg.svg" alt="#" />
                        <span>{{ product.discount.percent }}%</span>
                    </div>
                    <div class="bottom_actions">
                        <add-to-favorite :product="product" :url="getProductUrl(product.slug)">
                            <button type="button" class="btn_action_cr">
                                <img src="/assets/images/icons/heart.svg" alt="#" />
                            </button>
                        </add-to-favorite>
                        <add-to-card :product="product">
                            <button type="button" class="btn_action_cr">
                                <img src="/assets/images/icons/basket.svg" alt="#">
                            </button>
                        </add-to-card>
                        <button
                            type="button"
                            class="btn_action_cr show_btn"
                            href="/assets/images/img/product2.png"
                        >
                            <img src="/assets/images/icons/eyeVisible.svg" alt="#" />
                        </button>
                    </div>
                </div>
                <div class="content">
                    <div class="content_title">
                        <span class="name">{{ product.name }}</span>
                        <div class="rating">
                            <span>4,2</span>
                            <img src="/assets/images/icons/star.svg" alt="#" />
                        </div>
                    </div>
                    <span class="price_product">{{ getPrice(product) }} руб.</span>
                    <a :href="getProductUrl(product.slug)" class="order_btn">Заказать</a>
                </div>
            </div>
        </div>
        <div class="exclusive_gift" :style="'background-image: url(' + frontUrl + '/assets/images/img/homeMainImg.png)'">
            <div class="inner_block">
                <h3 class="title_gift">Эксклюзивный подарочный набор</h3>
                <a href="#" class="order_btn"> Заказать </a>
            </div>
        </div>
    </div>
</template>

<script>
import AddToCard from "./AddToCard";
import AddToFavorite from "./AddToFavorite";
export default {
    components: {AddToCard, AddToFavorite},
    props: [
        "products",
        "categories",
        "collection",
        "priceSort"
    ],
    name: "Products",
    data: function() {
        return {
            frontUrl: window.frontBaseUrl
        }
    },
    methods: {
        getPrice(item) {
            if(item.discount) {
                return +item.price - (+item.price * (+item.discount.percent)) / 100;
            }

            return item.price;
        },
        getProductUrl(productSlug) {
            if(!this.collection)
                return [this.frontUrl, ...this.categories, productSlug].join("/");
            else {
                return [this.frontUrl,this.collection, productSlug].join("/");
            }
        }
    },
    computed: {
        filteredProducts(){
            let products = this.products;

            return products.sort((a, b) => {
                if(this.priceSort === 'asc')
                    return this.getPrice(a) - this.getPrice(b);

                return this.getPrice(b) - this.getPrice(a);
            })
        }
    }
}
</script>

<style scoped>

</style>
