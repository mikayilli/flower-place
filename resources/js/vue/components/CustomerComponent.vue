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
                                <input type="text" v-model="filter.email" :delay="500"
                                       class="form-control form-control-sm" placeholder="Email"
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
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Block</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( customer, index) in customers.data">
                                <td>{{ customer.full_name }}</td>
                                <td>{{ customer.phone }}</td>
                                <td>{{ customer.email }}</td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': customer.status == 1, 'fa-times-circle': customer.status == 0}"></i>
                                </td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': customer.block == 1, 'fa-times-circle': customer.block == 0}"></i>
                                </td>
                                <td>
                                    <a :href="backBaseUrl+'/customers/'+customer.id+'/view/'" class="btn btn-dark btn-xs"
                                       title="View"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!customers.data.length" class="text-center text-bold p-5">
                                    The customer does not exist!
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
                <pagination class="" :data="customers" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>

export default {
    name: "CustomerComponent",
    data: function () {
        return {
            customers: {
                data: []
            },
            backBaseUrl: window.backBaseUrl,
            filter: {name: '', email: '', status: ''}
        }
    },
    methods: {
        getData(page = 1) {
            axios.post(this.backBaseUrl + '/customers/filter?page=' + page, this.filter)
                .then(response => {
                    if (response.data)
                        this.customers = response.data;
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

.fa-check-circle {
    color: #28a745;
}

.fa-times-circle {
    color: #dc3545;
}
</style>
