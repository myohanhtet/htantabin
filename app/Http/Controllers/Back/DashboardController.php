<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LuckyDraw;
use App\Models\Pathan;

class DashboardController extends Controller
{
    public function index(){
    	
    	$lucky = LuckyDraw::all();
    	$pathan = Pathan::all();
    	
        return view('dashboard.index', ['lucky'=> $lucky,'pathan' => $pathan]);
    }
}
