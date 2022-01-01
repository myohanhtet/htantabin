@extends('layouts.app')

@section('content')

    <div class="content mt-3">
        <div class="container-fluid">
            <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title text-white-50">Setting Create</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('setting.update',$settings->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="key" class="col-sm-2 col-form-label">Key</label>
                            <div class="col-sm-5">
                                <input type="text" value="{{ $settings->key }}" name="key" class="form-control" id="key" placeholder="Enter Key">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="value" class="col-sm-2 col-form-label">Value</label>
                            <div class="col-sm-5">
                                <input type="text" value="{{ $settings->value }}" name="value" class="form-control" id="value" placeholder="Value">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-5">
                                <input type="text" value="{{ $settings->type }}" name="type" class="form-control" id="type" placeholder="Type">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Save</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
