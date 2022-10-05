@extends('admin.layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Type Model</h1>
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
                    <h3 class="card-title">{{ $pageTitle ?? '' }} Product type</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('types.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $type->id ?? '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div
                                class="col-12 offset-0 col-md-8 offset-md-2">

                                <div class="form-group">
                                    <label for="exampleInputName">Name<span class="text-danger">*</span></label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('name'), "form-control" => true]) name="name"
                                           id="exampleInputName" placeholder="Name" required
                                           value="{{ old('name') ?? ($type->name ?? '') }}">
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Description</label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('description'), "form-control" => true]) name="description"
                                           id="exampleInputName" placeholder="Description"
                                           value="{{ old('description') ?? ($type->description ?? '') }}">
                                    <span class="text-danger">@error('description') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="status" @class(["is-invalid" => $errors->has('status'), "form-control" => true])>
                                        <option {{ isSelected('status', ($type ?? null), '1')  }} value="1">Active</option>
                                        <option {{ isSelected('status', ($type ?? null), '0') }} value="0">Inactive</option>
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
