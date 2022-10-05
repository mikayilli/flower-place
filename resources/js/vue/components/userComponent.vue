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
                                       class="form-control form-control-sm" placeholder="Phone"
                                       v-on:input="searchFilter">
                            </div>
                            <div class="col">
                                <input type="text" v-model="filter.email" class="form-control form-control-sm"
                                       placeholder="Email" v-on:input="searchFilter">
                            </div>
                            <div class="col">
                                <a :href="backBaseUrl +'/users/create'" class="btn btn-info btn-xs" title="Create"><i class="fa fa-plus-circle"></i></a>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="( user, index) in users.data">
                                <td><img v-if="user.photo" :src="'/storage/user/'+ user.photo" alt="" class="user-avatar img-bordered-sm img-circle"></td>
                                <td>{{ user.full_name }}</td>
                                <td>{{ user.phone }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.roles[0].name }}</td>
                                <td><i class="fas "
                                       :class="{'fa-check-circle': user.status == 1, 'fa-times-circle': user.status == 0 }"></i></td>
                                <td>
                                    <a :href="backBaseUrl+'/users/'+user.id+'/edit/'"
                                       class="btn btn-warning btn-xs" title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger btn-xs" title="Delete" v-on:click="del(user.id, index)"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!users.data.length" class="text-center text-bold p-5">
                                    The user does not exist!
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
                <pagination class="" :data="users" @pagination-change-page="getUsers"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>
import swal from "../partial/swal";

export default {
    name: "userComponent",
    data: function () {
        return {
            users: {
                data: []
            },
            backBaseUrl: window.backBaseUrl,
            filter: {name: '', phone: '', email: ''}
        }
    },
    methods: {
        getUsers(page = 1) {
            axios.post(this.backBaseUrl + '/users/filter?page=' + page, this.filter)
                .then(response => {
                    this.users = response.data;
                });
        },
        async searchFilter() {
            this.getUsers(1);
        },
        del(id, index) {
            swal.swalConfirmMethod().then((result) => {
                if (result) {
                    axios.delete(this.backBaseUrl + '/users/' + id)
                        .then(response => {
                            this.users.data.splice(index, 1);
                            swal.swalDeleteAlert();
                        });
                }
            });
        }
    },
    mounted() {
        this.getUsers();
    },
}
</script>

<style scoped>
.user-avatar {
    height: 40px;
    width: 40px;
}

.fa-check-circle{
    color: #28a745;
}

.fa-times-circle{
    color: #dc3545;
}
</style>
