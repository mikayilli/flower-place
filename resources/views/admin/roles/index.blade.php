@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
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
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <x-alert></x-alert>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col text-right">
                                    <a href="{{ route('roles.create') }}" class="btn btn-info btn-xs" title="Create"><i
                                            class="fa fa-plus-circle"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Permission</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <div style="width: 300px;white-space: break-spaces">
                                                @foreach($role->permissions  as $permission)
                                                    <span
                                                        class="badge badge-pill badge-dark">{{$permission->name}}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>{{ $role->updated_at }}</td>
                                        <td>
                                            <form action="{{ route('roles.destroy', $role) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('roles.edit', $role) }}"
                                                   class="btn btn-warning btn-xs" title="Edit"><i
                                                        class="far fa-edit"></i></a>
                                                <button class="btn btn-danger btn-xs"
                                                        onsubmit="return confirm('Are you sure to delete a record?!')"
                                                        title="Delete"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12 text-center">
                    {{ $roles->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->


@endsection
