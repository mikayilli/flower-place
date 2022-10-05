<template>
    <div>
        <filter-head-action @filterChange="getProduct" @changeOrder="changeOrder"></filter-head-action>
        <div class="products_main_block">
            <!-- filter -->
            <filter-side-action
                @filterChange="getProduct"
                :tags="tags"
                :get-params="getParams"
            >

            </filter-side-action>

            <!-- products -->
            <products :products="products" :categories="categories" :collection="currentCollection" :price-sort="price_sort"></products>
        </div>
    </div>
</template>

<script>

import FilterHeadAction from "./partials/product/FilterHeadAction";
import FilterSideAction from "./partials/product/FilterSideAction";
import Products from "./partials/product/Products";
export default {
    components: {Products, FilterSideAction, FilterHeadAction},
    name: "ProductPageComponent",
    props: [
        "categories",
        "mainCategory",
        "currentCollection",
        "tags",
        "name",
        "getParams"
    ],
    data: function(){
        return {
            products: [],
            filter: {
                page: 1
            },
            price_sort: 'asc',
            isLoading: false,
            infiniteScrollFinished: false,
            frontUrl: window.frontBaseUrl,
            debounce:500,
            timeout: null,
            scrollTimeout: null,
            firstCall: true

        };
    },
    methods: {
        getProduct(filter) {
            self = this;
            this.filter = {...this.filter, ...filter};
            clearTimeout(this.timeout)
            this.timeout = setTimeout(() => {
                axios.post(self.frontUrl + '/products/filter?page=' + self.filter.page, self.filter)
                    .then(response => {
                        self.products = response.data.data;
                        self.infiniteScrollFinished = false;

                        this.changeState();
                    });
            }, this.debounce)
        },
        changeOrder(order){
            this.price_sort = order;
        },
        changeState(){
            if(this.firstCall) return this.firstCall = false;

            let url = "";
            for(let zad in this.filter) {
                if((zad != 'category' && zad != 'collection') && this.filter[zad]) {
                    if(typeof this.filter[zad] == 'object') {
                        for(let item in this.filter[zad]){
                            if(typeof this.filter[zad][item] != 'object')
                                url += `${zad}[${item}]=${this.filter[zad][item]}&`;
                        }
                    } else {
                        url += zad + "=" + this.filter[zad] + "&";
                    }
                }
            }
            history.replaceState(null, null, "?" + url);
        },
        onScroll(e) {
            if (!this.infiniteScrollFinished && !this.isLoading && $(window).scrollTop() + $(window).height() >= $(document).height() * 0.6) {
                let page = this.filter.page + 1;
                delete this.filter.page;
                this.isLoading = true;

                clearTimeout(this.scrollTimeout)
                this.scrollTimeout = setTimeout(() => {
                    axios.post(this.frontUrl + '/products/filter?page=' + page, this.filter)
                        .then(response => {
                            this.isLoading = false;
                            if (!response.data.data.length) {
                                return this.infiniteScrollFinished = true;
                            }
                            this.products.push(response.data.data);
                        });
                }, this.debounce);
            }
        }
    },
    mounted() {
        this.filter.category = this.mainCategory;
        this.filter.collection = this.currentCollection;
        window.addEventListener("scroll", this.onScroll)
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.onScroll)
    },
}
</script>

<style scoped>

</style>
