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
                                <input type="text" v-model="filter.banner_name" :delay="500"
                                       class="form-control form-control-sm" placeholder="Banner name"
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
                                <a :href="backBaseUrl +'/collections/create'" class="btn btn-info btn-xs" title="Create"><i
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
                                <th>Banner name</th>
                                <th>Name</th>
                                <th>Slider</th>
                                <th>Status</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody  id="sortable">
                            <tr v-for="( collection, index) in collections.data" :rank="collection.rank" :class="camelCase(collection.banner_name)" :data-banner="camelCase(collection.banner_name)" :data-id="collection.id">
                                <td>{{ collection.user.full_name }}</td>
                                <td>
                                    <img v-if="collection.image" :src="'/storage/collections/'+ collection.image"
                                         alt="" class="img-bordered-sm img-circle">
                                </td>
                                <td>{{ collection.banner_name }}</td>
                                <td>{{ collection.name }}</td>
                                <td>
                                    {{ collection.slider || '...' }}
                                </td>
                                <td>
                                    <i class="fas "
                                       :class="{'fa-check-circle': collection.status == 1, 'fa-times-circle': collection.status == 0}"></i>
                                </td>
                                <td><a :href="backBaseUrl + '/collections/' + collection.id + '/products'"
                                       class="btn btn-dark btn-xs" title="View products"><i class="far fa-eye"></i></a>
                                </td>
                                <td>
                                    <a :href="backBaseUrl+'/collections/'+collection.id+'/edit/'"
                                       class="btn btn-warning btn-xs" title="Edit"><i class="far fa-edit"></i></a>
                                    <button class="btn btn-danger btn-xs" v-on:click="del(collection.id, index)" title="Delete"><i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" v-if="!collections.data.length" class="text-center text-bold p-5">
                                    The collection does not exist!
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
                <pagination class="" :data="collections" @pagination-change-page="getData"></pagination>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</template>

<script>
import swal from "../partial/swal";

export default {
    name: "CollectionComponent",
    data: function () {
        return {
            collections: {
                data: []
            },
            backBaseUrl: window.backBaseUrl,
            filter: {name: '', banner_name: '', status: ''}
        }
    },
    methods: {
        getData(page = 1) {
            axios.post(this.backBaseUrl + '/collections/filter?page=' + page, this.filter)
                .then(response => {
                    if (response.data)
                        this.collections = response.data;
                });
        },
        async searchFilter() {
            this.getData(1);
        },
        del(id, index) {
            swal.swalConfirmMethod().then((result) => {
                if (result) {
                    axios.delete(this.backBaseUrl + '/collections/' + id)
                        .then(response => {
                            this.collections.data.splice(index, 1);
                            swal.swalDeleteAlert();
                        });
                }
            });
        },
         camelCase(str) {
            if(!str) return;
            return str
                .replace(/\s(.)/g, function(a) {
                    return a.toUpperCase();
                })
                .replace(/\s/g, '')
                .replace(/^(.)/, function(b) {
                    return b.toLowerCase();
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
