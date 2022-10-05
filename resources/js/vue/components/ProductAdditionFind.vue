<template>
    <div class="col-12">
        <div class="row">
            <div class="form-group  col-md-6 col-12">
                <label>Search for product</label>
                <select v-on:change="getProducts" v-model="filter.type_id" class="form-control">
                    <option value="">-- select --</option>
                    <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label>Search for product</label>
                <input type="text" v-on:input="getProducts" v-model="filter.name" class="form-control">
            </div>
        </div>

        <table class="table table-hovered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products">
                    <td><img :src="'/storage/products/' + product.image" alt="" class="img-bordered-sm img-circle"></td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.type.name }}</td>
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
    name: "ProductAdditionFind",
    props: [
        'own-products',
        'productId'
    ],
    data: function() {
        return {
            products: [],
            types: [],
            filter: {type_id: null},
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
            axios.post(`${this.backBaseUrl}/products/${this.productId}/additions/${product_id}`)
                .then(response => {
                    this.ids.push(product_id);
                    this.products.splice(index, 1);
                }, error => {
                    if(error.response.data.addition)
                        alert(error.response.data.addition)

                    this.addId = 0;
                });
        },
        getTypes() {
            axios.post(`${this.backBaseUrl}/types/filter`)
                .then(response => {
                    this.types = response.data.data;
                }, error => {
                    if(error.response.data.collection)
                        alert(error.response.data.collection)
                });
        }
    },
    mounted() {
        this.getProducts(1)
        this.getTypes();
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
