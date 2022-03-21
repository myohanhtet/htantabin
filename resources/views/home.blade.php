@extends('frontend.app')

@section('content')
<div class="card bg-light mb-3 shadow-sm">
  <div class="card-header">
    <h4 class="my-0 font-weight-normal">ငွေပဒေသာစုစုပေါင်း</h4>
  </div>
  <div class="card-body">
    <h1 class="card-title pricing-card-title">{!! en_number(number_format($lucky->sum('amount'))) !!} <small class="text-muted">ကျပ်  </small></h1>
  </div>
</div>

<div class="card bg-light mb-3 shadow-sm">
  <div class="card-header">
    <h4 class="my-0 font-weight-normal">လှူဖွယ်ပစ္စည်းတန်ဖိုး</h4>
  </div>
  <div class="card-body">
    <h1 class="card-title pricing-card-title">{!! en_number(number_format($lucky->sum('mtl_value'))) !!} <small class="text-muted">ကျပ် </small></h1>
  </div>
</div>
<div class="card bg-light mb-3 shadow-sm">
  <div class="card-header">
    <h4 class="my-0 font-weight-normal">နှစ်ရပ်ပေါင်း တန်ဖိုး</h4>
  </div>
  <div class="card-body">
    <h1 class="card-title pricing-card-title">{!! en_number(number_format($lucky->sum('amount') + $lucky->sum('mtl_value'))) !!} <small class="text-muted">ကျပ် </small></h1>
  </div>
</div>
<div class="card bg-light mb-3 shadow-sm">
    <div class="card-header">
      <h4 class="my-0 font-weight-normal">အလှူရှင်ပေါင်း</h4>
    </div>
    <div class="card-body">
      <h1 class="card-title pricing-card-title">{!! en_number($lucky->count()) !!} <small class="text-muted">ဦး </small></h1>
    </div>
  </div>

@endsection
