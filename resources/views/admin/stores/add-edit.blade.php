@extends('admin.layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Store Model</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-info btn-xs" href="{{ url()->previous() }}" title="Go back"><i
                                class="fas fa-backward"></i></a>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="col-12">
            <x-alert></x-alert>
            <!-- general form elements -->
            <div class="card @if($pageTitle == 'Create') card-info @else card-warning @endif">
                <div class="card-header">
                    <h3 class="card-title">{{ $pageTitle ?? '' }} Store</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('stores.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $store->id ?? '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div
                                class="col-12 offset-0 col-md-8 offset-md-2">
                                <div class="form-group">
                                    <label for="width">Manager <span class="text-danger">*</span></label>
                                    <select name="manager_id" id="status" @class(["is-invalid" => $errors->has('type_id'), "form-control"]) required>
                                        <option value="">Select</option>
                                        @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}" {{ isSelected('manager_id', ($store ?? null), $manager->id)  }} >{{ $manager->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Name<span class="text-danger">*</span></label>
                                    <input
                                            type="text"
                                           @class(["is-invalid" => $errors->has('name'), "form-control" => true])
                                           name="name"
                                           id="exampleInputName" placeholder="Name" required
                                           value="{{ old('name') ?? ($store->name ?? '') }}">
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label for="Address">Address <span class="text-danger">*</span></label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('address'), "form-control" => true])
                                           name="address"
                                           id="Address" placeholder="Address" required
                                           value="{{ old('address', $store->address ?? '') }}">
                                    <span class="text-danger">@error('address') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label for="Phone">Phone <span class="text-danger">*</span></label>
                                    <input type="number"
                                           @class(["is-invalid" => $errors->has('phone'), "form-control" => true])
                                           name="phone"
                                           id="Phone" placeholder="Phone" required
                                           value="{{ old('phone', $store->phone ?? '') }}">
                                    <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email"
                                           @class(["is-invalid" => $errors->has('email'), "form-control" => true]) name="email"
                                           id="exampleInputEmail1" placeholder="Email"
                                           value="{{ old('email') ?? ($store->email ?? '') }}" required>
                                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="status" @class(["is-invalid" => $errors->has('status'), "form-control" => true])>
                                        <option {{ isSelected('status', ($store ?? null), '1')  }} value="1">Active</option>
                                        <option {{ isSelected('status', ($store ?? null), '0') }} value="0">Inactive</option>
                                    </select>
                                    <span class="text-danger">@error('status') {{$message}} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm">Add / Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('js')
@endsection
