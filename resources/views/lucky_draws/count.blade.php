@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-6">
            <div class="content pt-2">
            <div class="container-fluid">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">လက်ကျန်ပြေစာ</h3>
                    <div class="card-tools">
                        <a href="{{ route('luckys.empty_list_download') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                        <tr>
                            <th>ငွေသား</th>
                            <th>စောင်ရေ</th>
                            <th>ငွေပေါင်း</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tbody class="table-striped">
                        @foreach($empty_luckys as $empty_lucky)
                            <tr>
                                <td>{!! ($empty_lucky->amount == '0')? 'ပစ္စည်း' : en_number($empty_lucky->amount) !!}</td>
                                <td>{!! en_number($empty_lucky->total) !!}</td>
                                <td>{!! en_number($empty_lucky->total_amount) !!}</td>
                                <td><a href="{{ url('admin/lucky/empty-list/')."/".$empty_lucky->amount }}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td>{!! en_number($empty_luckys->sum('total')) !!}</td>
                            <td>{!! en_number($empty_luckys->sum('total_amount')) !!}</td>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            </div>
            </div>
        </div>
        <div class="col-6">
            <div class="content pt-2">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">မဲများ</h3>
                            <div class="card-tools">
                                <a href="{{ route('luckys.list_download') }}" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>မဲနံပါတ်</th>
                                    <th>စောင်ရေ</th>
                                    <th>ငွေပေါင်း</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tbody class="table-striped">
                                @foreach($lucky_numbers as $lucky_number)
                                    <tr>
                                        <td>{!! ($lucky_number->lucky_no == "")? 'မဲမရှိ' : en_number($lucky_number->lucky_no) !!}</td>
                                        <td>{!! en_number($lucky_number->total) !!}</td>
                                        <td>{!! en_number($lucky_number->amount) !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>

                                    </td>

                                </tr>
                                </tfoot>
                            </table>
                            <div class="pt-2 container-fluid">
                                {{ $lucky_numbers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
