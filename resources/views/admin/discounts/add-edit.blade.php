@extends('admin.layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Disocunt Model</h1>
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
                    <h3 class="card-title">{{ $pageTitle ?? '' }} Discount</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('discounts.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $discount->id ?? '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div
                                class="col-12 offset-0 col-md-8 offset-md-2">

                                <div class="form-group">
                                    <label for="exampleInputName">Name<span class="text-danger">*</span></label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('name'), "form-control" => true]) name="name"
                                           id="exampleInputName" placeholder="Name" required
                                           value="{{ old('name') ?? ($discount->name ?? '') }}">
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Percent<span class="text-danger">*</span></label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('percent'), "form-control" => true]) name="percent"
                                           id="exampleInputName" placeholder="Percent" required
                                           value="{{ old('percent') ?? ($discount->percent ?? '') }}">
                                    <span class="text-danger">@error('percent') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Start Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                           @class(["is-invalid" => $errors->has('start_date'), "form-control" => true]) name="start_date"
                                           id="exampleInputName" placeholder="Start date" required
                                           value="{{ old('start_date') ?? (date('Y-m-d\TH:i', strtotime($discount->start_date ?? now() ))) }}">
                                    <span class="text-danger">@error('start_date') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">End Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                           @class(["is-invalid" => $errors->has('end_date'), "form-control" => true]) name="end_date"
                                           id="exampleInputName" placeholder="End Date" required
                                           value="{{ old('end_date') ?? (date('Y-m-d\TH:i', strtotime($discount->end_date ?? now() ))) }}">
                                    <span class="text-danger">@error('end_date') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="status" @class(["is-invalid" => $errors->has('status'), "form-control" => true])>
                                        <option {{ isSelected('status', ($discount ?? null), '1')  }} value="1">Active</option>
                                        <option {{ isSelected('status', ($discount ?? null), '0') }} value="0">Inactive</option>
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
