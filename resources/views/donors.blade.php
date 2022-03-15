@extends('frontend.app')

@section('content')

  
  <form action="{{ route('donors.search') }}" class="form-inline" method="get">
    @csrf
    {{-- <input type="text" name="donor" class="form-control" placeholder="Search ... " aria-label="Recipient's username" aria-describedby="button-addon2">

    <div class="col-2 input-group-append">
      <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
    </div> --}}
    <div class="input-group rounded mb-3">
      <input type="search" class="form-control rounded" name="donor" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
      <button class="input-group-text" type="submit" id="search-addon">
        <i class="fas fa-search"></i>
      </span>
    </div>
  </form>
  
  
<table class="table">
    <thead>
      <tr>
        <th scope="col">အလှူရှင်</th>
        <th scope="col">အလှူငွေ</th>
        <th scope="col">လှူဖွယ်ပစ္စည်း</th>
        <th scope="col">နေ့စွဲ</th>
      </tr>
    </thead>
    <tbody>
      @foreach($donors as $donor)
      <tr>
        <th scope="row">{{ $donor->donor }}</th>
        <td>{{ en_number(number_format($donor->amount)) }}</td>
        <td>{{ $donor->mtl }}</td>
        <td>{{ $donor->created_at->toDayDateTimeString(); }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    {{ $donors->links() }}
  </div>

@endsection
