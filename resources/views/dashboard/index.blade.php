@extends('layouts.app')

@section('content')

    <div class="content-header">
        <div class="col-sm-12">
            <h1 class="m-0 text-center" style="font-weight: bold;">{{ setting('luckydraw-invoice-title-one') }}</h1>
        </div>
        <br><br>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ str_replace("[times]", en_number(setting('times')), setting('luckydraw-invoice-title-two')) }}</h1>
                </div><!-- /.col -->
{{--                <div class="col-sm-6">--}}
{{--                    <ol class="breadcrumb float-sm-right">--}}
{{--                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                        <li class="breadcrumb-item active">Dashboard v2</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="far fa-money-bill-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ငွေပဒေသာစုစုပေါင်း</span>
                    <span class="info-box-number">
                  {!! en_number(number_format($lucky->sum('amount'))) !!}
                  <small>ကျပ်</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-mail-bulk"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">လှူဖွယ်ပစ္စည်းတန်ဖိုး</span>
                    <span class="info-box-number">
                        {!! en_number(number_format($lucky->sum('mtl_value'))) !!}
                        <small>ကျပ်</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">နှစ်ရပ်ပေါင်း တန်ဖိုး</span>
                    <span class="info-box-number"> {!! en_number(number_format($lucky->sum('amount') + $lucky->sum('mtl_value'))) !!}
                    <small>ကျပ်</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">အလှူရှင်ပေါင်း</span>
                    <span class="info-box-number">
                        {!! en_number($lucky->count()) !!}
                        <small>ဦး</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

{{--    Pathan --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">{{ str_replace("[times]", en_number(setting('times')), setting('pathan-invoice-title-two')) }}</h1>
                </div><!-- /.col -->
                {{--                <div class="col-sm-6">--}}
                {{--                    <ol class="breadcrumb float-sm-right">--}}
                {{--                        <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                {{--                        <li class="breadcrumb-item active">Dashboard v2</li>--}}
                {{--                    </ol>--}}
                {{--                </div>--}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="far fa-money-bill-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">အလှူတော်ငွေစုစုပေါင်း</span>
                    <span class="info-box-number">
                  {!! en_number(number_format($pathan->sum('amount'))) !!}
                  <small>ကျပ်</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-mail-bulk"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">လှူဖွယ်ပစ္စည်းတန်ဖိုး</span>
                    <span class="info-box-number">{!! en_number(number_format($pathan->sum('mtl_value'))) !!}
                        <small>ကျပ်</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">နှစ်ရပ်ပေါင်း တန်ဖိုး</span>
                    <span class="info-box-number">
                        {!! en_number(number_format($pathan->sum('amount')+$pathan->sum('mtl_value'))) !!}
                        <small>ကျပ်</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">အလှူရှင်ပေါင်း</span>
                    <span class="info-box-number">
                        {!! en_number(number_format($pathan->count())) !!}
                        <small>ဦး</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
