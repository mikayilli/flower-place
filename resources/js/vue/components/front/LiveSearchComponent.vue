<template>
    <div class="right_column">
        <form action="#" class="input_form" autocomplete="off">
            <img src="/assets/images/icons/search.svg" alt="#" />
            <input
                type="search"
                id="search_input"
                placeholder="Поиск"
                v-model="filter.name"
                @input="search"
            />
        </form>
        <div class="search_result_block"  v-if="products.length">
            <div class="items">
                <a :href="frontUrl +'/' + product.slug" class="item" v-for="product in products">
                    <div class="left">
                        <img
                            class="img"
                            :src="frontUrl + '/storage/products/thumb_' + product.image"
                            alt="#"
                        />
                        <span class="item_name">{{  product.name }}</span>
                    </div>
                    <span class="price">{{ getPrice(product) }} руб.</span>
                </a>
            </div>
            <a :href="frontUrl + '/search?name=' + filter.name" class="show_all" v-if="products.length >= 4"> смотреть все </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "LiveSearchComponent",
    data: function() {
        return {
            filter: {name: '', limit: 'live'},
            frontUrl: window.frontBaseUrl,
            products: [],
            timeout: null
        }
    },
    methods: {
        getPrice(item) {
            if(item.discount) {
                return item.price - (item.price * (+item.discount.percent)) / 100;
            }

            return item.price;
        },
        search() {
            clearTimeout(this.timeout)
            this.timeout = setTimeout(() => {
                if(!this.filter.name || this.filter.name === '') {
                    this.products = [];
                    return;
                }
                axios.post(this.frontUrl + "/products/filter?page=1", this.filter).then(response => {
                    this.products = response.data.data;
                });
            }, 300);
        }
    }
}
</script>

<style scoped>
    .search_result_block {
        display: block !important;
    }
</style>
