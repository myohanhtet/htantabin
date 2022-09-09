@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="content pt-2">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Donor List</h3>
                    </div>
                    <form method="POST" action="{{ route('donors.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Password" required>
                            </div>

                            <div class="form-group">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /pt2 -->

        </div>
        <div class="col-md-6">

        </div>
    </div>

    <div class="content pt-2">
            <div class="card card-outline card-warning">
                <div class="card-body">
                    {{$dataTable->table(['class' => 'table table-bordered table-sm'])}}
                </div>
            </div>
    </div>

@endsection

@push('page_scripts')

    {{$dataTable->scripts()}}
@endpush
