<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Imports\DonorImport;
use App\Models\Donor;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request){

        if (!Hash::check($request->password,auth()->user()->getAuthPassword())){
            session(['error' => __('auth.failed')]);
            return back();
        }

        try {

            if($request->truncate) {
                DB::table('donors')->truncate();
                session(['success' => ":) Record deleted successfully."]);
                return back();
            }

            Excel::import(new DonorImport(),$request->donor_file);

            session(['success' => ":) Upload Successfully."]);

            return back();

        } catch (\Exception $exceptione){
            \Log::error("Exception In file import: ". $exceptione->getMessage());
            session(['error' => $exceptione->getMessage()]);
            return back();
        }

    }

    public function ajaxSearch(Request $request): \Illuminate\Http\JsonResponse
    {
        $nameQuery = $request->get('name');
        $addressQuery = $request->get('address');
        $materialQuery = $request->get('material');
        if($nameQuery){
            $filterSearch = Donor::where('name','LIKE','%'.$nameQuery.'%')
                ->get('name');
        }
        else if ($addressQuery){
            $filterSearch = Donor::where('address','LIKE','%'.$addressQuery.'%')
                ->get('address');
        }
        else if($materialQuery) {
            $filterSearch = Donor::where('material','LIKE','%'.$materialQuery.'%')
                ->get('material');
        }
        else {
            abort(404);
        }
        return response()->json($filterSearch);
    }
}
