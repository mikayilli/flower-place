@extends('admin.layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Free Shipping Model</h1>
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
                    <h3 class="card-title">{{ $pageTitle ?? '' }} Free Shipping</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('free-shipping.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $freeShipping->id ?? '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Name<span class="text-danger">*</span></label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('name'), "form-control" => true]) name="name"
                                           id="exampleInputName" placeholder="Name" required
                                           value="{{ old('name') ?? ($freeShipping->name ?? '') }}">
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Start Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                           @class(["is-invalid" => $errors->has('start_date'), "form-control" => true]) name="start_date"
                                           id="exampleInputName" placeholder="Start date" required
                                           value="{{ old('start_date') ?? (date('Y-m-d\TH:i', strtotime($freeShipping->start_date ?? now() ))) }}">
                                    <span class="text-danger">@error('start_date') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">End Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                           @class(["is-invalid" => $errors->has('end_date'), "form-control" => true]) name="end_date"
                                           id="exampleInputName" placeholder="End Date" required
                                           value="{{ old('end_date') ?? (date('Y-m-d\TH:i', strtotime($freeShipping->end_date ?? now() ))) }}">
                                    <span class="text-danger">@error('end_date') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Min amount<span class="text-danger">*</span></label>
                                    <input type="number"
                                           @class(["is-invalid" => $errors->has('min_amount'), "form-control" => true]) name="min_amount"
                                           id="exampleInputName" placeholder="Min amount" required
                                           value="{{ old('min_amount') ?? ($freeShipping->min_amount ?? '') }}">
                                    <span class="text-danger">@error('min_amount') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Limit<span class="text-danger">*</span></label>
                                    <input type="number"
                                           @class(["is-invalid" => $errors->has('limit'), "form-control" => true]) name="limit"
                                           id="exampleInputName" placeholder="Limit" required
                                           value="{{ old('limit') ?? ($freeShipping->limit ?? '') }}">
                                    <span class="text-danger">@error('limit') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="status" @class(["is-invalid" => $errors->has('status'), "form-control" => true])>
                                        <option {{ isSelected('status', ($freeShipping ?? null), '1')  }} value="1">Active</option>
                                        <option {{ isSelected('status', ($freeShipping ?? null), '0') }} value="0">Inactive</option>
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

@section('js')
@endsection
