<template>
    <div class="col-12">
        <div class="form-group">
            <label>Search for products</label>
            <input type="text" v-on:input="getProducts" v-model="filter.name" class="form-control">
        </div>
        <table class="table table-hovered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products">
                    <td><img :src="'/storage/products/' + product.image" alt="" class="img-bordered-sm img-circle"></td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>
                        <button class="btn btn-xs btn-info" v-on:click="add(product.id, index)" :disabled="addId === product.id" title="Add"><i class="fa fa-plus-circle"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "ProductFind",
    props: [
        'own-products',
        'categoryId'
    ],
    data: function() {
        return {
            products: [],
            filter: {},
            backBaseUrl: window.backBaseUrl,
            addId: 0
        }
    },
    methods: {
        getProducts(page = 1) {
            axios.post(this.backBaseUrl + '/products/filter', this.filter)
                .then(response => {
                    if(response.data)
                        this.products = response.data.data.filter(item => !this.ids.some(id => id === item.id));
                });
        },
        async searchFilter() {
            this.getProducts(1);
        },
        add(product_id, index) {
            this.addId = product_id;

            axios.post(`${this.backBaseUrl}/categories/${this.categoryId}/product/${product_id}`)
                .then(response => {
                    this.ids.push(product_id);
                    this.products.splice(index, 1);
                }, error => {
                    this.addId = 0;
                });
        }
    },
    mounted() {
        this.getProducts(1)
    },
    computed: {
        ids: function() {
            return this.ownProducts.data.map(item => item.id);
        }
    }
}
</script>

<style scoped>
img {
    height: 40px;
    width: 40px;
}

.fa-check-circle {
    color: #28a745;
}

.fa-times-circle {
    color: #dc3545;
}
</style>

