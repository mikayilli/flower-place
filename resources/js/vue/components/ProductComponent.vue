<template>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <input type="text" v-model="filter.name" :delay="500"
                                       class="form-control form-control-sm" placeholder="Name"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col">
                                <select v-model="filter.status" class="form-control form-control-sm"
                                        v-on:change="searchFilter">
                                    <option value="">---- select ----</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col">
                                <a :href="backBaseUrl +'/products/create'" class="btn btn-info btn-xs" title="Create"><i
                                    class="fa fa-plus-circle"></i></a>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>By User</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( product, index) in products.data">
                                <td>{{ product.user.full_name }}</td>
                                <td>
                                    <img v-if="product.image" :src="'/storage/products/'+ product.image" alt="" class="img-bordered-sm img-circle">
                                </td>
                                <td>{{ product.name }}</td>
                                <td>{{ product.price }}</td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': product.status == 1, 'fa-times-circle': product.status == 0}"></i>
                                </td>
                                <td><a :href="backBaseUrl + '/products/' + product.id + '/additions'"
                                       class="btn btn-dark btn-xs" title="View products"><i class="far fa-eye"></i></a>
                                </td>
                                <td>
                                    <a :href="backBaseUrl+'/products/'+product.id+'/edit/'" class="btn btn-warning btn-xs"
                                       title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger btn-xs" v-on:click="del(product.id, index)"
                                            title="Delete"><i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!products.data.length" class="text-center text-bold p-5">
                                    The product does not exist!
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 text-center">
                <pagination class="" :data="products" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>
import swal from "../partial/swal";

export default {
    name: "ProductComponent",
    data: function () {
        return {
            products: {
                data: []
            },
            backBaseUrl: window.backBaseUrl,
            filter: {name: '', status: ''}
        }
    },
    methods: {
        getData(page = 1) {
            axios.post(this.backBaseUrl + '/products/filter?page=' + page, this.filter)
                .then(response => {
                    if (response.data)
                        this.products = response.data;
                });
        },
        async searchFilter() {
            this.getData(1);
        },
        del(id, index) {
            swal.swalConfirmMethod().then((result) => {
                if (result) {
                    axios.delete(this.backBaseUrl + '/products/' + id)
                        .then(response => {
                            this.products.data.splice(index, 1);
                            swal.swalDeleteAlert();
                        });
                }
            });
        }
    },
    mounted() {
        this.getData();
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
