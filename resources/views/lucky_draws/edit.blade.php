@extends('layouts.app')

@section('content')

    <div class="content mt-3">
        <div class="container-fluid">
            <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title text-white-50">{{ __('lucky.lucky draw create') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('lucky.update',$lucky->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h5>{{ __('lucky.lucky id') .' ('. en_number($lucky->id) .')'}}</h5>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <label for="lucky_no">{{ __('lucky.lucky no') }}</label>
                                <input name="lucky_no" id="lucky_no" type="text" value="{{ $lucky->lucky_no }}" class="form-control" placeholder="{{ __('lucky.lucky no') }}">
                            </div>
                            <div class="col-4">
                                <label for="amount">{{ __('lucky.amount') }}</label>
                                <input name="amount" autofocus id="amount" value="{{ $lucky->amount }}" type="text" class="form-control" placeholder="{{ __('lucky.amount') }}">
                            </div>
                            <div class="col-5">
                                <label for="mtl_value">{{ __('lucky.material amount') }}</label>
                                <input name="mtl_value" value="{{ $lucky->mtl_value }}" id="mtl_value" type="text" class="form-control" placeholder="{{ __('lucky.material amount') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="mtl">{{ __('lucky.material') }}</label>
                                <textarea name="mtl" id="mtl" class="form-control">{{ $lucky->mtl }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="donor">{{ __('lucky.donor name') }}</label>
                                <textarea name="donor" id="editor1" class="form-control">
                                {{ $lucky->donor }}
                            </textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="address">{{ __('lucky.address') }}</label>
                                <textarea name="address" id="address" class="form-control">{{ $lucky->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="#" onclick="window.history.back();" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection

@push('page_css')
    <link href="{{ asset('vendor/summernote/dist/summernote.min.css') }}" rel="stylesheet">
@endpush
@push('page_scripts')
    <script src="{{ asset('vendor/summernote/dist/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#editor1').summernote({
                height: 150,
            });
        });
    </script>
@endpush
