@extends('layouts.app')

@section('content')

    <div class="content pt-2">
        <div class="container-fluid">
            <div class="card card-outline card-warning">
                <div class="card-body">
                    
                    
                    
                    <table class="table">
                      <tr>
                        <th>ငွေသား</th>
                        <th>စောင်ရေ</th>
                        <th>ငွေပေါင်း</th>
                      </tr>
                      <tbody class="table-striped">
                          @foreach($empty_luckys as $empty_lucky)
                      <tr>
                        <td>{!! ($empty_lucky->amount == '0')? 'ပစ္စည်း' : en_number($empty_lucky->amount) !!}</td>
                        <td>{!! en_number($empty_lucky->total) !!}</td>
                        <td>{!! en_number($empty_lucky->total*$empty_lucky->amount) !!}</td>
                      </tr>
                      @endforeach
                      </tbody>
                      
                      <tfoot>
                        <tr>
                          <td></td>
                          <td>{!! en_number($empty_luckys->sum('total')) !!}</td>
                          <td>
                              @php
                                $sum = 0;
                                foreach($empty_luckys  as $value)
                                {
                                   $sum+= $value->amount*$value->total;
                                }
                                echo en_number($sum);
                              @endphp
                          </td>

                        </tr>
                      </tfoot>
                    
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
