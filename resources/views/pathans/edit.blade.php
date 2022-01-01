
@extends('layouts.app')

@section('content')

    <div class="content pt-2">
        <div class="container-fluid">
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title text-white-50">{{ __('pathan.pathan create') }}</h3>
                </div>
                <div class="card-body">
                    <h5>{{ __('pathan.pathan id') .' ('. en_number($pathan->id) .')'}}</h5>
                    <hr>
                    <form action="{{ route('pathans.update',$pathan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="amount">{{ __('pathan.amount') }}</label>
                            <input name="amount" autofocus id="amount" value="{{ $pathan->amount }}" type="text" class="form-control" placeholder="{{ __('pathan.amount') }}">
                        </div>
                        <div class="col-sm-6">
                            <label for="mtl_value">{{ __('pathan.material amount') }}</label>
                            <input name="mtl_value" value="{{ $pathan->mtl_value }}" id="mtl_value" type="text" class="form-control" placeholder="{{ __('pathan.material amount') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="material">{{ __('pathan.material') }}</label>
                            <textarea name="material" id="material" class="form-control">{{ $pathan->material }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="donor">{{ __('pathan.donor name') }}</label>
                            <textarea name="donor" id="editor1" class="form-control">
                                {{ $pathan->donor }}
                            </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="address">{{ __('pathan.address') }}</label>
                            <textarea name="address" id="address" class="form-control">{{ $pathan->address }}</textarea>
                        </div>
                    </div>
                        <div class="pt-2">
                            <button class="btn btn-success" type="submit">{{ __('pathan.save')  }}</button>
                        </div>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
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

