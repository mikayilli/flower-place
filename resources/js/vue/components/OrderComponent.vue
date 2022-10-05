<template>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3 col-6 mb-2">
                                <input type="text" v-model="filter.name" :delay="500"
                                       class="form-control form-control-sm" placeholder="Name"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <input type="text" v-model="filter.phone" :delay="500"
                                       class="form-control form-control-sm" placeholder="Phone"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <input type="text" v-model="filter.email" :delay="500"
                                       class="form-control form-control-sm" placeholder="Email"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col-md-3 col-6 mb-2">
                                <input type="text" v-model="filter.total" :delay="500"
                                       class="form-control form-control-sm" placeholder="Total"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col-md-3 col-6">
                                <input type="datetime-local" v-model="filter.start_date" :delay="500"
                                       class="form-control form-control-sm" placeholder="Start date"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col-md-3 col-6">
                                <input type="datetime-local" v-model="filter.end_date" :delay="500"
                                       class="form-control form-control-sm" placeholder="End date"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col-md-3 col-6">
                                <select v-model="filter.pay_type" class="form-control form-control-sm"
                                        v-on:change="searchFilter">
                                    <option value="">---- select pay/type ----</option>
                                    <option value="cart">Cart</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-6">
                                <select v-model="filter.status" class="form-control form-control-sm"
                                        v-on:change="searchFilter">
                                    <option value="">---- select status ----</option>
                                    <option value="1">Payment failed</option>
                                    <option value="2">Order received</option>
                                    <option value="3">Confirmed, in progress</option>
                                    <option value="4">Ready, waiting for courier</option>
                                    <option value="5">Delivered to the courier, on the way</option>
                                    <option value="6">Order delivered</option>
                                    <option value="7">Cancelled</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Pay/type</th>
                                <th>Total</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( order, index) in orders.data">
                                <td>{{ order.customer.full_name }}</td>
                                <td>{{ order.customer.phone }}</td>
                                <td>{{ order.customer.email }}</td>
                                <td>{{ order.payment_type }}</td>
                                <td>{{ order.total }}</td>
                                <td>{{ order.created_at | moment("DD MMM Y, HH:mm") }}</td>
                                <td>
                                    <i class="fas" :class="{'fa-check-circle': order.status, 'fa-times-circle': !order.status}"></i>
                                </td>
                                <td>
                                    <a :href="backBaseUrl+'/orders/'+order.id+'/view/'" class="btn btn-dark btn-xs"
                                       title="View"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!orders.data.length" class="text-center text-bold p-5">
                                    The order does not exist!
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
                <pagination class="" :data="orders" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>

export default {
    name: "OrderComponent",
    data: function () {
        return {
            orders: {
                data: []
            },
            backBaseUrl: window.backBaseUrl,
            filter: {
                name: '',
                phone: '',
                email: '',
                total: '',
                start_date: '',
                end_date: '',
                pay_type: '',
                status: ''
            },
            debounce: null
        }
    },
    methods: {
        getData(page = 1) {
            self = this;
            clearTimeout(this.debounce)
            this.debounce = setTimeout(() => {
                axios.post(this.backBaseUrl + '/orders/filter?page=' + page, this.filter)
                    .then(response => {
                        if (response.data)
                            self.orders = response.data;
                    });
            }, 300);
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
