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
    	// ->select('amount',DB::raw('sum(amount)'))
    	->where('lucky_no',"")
    	->groupBy('amount')->get();

    	
    	return view('lucky_draws.count', ['empty_luckys' => $empty_luckys]);

    }
}
