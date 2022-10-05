@extends('admin.layouts.app')
@section('css')
    <style>
        .user-avatar {
            height: 100px;
            width: 100px;
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Model</h1>
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
            <!-- general form elements -->
            <div class="card @if($pageTitle == 'Create') card-info @else card-warning @endif">
                <div class="card-header">
                    <h3 class="card-title">{{ $pageTitle ?? '' }} User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
                    <div class="card-body">
                        <div class="col-md-8 col-12 offset-0 offset-md-2">
                            <div class="form-group">
                                <label for="photo">Photo </label>
                                <input type="file"
                                       @class(["is-invalid" => $errors->has('image'), "form-control" => true]) name="image"
                                       id="photo">
                                <span class="text-danger">@error('image') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Full name<span class="text-danger">*</span></label>
                                <input type="text"
                                       @class(["is-invalid" => $errors->has('full_name'), "form-control" => true]) name="full_name"
                                       id="exampleInputName" placeholder="Full name" required
                                       value="{{ old('full_name') ?? ($user->full_name ?? '') }}">
                                <span class="text-danger">@error('full_name') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address<span class="text-danger">*</span></label>
                                <input type="email"
                                       @class(["is-invalid" => $errors->has('email'), "form-control" => true]) name="email"
                                       id="exampleInputEmail1" placeholder="Email"
                                       value="{{ old('email') ?? ($user->email ?? '') }}" required>
                                <span class="text-danger">@error('email') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPhone">Phone<span class="text-danger">*</span></label>
                                <input type="number" name="phone"
                                       @class(["is-invalid" => $errors->has('phone'), "form-control" => true]) pattern="^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$"
                                       id="exampleInputPhone" placeholder="Phone" required
                                       value="{{ old('phone') ?? ($user->phone ?? '') }}">
                                <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password"
                                       @class(["is-invalid" => $errors->has('password'), "form-control" => true]) id="exampleInputPassword1"
                                       placeholder="Password">
                                <span class="text-danger">@error('password') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2">Password Confirm<span
                                        class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation"
                                       @class(["is-invalid" => $errors->has('password_confirmation'), "form-control" => true]) id="exampleInputPassword2"
                                       placeholder="Password Confirmation">
                                <span class="text-danger">@error('password_confirmation') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="status">Role<span class="text-danger">*</span></label>
                                <select name="roles"
                                        id="status" @class(["is-invalid" => $errors->has('roles'), "form-control" => true])>
                                    <option value="">---- select ----</option>
                                    @foreach($roles as $role)
                                        <option
                                            value="{{$role->id}}" {{in_array($role->name,$userRole ?? []) ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('roles') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select name="status"
                                        id="status" @class(["is-invalid" => $errors->has('status'), "form-control" => true])>
                                    <option {{ isSelected('status', ($user ?? null), '1')  }} value="1">Active</option>
                                    <option {{ isSelected('status', ($user ?? null), '0') }} value="0">Inactive</option>
                                </select>
                                <span class="text-danger">@error('status') {{$message}} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-sm">Add / Update</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
@endsection
