@extends('admin.layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Promo Code Model</h1>
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
                    <h3 class="card-title">{{ $pageTitle ?? '' }} Promo Code</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('promos.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $promo->id ?? '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Code<span class="text-danger">*</span></label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('code'), "form-control" => true]) name="code"
                                           id="exampleInputName" placeholder="Code" required
                                           value="{{ old('code') ?? ($promo->code ?? '') }}">
                                    <span class="text-danger">@error('code') {{$message}} @enderror</span>
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="xs">Type<span class="text-danger">*</span></label>
                                    <select name="type" id="xs" class="form-control">
                                        <option>---- select ----</option>
                                        <option {{ isSelected('type', ($promo ?? null), 'fix')  }}>fix</option>
                                        <option {{ isSelected('type', ($promo ?? null), 'percent')  }}>percent</option>
                                    </select>
                                    <span class="text-danger">@error('type') {{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 percent">
                                <div class="form-group">
                                    <label for="exampleInputName">Percent<span class="text-danger">*</span></label>
                                    <input type="number"
                                           @class(["is-invalid" => $errors->has('percent'), "form-control" => true]) name="percent"
                                           id="exampleInputName" placeholder="Percent" required
                                           value="{{ old('percent') ?? ($promo->percent ?? '') }}"
                                           disabled

                                    >
                                    <span class="text-danger">@error('percent') {{$message}} @enderror</span>
                                </div>
                            </div>

                            <!-- max amount -->
                            <div class="col-12 col-md-6 percent">
                                <div class="form-group">
                                    <label for="exampleInputName1">Max amount<span class="text-danger">*</span></label>
                                    <input type="number"
                                           @class(["is-invalid" => $errors->has('max_amount'), "form-control" => true]) name="max_amount"
                                           id="exampleInputName1" placeholder="Max Amount" required
                                           value="{{ old('max_amount', $promo->max_amount ?? '') }}"
                                           disabled
                                    >
                                    <span class="text-danger">@error('max_amount') {{$message}} @enderror</span>
                                </div>
                            </div>

                            <!-- min amount -->
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Min amount<span class="text-danger">*</span></label>
                                    <input type="number"
                                           @class(["is-invalid" => $errors->has('min_amount'), "form-control" => true]) name="min_amount"
                                           id="exampleInputName1" placeholder="Percent" required
                                           value="{{ old('min_amount', $promo->min_amount ?? '') }}"
                                    >
                                    <span class="text-danger">@error('min_amount') {{$message}} @enderror</span>
                                </div>
                            </div>

                            <!-- fix amount -->
                            <div class="col-12 col-md-6 fix">
                                <div class="form-group">
                                    <label for="exampleInputName3">Fix amount<span class="text-danger">*</span></label>
                                    <input type="number"
                                           @class(["is-invalid" => $errors->has('fix_amount'), "form-control" => true]) name="fix_amount"
                                           id="exampleInputName3" placeholder="Fix amount" required
                                           value="{{ old('fix_amount', $promo->fix_amount ?? '') }}"
                                           disabled
                                    >
                                    <span class="text-danger">@error('fix_amount') {{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Start Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                           @class(["is-invalid" => $errors->has('start_date'), "form-control" => true]) name="start_date"
                                           id="exampleInputName" placeholder="Start date" required
                                           value="{{ old('start_date') ?? (date('Y-m-d\TH:i', strtotime($promo->start_date ?? now() ))) }}">
                                    <span class="text-danger">@error('start_date') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">End Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                           @class(["is-invalid" => $errors->has('end_date'), "form-control" => true]) name="end_date"
                                           id="exampleInputName" placeholder="End Date" required
                                           value="{{ old('end_date') ?? (date('Y-m-d\TH:i', strtotime($promo->end_date ?? now() ))) }}">
                                    <span class="text-danger">@error('end_date') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Quantity<span class="text-danger">*</span></label>
                                    <input type="number"
                                           @class(["is-invalid" => $errors->has('quantity'), "form-control" => true]) name="quantity"
                                           id="exampleInputName" placeholder="Quantity" required
                                           value="{{ old('quantity') ?? ($promo->quantity ?? '') }}">
                                    <span class="text-danger">@error('quantity') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="status" @class(["is-invalid" => $errors->has('status'), "form-control" => true])>
                                        <option {{ isSelected('status', ($promo ?? null), '1')  }} value="1">Active</option>
                                        <option {{ isSelected('status', ($promo ?? null), '0') }} value="0">Inactive</option>
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
    <script>
        $(document).ready(function(){

           function process() {
              let val = $("#xs").val();
               if(val === 'fix') {
                   $(".fix input").prop("disabled", false)
                   $(".percent input").prop("disabled", true)
                   $(".percent input").val("")
               }
               else if(val === 'percent') {
                   $(".fix input").prop("disabled", true)
                   $(".percent input").prop("disabled", false)
                   $(".fix input").val("")
               }
            };

           $("#xs").on("change", process);

           process();

        });

    </script>
@endsection
