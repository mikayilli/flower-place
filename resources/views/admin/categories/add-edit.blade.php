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
                    <h1 class="m-0">Category Model</h1>
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
                    <h3 class="card-title">{{ $pageTitle ?? '' }} Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $category->id ?? '' }}">
                    <div class="card-body">
                        <div class="row">
                            <div
                                class="col-12 offset-0 {{ isset($children) ? 'col-md-8 border-right' : 'col-md-8 offset-md-2' }}">
                                <div class="form-group">
                                    <label>Parent Category</label>
                                    <select class="select2 form-control" name="parent_id">
                                        <option value="" selected>Select</option>
                                        @foreach($categories as $c)
                                            <option
                                                value="{{ $c->id }}" {{ isSelected('parent_id', ($category ?? '') , $c->id) }}>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName">Name<span class="text-danger">*</span></label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('name'), "form-control" => true]) name="name"
                                           id="exampleInputName" placeholder="Name" required
                                           value="{{ old('name') ?? ($category->name ?? '') }}">
                                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputNameImg">Photo</label>
                                    <input type="file" class="form-control" name="photo" id="exampleInputNameImg">
                                    <span class="text-danger">@error('photo') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Description</label>
                                    <textarea rows="3" name="description"
                                              @class(["is-invalid" => $errors->has('description'), "form-control" => true]) id="exampleInputName1"
                                              placeholder="Description">{{ old('description') ?? ($category->description ?? '') }}
                                    </textarea>
                                    <span class="text-danger">@error('description') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2">Meta tag Title</label>
                                    <input type="text"
                                           @class(["is-invalid" => $errors->has('meta_tag_title'), "form-control" => true]) name="meta_tag_title"
                                           id="exampleInputName2" placeholder="Meta tag Title"
                                           value="{{ old('meta_tag_title') ?? ($category->meta_tag_title ?? '') }}">
                                    <span class="text-danger">@error('meta_tag_title') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName3">Meta tag description</label>
                                    <textarea rows="3" name="meta_tag_description"
                                              @class(["is-invalid" => $errors->has('meta_tag_description'), "form-control" => true]) id="exampleInputName3"
                                              placeholder="Meta tag description">{{ old('meta_tag_description') ?? ($category->meta_tag_description ?? '') }}
                                    </textarea>
                                    <span
                                        class="text-danger">@error('meta_tag_description') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName4">Meta tag keywords</label>
                                    <textarea rows="3" name="meta_tag_keywords"
                                              @class(["is-invalid" => $errors->has('meta_tag_keywords'), "form-control" => true]) id="exampleInputName4"
                                              placeholder="Meta tag keywords">{{ old('meta_tag_keywords') ?? ($category->meta_tag_keywords ?? '') }}
                                    </textarea>
                                    <span class="text-danger">@error('meta_tag_keywords') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                    <select name="status" id="status" @class(["is-invalid" => $errors->has('status'), "form-control" => true])>
                                        <option {{ isSelected('status', ($category ?? null), '1')  }} value="1">Active</option>
                                        <option {{ isSelected('status', ($category ?? null), '0') }} value="0">Inactive</option>
                                    </select>
                                    <span class="text-danger">@error('status') {{$message}} @enderror</span>
                                </div>
                            </div>

                            @if(isset($children))
                                <div class="col-md-4 col-12">
                                    <label for="">Category Children</label>
                                    <ul class="list-group" id="sortable">
                                        @foreach($children as $child)
                                            <li class="list-group-item" data-id="{{ $child->id }}">{{ $child->name }} <i
                                                    class="bi bi-arrow-down-up"></i></li>
                                        @endforeach
                                        @if($children->isEmpty())
                                            <span class="text-danger p-2">The category does not have a child category!</span>
                                        @endif
                                    </ul>
                                </div>
                            @endif
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
            $('.select2').select2();

            $("#sortable").sortable({
                cursor: "move",
                stop: function (event, ui) {
                    let data = {};
                    for (let i = 0; i < $("#sortable li").length; i++) {
                        data[$("#sortable li:eq(" + i + ")").data("id")] = i + 1;
                    }

                    axios.post(backBaseUrl + "/categories/sort_children", {data}).then(response => {
                        swal("Good job!", 'Successfully done.', "success", {
                            button: "Close!",
                        })
                    }, error => {
                        swal("Something went wrong", "Record didn't changed", "error", {
                            button: "Close!",
                        });
                    })
                }
            });
        });

    </script>
@endsection
