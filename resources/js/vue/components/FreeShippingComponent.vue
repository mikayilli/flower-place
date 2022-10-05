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
                                <a :href="backBaseUrl +'/free-shipping/create'" class="btn btn-info btn-xs" title="Create"><i
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
                                <th>Name</th>
                                <th>Min amount</th>
                                <th>Limit</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( freeShipping, index) in freeShippings.data">
                                <td>{{ freeShipping.user.full_name }}</td>
                                <td>{{ freeShipping.name }}</td>
                                <td>{{ freeShipping.min_amount }}</td>
                                <td>{{ freeShipping.limit }}</td>
                                <td>{{ freeShipping.start_date | moment("DD MMM Y, HH:mm")}}</td>
                                <td>{{ freeShipping.end_date | moment("DD MMM Y, HH:mm")}}</td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': freeShipping.status == 1, 'fa-times-circle': freeShipping.status == 0}"></i>
                                <td>
                                    <a :href="backBaseUrl+'/free-shipping/'+freeShipping.id+'/edit/'" class="btn btn-warning btn-xs"
                                       title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger btn-xs" v-on:click="del(freeShipping.id, index)"
                                            title="Delete"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!freeShippings.data.length" class="text-center text-bold p-5">
                                    The free shipping does not exist!
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
                <pagination class="" :data="freeShippings" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>
import swal from "../partial/swal";

export default {
    name: "FreeShippingComponent",
    data: function () {
        return {
            freeShippings: {
                data: []
            },
            backBaseUrl: window.backBaseUrl,
            filter: {name: '', status: ''}
        }
    },
    methods: {
        getData(page = 1) {
            axios.post(this.backBaseUrl + '/free-shipping/filter?page=' + page, this.filter)
                .then(response => {
                    if (response.data)
                        this.freeShippings = response.data;
                });
        },
        async searchFilter() {
            this.getData(1);
        },
        del(id, index) {
            swal.swalConfirmMethod().then((result) => {
                if (result) {
                    axios.delete(this.backBaseUrl + '/free-shipping/' + id)
                        .then(response => {
                            this.freeShippings.data.splice(index, 1);
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

