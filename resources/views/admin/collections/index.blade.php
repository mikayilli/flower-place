@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('back/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Collections</h1>
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
        <x-alert></x-alert>
        <collection-component></collection-component>
    </section>
    <!-- /.content -->


@endsection


@section('js')
    <script src="{{ asset('back/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#sortable").sortable({
                cursor: "move",
                stop: function (event, ui) {
                    let data = {};
                    let cl = ui.item.data("banner");

                    for (let i = 0; i < $(`#sortable tr.${cl}`).length; i++) {
                        data[$(`#sortable tr.${cl}:eq(${i})`).data("id")] = i + 1;
                    }
                    console.log(data);
                    axios.post(backBaseUrl + "/collections/sort", {data}).then(response => {
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
