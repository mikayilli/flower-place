@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('back/plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
        }

        .select2-container {
            width: 100% !important;
        }

        .gallery-photo img {
            height: 200px;
        }

        .fa-times-circle {
            color: #dc3545;
            cursor: pointer;
        }

    </style>
@endsection

@php
    $defaultRank = isset($product) ? ($product->gallery->count() + 1) : 1;
@endphp

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Model</h1>
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
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Create Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="col-md-12">
                    <div class="card mt-2">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item btn-xs"><a class="nav-link active" href="#activity"
                                                               data-toggle="tab">Main</a>
                                </li>
                                <li class="nav-item btn-xs"><a
                                        @class(["nav-link","disabled" => !isset($product)]) href="#photo"
                                        data-toggle="tab">Photos</a>
                                </li>
                                <li class="nav-item btn-xs"><a
                                        @class(["nav-link","disabled" => !isset($product)]) href="#timeline"
                                        data-toggle="tab">Details</a></li>
                                <li class="nav-item btn-xs"><a
                                        @class(["nav-link","disabled" => !isset($product)]) href="#size"
                                        data-toggle="tab">Size</a></li>
                                <li class="nav-item btn-xs"><a
                                        @class(["nav-link","disabled" => !isset($product)]) href="#features"
                                        data-toggle="tab">Features</a></li>
                                <li class="nav-item btn-xs"><a
                                        @class(["nav-link","disabled" => !isset($product)]) href="#settings"
                                        data-toggle="tab">Seo
                                        Data</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            @include('admin.products.tabs.main')
                            <!-- /.tab-pane -->
                            @if(isset($product))

                                @include('admin.products.tabs.photos')

                                @include('admin.products.tabs.details')
                                <!-- /.tab-pane -->

                                @include('admin.products.tabs.size')

                                @include('admin.products.tabs.feature')

                                @include('admin.products.tabs.seo')

                            @endif
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('js')
    <script src="{{asset('back/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ asset('back/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Summernote
            $('#summernote').summernote();
            $('#summernote1').summernote();
            $('.select2').select2();
            $('.select3').select2({
                tags: true
            });

            $('.select4').select2({
                tags: true
            });
            $('.select1').select2();
        })

        window.photo_count = {{ $defaultRank }};

        function previewFile() {
            if($(".gallery-photo").length >= 4) {
                return false;
            }
            var file = $(".xxa").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $("#box .row").append(`<div class='col-12 col-md-3 gallery-photo'>
                                                <i class="remove far fa-times-circle" title="Delete"></i>
                                                <img class="x-photo img-fluid img-bordered-sm" data-rank='${photo_count - 1}' src='${reader.result}'>

                                            </div>`);
                    $(".xxa").attr("hidden", true).removeClass("xxa");
                    $(".zad").append(`<input class='${photo_count} xxa' type="file" name="gallery[${photo_count}]" onchange="previewFile();">`);
                }

                reader.readAsDataURL(file);
                window.photo_count++;
            }
        }

        $("#sortable").sortable({
            cursor: "move",
            update: function (event, ui) {
                for (let i = 0; i <= $("#sortable img").length; i++) {
                    let rank = $("#sortable img:eq(" + i + ")").data('rank');
                    $(`.zad input.${rank}`).not(".xxa").attr("name", "gallery[" + (i + 1) + "]")
                }

                if ($(ui.item).hasClass('db')) {
                    let id = $(ui.item).find('img').data('id');
                    let dbs = $(`.db`);
                    let rank = 0;
                    for (let i = 0; i < dbs.length; i++) {
                        let data = $(`.db:eq(${i}) img`).data("id");
                        if (data == id) {
                            rank = i + 1;
                            break;
                        }
                    }

                    axios.post('{{ route('products.change_rank') }}', {id, rank});
                }
            }
        });

        $(document).on("click", ".remove", function () {
            let gallery = $(this).parents(".gallery-photo");
            let rank = gallery.children("img").data('rank');
            gallery.remove();
            $(`input.${rank}`).remove();
        })

        $(document).on("click", ".from-table-remove", function () {
            let id = $(this).data('id');
            axios.post('{{ route('products.remove_photo') }}', {id});
        })
    </script>
@endsection
