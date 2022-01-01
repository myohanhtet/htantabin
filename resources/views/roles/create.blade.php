@extends('layouts.app')

@section('content')

    <div class="content mt-3">
        <div class="container-fluid">
            <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title text-white-50">Role Create</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" id="key" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="guard_name" class="col-sm-2 col-form-label">Guard Name</label>
                            <div class="col-sm-5">
                                <input type="text" name="guard_name" class="form-control" id="guard_name" placeholder="Guard name">
                            </div>
                        </div>
                        <div class="form-group row">
                            @foreach(auth_list('permissions') as $permission)
                                <div class="custom-control custom-switch m-2">
                                    <input type="checkbox" name="permission[]" value="{{ $permission }}" class="custom-control-input" id="{{ $permission }}">
                                    <label class="custom-control-label" for="{{ $permission }}">{{ str_replace("_"," ", ucfirst($permission)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>  Save</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
