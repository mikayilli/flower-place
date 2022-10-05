@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('back/plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Collection Model</h1>
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
                    <h3 class="card-title">{{ $pageTitle ?? '' }} Collection</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('collections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $collection->id ?? '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 offset-0 col-md-8  {{ !isset($collection) ? 'offset-md-2' : 'border-right' }}">
                                <div class="form-group">
                                    <label for="name1">Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('name'), "form-control" => true]) name="name"
                                            id="name1" placeholder="Name"
                                            value="{{ old('name') ?? ($collection->name ?? '') }}"
                                            required>
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label>Select Discount</label>
                                    <select class="select1 form-control" name="discount_id">
                                        <option value="">---- remove ----</option>
                                        @foreach($discounts as $discount)
                                            <option value="{{ $discount->id }}" {{ isSelected('id', ($discount ?? null), $collection->discount_id ?? null)  }}>{{ $discount->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="xxxx">Banner name</label>
                                    <select name="banner_name"
                                            id="xxxx" @class(["is-invalid" => $errors->has('banner_name'), "form-control" => true]) >
                                             <option value="">-- select --</option>
                                             <option {{ isSelected('banner_name', ($collection ?? null), 'under main slider')  }}>under main slider</option>
                                             <option {{ isSelected('banner_name', ($collection ?? null), 'middle section')  }}>middle section</option>
                                             <option {{ isSelected('banner_name', ($collection ?? null), 'main slider')  }}>main slider</option>
                                    </select>
                                    <span class="text-danger">@error('banner_name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="get_product">Product</label>
                                    <select name="product_id"
                                            id="get_product" @class(["is-invalid" => $errors->has('product_id'), "form-control" => true]) >
                                        @if(isset($collection))
                                            <option value="{{ $collection?->product?->id }}" selected>{{ $collection?->product?->name }}</option>
                                        @endif
                                    </select>
                                    <span class="text-danger">@error('product_id') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo (min: 292h x 277w)</label>
                                    <input type="file" class="form-control" name="photo" id="photo">
                                    <span class="text-danger">@error('photo') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Description</label>
                                    <textarea rows="3" name="description"
                                              @class(["is-invalid" => $errors->has('description'), "form-control" => true]) id="exampleInputName1"
                                    placeholder="Description">{{ old('description') ?? ($collection->description ?? '') }}
                                    </textarea>
                                    <span class="text-danger">@error('description') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2">Meta tag Title</label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('meta_tag_title'), "form-control" => true]) name="meta_tag_title"
                                    id="exampleInputName2" placeholder="Meta tag Title"
                                    value="{{ old('meta_tag_title') ?? ($collection->meta_tag_title ?? '') }}">
                                    <span class="text-danger">@error('meta_tag_title') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName3">Meta tag description</label>
                                    <textarea rows="3" name="meta_tag_description"
                                              @class(["is-invalid" => $errors->has('meta_tag_description'), "form-control" => true]) id="exampleInputName3"
                                    placeholder="Meta tag description">{{ old('meta_tag_description') ?? ($collection->meta_tag_description ?? '') }}
                                    </textarea>
                                    <span
                                        class="text-danger">@error('meta_tag_description') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName4">Meta tag keywords</label>
                                    <textarea rows="3" name="meta_tag_keywords"
                                              @class(["is-invalid" => $errors->has('meta_tag_keywords'), "form-control" => true]) id="exampleInputName4"
                                    placeholder="Meta tag keywords">{{ old('meta_tag_keywords') ?? ($collection->meta_tag_keywords ?? '') }}
                                    </textarea>
                                    <span class="text-danger">@error('meta_tag_keywords') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status"
                                            id="status" @class(["is-invalid" => $errors->has('status'), "form-control" => true])>
                                    <option {{ isSelected('status', ($collection ?? null), '1')  }} value="1">Active
                                    </option>
                                    <option {{ isSelected('status', ($collection ?? null), '0') }} value="0">Inactive
                                    </option>
                                    </select>
                                    <span class="text-danger">@error('status') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="slider">Slider</label>
                                    <select name="slider" id="slider" @class(["is-invalid" => $errors->has('slider'), "form-control" => true]) >
                                        <option value="">-- select --</option>
                                        @foreach(\App\Models\Collection::SLIDER as $slider)
                                         <option {{ isSelected('slider', ($collection ?? null), $slider)  }}>{{ $slider }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('slider') {{$message}} @enderror</span>
                                </div>
                            </div>
                            @if(isset($collection))
                                <div class="col-12 col-md-4">
                                    @if($collection->image)
                                        <img src="{{ url('storage/collections/thumb_'. $collection->image) }}" alt="">
                                    @else
                                        <span>The collection does not have a image!</span>
                                    @endif
                                </div>
                            @endif
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
    <script src="{{ asset('back/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#name2').select2({
                tags:true
            });

            $('#get_product').select2({
                ajax: {
                    url: backBaseUrl + '/products/filter-c/',
                    dataType: 'json',
                    delay: 250,
                    type: 'GET',
                    data: function (params) {
                        console.log(params, "hey")
                        var query = {
                            name: params.term,
                            page: params.page || 1
                        }

                        // Query parameters will be ?search=[term]&page=[page]
                        return query;
                    },
                    processResults: function (data, params) {
                        return {
                            results: data.data.map(function(item) {
                                return {id: item.id, text: item.name};
                            })
                        };
                    }

                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                }
            });

            $('.select1').select2();
        });

    </script>
@endsection
