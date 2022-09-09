
@extends('layouts.app')

@section('content')
    <div class="content pt-2">
        <div class="container-fluid">
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title text-white-50">{{ __('lucky.lucky draw create') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('lucky.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-3">
                            <label for="lucky_no">{{ __('lucky.lucky no') }}</label>
                            <input name="lucky_no" id="lucky_no" type="text" value="{{ old('lucky_no') }}" class="form-control" placeholder="{{ __('lucky.lucky no') }}">
                        </div>
                        <div class="col-4">
                            <label for="amount">{{ __('lucky.amount') }}</label>
                            <input name="amount" autofocus id="amount" value="{{ old('amount') }}" type="text" class="form-control" placeholder="{{ __('lucky.amount') }}">
                        </div>
                        <div class="col-5">
                            <label for="mtl_value">{{ __('lucky.material amount') }}</label>
                            <input name="mtl_value" value="{{ old('mtl_value') }}" id="mtl_value" type="text" class="form-control" placeholder="{{ __('lucky.material amount') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="mtl">{{ __('lucky.material') }}</label>
                            <textarea name="mtl" id="mtl" class="form-control">{{ old('mtl') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="donor">{{ __('lucky.donor name') }}</label>
                            <textarea id="donor" name="donor" class="form-control">{{ old('donor') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="address">{{ __('lucky.address') }}</label>
                            <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                        </div>
                    </div>
                        <div class="pt-2">
                            <button class="btn btn-success" type="submit">{{ __('lucky.save') }}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@endsection

@push('page_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>
        var route = "{{ route('donors.search.name') }}";

        $('#donor').typeahead(
            {
                source: function (query, process)
            {
                return $.get(route, {
                    name: query
                },function (data) {
                    return process(data);
                });
            }
        });

        $('#address').typeahead(
            {
                source: function (query, process)
                {
                    return $.get(route, {
                        address: query
                    },function (data) {
                        return process(data.map(x=>x.address));
                    });
                }
            });

        $('#mtl').typeahead(
            {
                source: function (query, process)
                {
                    return $.get(route, {
                        material: query
                    },function (data) {
                        return process(data.map(x=>x.material));
                    });
                }
            });
    </script>
@endpush
