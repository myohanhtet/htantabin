<?php

namespace App\Http\Controllers\Back;

use App\Exports\EmptyListExport;
use App\Exports\LuckyExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Pathan;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(){
    	$lucky = Invoice::where('times',setting('times'))->get();
    	$pathan = Pathan::where('times',setting('times'))->get();
        return view('dashboard.index', ['lucky'=> $lucky,'pathan' => $pathan]);
    }

    public function counts() {
    	$empty_luckys = DB::table('invoices')
    	->select('amount', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_amount'))
    	->where('lucky_no',"")
            ->where('times',setting('times'))
    	->groupBy('amount')->get();

        $lucky_numbers = DB::table('invoices')
            ->select('lucky_no', DB::raw('count(*) as total'),DB::raw("SUM(amount) as amount"))
            ->where('times',setting('times'))
            ->groupBy('lucky_no')
            ->paginate(15);

    	return view('lucky_draws.count', ['empty_luckys' => $empty_luckys,'lucky_numbers' =>$lucky_numbers]);

    }

    public function LuckyList(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new LuckyExport(), Carbon::now().'_invoices.xlsx');
    }

    public function EmptyList(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new EmptyListExport(), Carbon::now().'_empty_invoices.xlsx');
    }
}
