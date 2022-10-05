<template>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <x-alert></x-alert>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <input type="text" v-model="filter.name" :delay="500" class="form-control form-control-sm" placeholder="Name" v-on:input="searchFilter">
                            </div>
                            <div class="col">
                                <input type="text" v-model="filter.phone" :delay="500" class="form-control form-control-sm" placeholder="Phone" v-on:input="searchFilter">
                            </div>
                            <div class="col">
                                <select v-model="filter.status" class="form-control form-control-sm" v-on:change="searchFilter">
                                    <option value="">---- select ----</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                           </div>
                            <div class="col">
                                <a :href="backBaseUrl +'/stores/create'" class="btn btn-info btn-xs" title="Create"><i
                                    class="fa fa-plus-circle"></i></a>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Manager</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( store, index) in stores.data" >
                                <td>{{ store.manager.full_name }}</td>
                                <td>{{ store.name }}</td>
                                <td>{{ store.address }}</td>
                                <td>{{ store.phone }}</td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': store.status == 1, 'fa-times-circle': store.status == 0}"></i>
                                <td>
                                    <a :href="backBaseUrl+'/stores/'+store.id+'/edit/'" class="btn btn-warning btn-xs" title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger btn-xs" v-on:click="del(store.id, index)" title="Delete"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!stores.data.length" class="text-center text-bold p-5">
                                    The store does not exist!
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
                <pagination class="" :data="stores" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>
import swal from "../partial/swal";

export default {
    name: "StoreComponent",
    data: function() {
        return {
            stores: {
                data:[]
            },
            backBaseUrl:window.backBaseUrl,
            filter: {name: '', status: ''}
        }
    },
    methods: {
        getData(page = 1) {
            axios.post(this.backBaseUrl + '/stores/filter?page='+page, this.filter)
                .then(response => {
                    if(response.data)
                        this.stores = response.data;
                });
        },
        async searchFilter() {
            this.getData(1);
        },
        del(id, index){
            swal.swalConfirmMethod().then((result) => {
                if (result) {
                    axios.delete(this.backBaseUrl + '/stores/' + id)
                        .then(response => {
                            this.stores.data.splice(index, 1);
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

