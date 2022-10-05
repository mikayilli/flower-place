@extends('admin.layouts.app')
@section('css')
    <style>
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
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Additions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <x-alert></x-alert>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">Add products to the <strong>{{ $product->name }}</strong>
                                    <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#exampleModal"
                                            title="Add product"><i class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Type Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($additions as $addition)
                                    <tr>
                                        <td>
                                            <img src="{{ url('/storage/products/'. $addition->image) }}" alt=""
                                                 class="img-circle img-bordered-sm">
                                        </td>
                                        <td>{{ $addition->name }}</td>
                                        <td>{{ $addition->type->name }}</td>
                                        <td>{{ $addition->price }}</td>
                                        <td>
                                            <i @class(["fas fa-check-circle" => $addition->status, 'fas fa-times-circle' => !$addition->status])></i>
                                        <td>
                                            <form
                                                action="{{ route('remove_product_from_category', ["category" => $product->id, "product" => $addition->id]) }}"
                                                method="post">
                                                @method("delete")
                                                @csrf
                                                <input type="hidden" value="{{ $addition->id }}" name="product_id">
                                                <input type="hidden" value="{{ $product->id }}" name="category_id">
                                                <button class="btn btn-danger btn-xs" title="Delete"><i
                                                        class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-bold">There are no additions in this
                                            product.
                                            <button class="btn btn-info btn-xs" data-toggle="modal"
                                                    data-target="#exampleModal" title="Add product"><i
                                                    class="fa fa-plus-circle"></i></button>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12 text-center">
                    {{ $additions->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <product-addition-find :own-products='@json($additions)' :product-id='@json($product->id)'></product-addition-find>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
