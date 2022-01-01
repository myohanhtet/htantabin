
@extends('layouts.app')

@section('content')

    <div class="content pt-2">
        <div class="container-fluid">
            <div class="text-center mb-2">
                <div class="btn-group">
                    <a class="btn btn-outline-secondary" href="{{ route('lucky.index') }}"><i class="fas fa-backward"></i> {{ __('lucky.back to index') }}</a>
                    <a class="btn btn-outline-success" href="{{ route('lucky.edit',$id) }}"><i class="fas fa-edit"></i>
                        {{ __('lucky.edit') }}</a>
                    <a href="{{ route('lucky.create') }}" class="btn btn-outline-secondary">{{ __('lucky.next') }} <i class="fas fa-forward"></i></a>
                </div>
            </div>

            <div class="text-center">
                <object id="documentId" data="{{ url('invoices/lucky_draw') .'/' .$fileName }}" type="application/pdf" width="800" height="600">
                    <p>Cannot load PDF</p>
                </object>
            </div>
        </div>
    </div>

@endsection

