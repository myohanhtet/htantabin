@extends('layouts.app')

@section('content')

    <div class="content pt-2">
        <div class="container-fluid">
            <div class="card card-outline card-warning">
                <div class="card-body">
                    {{$dataTable->table(['class' => 'table table-bordered table-sm'])}}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page_scripts')
    {{$dataTable->scripts()}}
@endpush
