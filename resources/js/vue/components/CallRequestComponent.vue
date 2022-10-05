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
                                <input type="text" v-model="filter.phone" :delay="500"
                                       class="form-control form-control-sm" placeholder="phone"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col">
                                <select v-model="filter.wp" class="form-control form-control-sm"
                                        v-on:change="searchFilter">
                                    <option value="">---- wp ----</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col">
                                <select v-model="filter.status" class="form-control form-control-sm"
                                        v-on:change="searchFilter">
                                    <option value="">---- status ----</option>
                                    <option value="1">Answered</option>
                                    <option value="0">Unanswered</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Count</th>
                                <th>Date</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Whatsapp</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( call, index) in callRequests.data">
                                <td>{{ call.call_full_name }}</td>
                                <td>{{ call.call_phone }}</td>
                                <td>{{ call.count }}</td>
                                <td>{{ call.date_at}}</td>
                                <td>{{ call.created_at  | moment("DD MMM Y, HH:mm")}}</td>
                                <td>{{ call.updated_at  | moment("DD MMM Y, HH:mm")}}</td>
                                <td>
                                    <i
                                       :class="{'fab fa-whatsapp': call.wp == 1, 'fas fa-times-circle': call.wp == 0}"></i>
                                </td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': call.status == 1, 'fa-times-circle': call.status == 0}"></i>
                                </td>
                                <td>
                                    <a :href="backBaseUrl+'/call-requests/'+call.id" class="btn btn-dark btn-xs"
                                       title="View"><i class="fas fa-phone"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!callRequests.data.length" class="text-center text-bold p-5">
                                    The call request does not exist!
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
                <pagination class="" :data="callRequests" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>

export default {
    name: "CallRequestComponent",
    data: function () {
        return {
            callRequests: {
                data: []
            },
            backBaseUrl: window.backBaseUrl,
            filter: {name: '', phone: '', status: '', wp: ''}
        }
    },
    methods: {
        getData(page = 1) {
            axios.post(this.backBaseUrl + '/call-requests/filter?page=' + page, this.filter)
                .then(response => {
                    if (response.data)
                        this.callRequests = response.data;
                });
        },
        async searchFilter() {
            this.getData(1);
        }
    },
    mounted() {
        this.getData();
    }
}
</script>

<style scoped>

.fa-check-circle, .fa-whatsapp {
    color: #28a745;
}

.fa-times-circle {
    color: #dc3545;
}
</style>
