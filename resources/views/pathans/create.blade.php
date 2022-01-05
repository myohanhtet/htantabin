
@extends('layouts.app')

@section('content')

    <div class="content pt-2">
        <div class="container-fluid">
            <div class="card rounded-0 card-orange">
                <div class="card-header">
                    <h3 class="card-title text-white-50">{{ __('pathan.pathan create') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pathans.store') }}" method="POST">
                        @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="amount">{{ __('pathan.amount') }}</label>
                            <input name="amount" autofocus id="amount" value="{{ old('amount') }}" type="text" class="rounded-0 form-control" placeholder="{{ __('pathan.amount') }}">
                        </div>
                        <div class="col-sm-6">
                            <label for="mtl_value">{{ __('pathan.material amount') }}</label>
                            <input name="mtl_value" value="{{ old('mtl_value') }}" id="mtl_value" type="text" class="rounded-0 form-control" placeholder="{{ __('pathan.material amount') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="material">{{ __('pathan.material') }}</label>
                            <textarea name="material" id="material" class="rounded-0 form-control">{{ old('material') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="donor">{{ __('pathan.donor name') }}</label>
                            <textarea name="donor" id="donor" class="rounded-0 form-control">
                                {{ old('donor') }}
                            </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="address">{{ __('pathan.address') }}</label>
                            <textarea name="address" id="address" class="rounded-0 form-control">{{ old('address') }}</textarea>
                        </div>
                    </div>
                        <div class="pt-2">
                            <button class="btn btn-success btn-flat" type="submit">{{ __('pathan.save')  }}</button>
                        </div>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@endsection
<!-- @push('page_css')
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
@endpush -->

