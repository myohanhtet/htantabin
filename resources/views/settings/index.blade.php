@extends('layouts.app')

@section('content')
            <div class="content pt-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-warning">
                            <div class="card-body">
                                {{$dataTable->table(['class' => 'table table-bordered table-sm'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Invoices</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="password" placeholder="Password" class="form-control form-control-sm" required>
                                </div>
                                    <div class="form-group">
                                        <input type="file" name="invoice_file">
                                    </div>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-info btn-lg">
                                            <i class="fas fa-file-upload"></i> Upload
                                        </button>
                                        <button class="btn btn-success btn-lg">
                                            <i class="fas fa-download"></i> Backup</button>
                                    </div>

                                <button name="delete" value="true" type="submit" class="btn btn-danger btn-lg float-right" onclick="return confirm('Are you sure you want to delete this Invoices?');">
                                    <i class="far fa-trash-alt"></i> Truncate</button>

                                </form>
                            </div>
                    </div>
                </div>
            </div><!-- /pt2 -->

@endsection

@push('page_scripts')

    {{$dataTable->scripts()}}
@endpush
