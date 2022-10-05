<template>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <input type="text" v-model="filter.code" :delay="500"
                                       class="form-control form-control-sm" placeholder="Code"
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
                                <a :href="backBaseUrl +'/promos/create'" class="btn btn-info btn-xs" title="Create"><i
                                    class="fa fa-plus-circle"></i></a>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Percent</th>
                                <th>Max amount</th>
                                <th>Min amount</th>
                                <th>Fix amount</th>
                                <th>Quantity</th>
                                <th>Current_Q</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( promo, index) in promos.data">
                                <td>{{ promo.code }}</td>
                                <td>{{ promo.type }}</td>
                                <td>{{ promo.percent }}</td>
                                <td>{{ promo.max_amount }}</td>
                                <td>{{ promo.min_amount }}</td>
                                <td>{{ promo.fix_amount }}</td>
                                <td>{{ promo.quantity }}</td>
                                <td>{{ promo.current_quantity }}</td>
                                <td>{{ promo.start_date | moment("DD MMM Y, HH:mm") }}</td>
                                <td>{{ promo.end_date | moment("DD MMM Y, HH:mm") }}</td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': promo.status == 1, 'fa-times-circle': promo.status == 0}"></i>
                                <td>
                                    <a :href="backBaseUrl+'/promos/'+promo.id+'/edit/'" class="btn btn-warning btn-xs"
                                       title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger btn-xs" v-on:click="del(promo.id, index)"
                                            title="Delete"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" v-if="!promos.data.length" class="text-center text-bold p-5">
                                    The promo code does not exist!
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
                <pagination class="" :data="promos" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>
import swal from "../partial/swal";

export default {
    name: "PromoComponent",
    data: function () {
        return {
            promos: {
                data: []
            },
            backBaseUrl: window.backBaseUrl,
            filter: {code: '', status: ''}
        }
    },
    methods: {
        getData(page = 1) {
            axios.post(this.backBaseUrl + '/promos/filter?page=' + page, this.filter)
                .then(response => {
                    if (response.data)
                        this.promos = response.data;
                });
        },
        async searchFilter() {
            this.getData(1);
        },
        del(id, index) {
            swal.swalConfirmMethod().then((result) => {
                if (result) {
                    axios.delete(this.backBaseUrl + '/promos/' + id)
                        .then(response => {
                            this.promos.data.splice(index, 1);
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

