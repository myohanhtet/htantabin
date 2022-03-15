<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lucky = Invoice::all();
        // return view('welcome',['lucky'=>$lucky]);
        return view('home',['lucky'=>$lucky]);  
    }

    public function donors()
    {
        return view('donors',['donors'=>Invoice::paginate(15)]);
    }

    public function search(Request $request)
    {
        $donor = $request->input('donor');
        return view('donors',['donors' => Invoice::whereLike('donor',$donor)->paginate(15)]);
    }
}
