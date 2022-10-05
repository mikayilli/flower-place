<template>
    <section class="favorite_products">
        <div class="custom_container_fluid">
            <div class="items product_slider_popup">
                <div class="item" v-for="product in favorites">
                    <div class="img">
                        <img :src="frontUrl + '/storage/products/thumb_' + product.image" alt="#" />
                        <div class="sale" v-if="product.discount">
                            <img src="/assets/images/icons/saleBg.svg" alt="#" />
                            <span>{{  product.discount.percent }}%</span>
                        </div>
                        <div class="bottom_actions">
                            <add-to-favorite :product='product'>
                                <button type="button" class="btn_action_cr">
                                    <img src="/assets/images/icons/heart.svg" alt="#" />
                                </button>
                            </add-to-favorite>
                            <add-to-card :product="product">
                                <button type="button" class="btn_action_cr">
                                    <img src="/assets/images/icons/basket.svg" alt="#" />
                                </button>
                            </add-to-card>
                            <button type="button" :href="frontUrl + '/storage/products/thumb_' + product.image" class="btn_action_cr show_btn">
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
                        <span class="price_product">{{ product.price }} руб.</span>
                        <a :href="product.url" class="order_btn">Заказать</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import AddToCard from "./partials/product/AddToCard";
import AddToFavorite from "./partials/product/AddToFavorite";

export default {
    name: "FavoriteComponent",
    components: {AddToFavorite, AddToCard},
    data: function(){
        return {
            favorites: [],
            frontUrl: window.frontBaseUrl,
        }
    },
    methods: {
        setDb() {
            localStorage.setItem('favorites', JSON.stringify(this.favorites));
            this.$root.$emit('updateFavoriteIconCount', this.favorites.length);

        },
        async getDb(){
            this.favorites = await localStorage.getItem('favorites') ? JSON.parse(localStorage.getItem('favorites')) : [];
            this.$root.$emit('updateFavoriteIconCount', this.favorites.length);
            this.getProducts(this.favorites.map(item => item.slug));
        },
        getProducts(slugs){
            axios.post(this.frontUrl + "/products/filter?page=1", {slugs}).then(response => {
                this.favorites = response.data.data;
                this.setDb();
            });
        }
    },
    mounted() {
        this.getDb();
        this.$root.$on("updateFavorites", favorites => this.favorites = favorites)
    }
}
</script>

<style scoped>
    .item {
        margin-bottom: 50px;
    }
</style>
