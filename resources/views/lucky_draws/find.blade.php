@extends('layouts.app')

@section('content')

    <div class="content pt-2">
        <div class="container-fluid">
            <div class="card card-orange">
                <div class="card-header">
                    <h3 class="card-title text-white-50">{{ __('lucky.lucky list') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <form action="{{ route('lucky.search') }}">
                                @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ __('lucky.search and print') }}</span>
                                </div>
                                <input type="text" name="lucky_number" required placeholder="{{ __('lucky.lucky no') }}" aria-label="Lucky Number" class="form-control">
                                <input type="text" name="a_win" placeholder="{{ __('lucky.a_win') }}" aria-label="A_win" class="form-control">
                                <input type="text" name="sayadaw" placeholder="{{ __('lucky.sayadaw name') }}" aria-label="Sayadaw Name" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit" id="button-addon3"><i class="fas fa-print"></i> {{ __('lucky.search and print') }}</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <hr>
                    <div class="text-center">
                        @if(isset($fileName))
                            <object id="documentId" data="{{ url('invoices/lucky_list') .'/' .$fileName }}" type="application/pdf" width="800" height="1000">
                                <p>Cannot load PDF</p>
                            </object>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>


        </div>
    </div>
@endsection
