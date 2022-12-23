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

    public function LuckyList(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new LuckyExport(), Carbon::now().'_invoices.xlsx');
    }

    public function EmptyList(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new EmptyListExport(), Carbon::now().'_empty_invoices.xlsx');
    }
}
