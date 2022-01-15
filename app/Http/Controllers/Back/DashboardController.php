<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LuckyDraw;
use App\Models\Pathan;
use DB;

class DashboardController extends Controller
{
    public function index(){

    	$lucky = LuckyDraw::all();
    	$pathan = Pathan::all();

        return view('dashboard.index', ['lucky'=> $lucky,'pathan' => $pathan]);
    }

    public function counts() {

    	$empty_luckys = DB::table('lucky_draws')
    	->select('amount', DB::raw('count(*) as total'))
    	->where('lucky_no',"")
    	->groupBy('amount')->get();

        $lucky_numbers = DB::table('lucky_draws')
            ->select('lucky_no', DB::raw('count(*) as total'),DB::raw("SUM(amount) as amount"))
            ->groupBy('lucky_no')
            ->orderBy('lucky_no')
            ->paginate(15);

    	return view('lucky_draws.count', ['empty_luckys' => $empty_luckys,'lucky_numbers' =>$lucky_numbers]);

    }
}
