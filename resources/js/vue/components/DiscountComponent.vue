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
                                <input type="number" v-model="filter.min" :delay="500" class="form-control form-control-sm" placeholder="Min" v-on:input="searchFilter">
                            </div>
                            <div class="col">
                                <input type="number" v-model="filter.max" :delay="500" class="form-control form-control-sm" placeholder="Max" v-on:input="searchFilter">
                            </div>
                            <div class="col">
                                <select v-model="filter.status" class="form-control form-control-sm" v-on:change="searchFilter">
                                    <option value="">---- select ----</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                           </div>
                            <div class="col">
                                <a :href="backBaseUrl +'/discounts/create'" class="btn btn-info btn-xs" title="Create"><i
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
                                <th>Percent</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( discount, index) in discounts.data" >
                                <td>{{ discount.user.full_name }}</td>
                                <td>{{ discount.name }}</td>
                                <td>{{ discount.percent }}</td>
                                <td>{{ discount.start_date | moment("DD MMM Y, HH:mm")}}</td>
                                <td>{{ discount.end_date | moment("DD MMM Y, HH:mm")}}</td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': discount.status == 1, 'fa-times-circle': discount.status == 0}"></i>
                                <td>
                                    <a :href="backBaseUrl+'/discounts/'+discount.id+'/edit/'" class="btn btn-warning btn-xs" title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger btn-xs" v-on:click="del(discount.id, index)" title="Delete"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!discounts.data.length" class="text-center text-bold p-5">
                                    The discount does not exist!
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
                <pagination class="" :data="discounts" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>
import swal from "../partial/swal";

export default {
    name: "DiscountComponent",
    data: function() {
        return {
            discounts: {
                data:[]
            },
            backBaseUrl:window.backBaseUrl,
            filter: {name: '', status: ''}
        }
    },
    methods: {
        getData(page = 1) {
            axios.post(this.backBaseUrl + '/discounts/filter?page='+page, this.filter)
                .then(response => {
                    if(response.data)
                        this.discounts = response.data;
                });
        },
        async searchFilter() {
            this.getData(1);
        },
        del(id, index){
            swal.swalConfirmMethod().then((result) => {
                if (result) {
                    axios.delete(this.backBaseUrl + '/discounts/' + id)
                        .then(response => {
                            this.discounts.data.splice(index, 1);
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
