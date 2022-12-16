@extends('layouts.app')

@section('content')
            <div class="content pt-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed table-sm">
                                    <thead>
                                    <th>Key</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                    <tr>
                                        <td>{{ strtoupper($setting->key) }}</td>
                                        <td>{{ $setting->value }}</td>
                                        <td><a href="{{ route('setting.edit',$setting->id) }}" class="btn btn-default">
                                                <i class="fas fa-edit"></i>
                                            </a></td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
                                <form action="{{ route("settings.backup") }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                <div class="form-group">
                                    <input name="password" type="password" placeholder="Password" class="form-control form-control-sm" required>
                                </div>
                                    <div class="form-group">
                                        <input type="file" name="invoice_file">
                                    </div>
                                    <div class="btn-group">
                                        <button name="backup" value="import" type="submit" class="btn btn-info btn-lg">
                                            <i class="fas fa-file-upload"></i> Upload
                                        </button>
                                        <button name="backup" value="export" class="btn btn-success btn-lg">
                                            <i class="fas fa-download"></i> Backup</button>
                                    </div>

                                <button name="backup" value="truncate" type="submit" class="btn btn-danger btn-lg float-right" onclick="return confirm('Are you sure you want to delete this Invoices?');">
                                    <i class="far fa-trash-alt"></i> Truncate</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div><!-- /pt2 -->

@endsection
