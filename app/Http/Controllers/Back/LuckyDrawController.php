<?php

namespace App\Http\Controllers\Back;

use App\DataTables\LuckyDrawDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLuckyDrawRequest;
use App\Http\Requests\UpdateLuckyDrawRequest;
use App\Models\Invoice;
use App\Traits\Authorizable;
use App\Traits\PrintPdf;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LuckyDrawController extends Controller
{
    use Authorizable,PrintPdf;

    /**
     * Display a listing of the resource.
     *
     * @param LuckyDrawDatatable $dataTable
     * @return void
     */
    public function index(LuckyDrawDatatable $dataTable)
    {
        return $dataTable->render('lucky_draws.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('lucky_draws.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLuckyDrawRequest $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {

        $amount = ($request->amount == '') ? 0 : $request->amount;
        $mtl_value = ($request->mtl_value == '') ? 0 : $request->mtl_value;

        $lucky_draw = Invoice::create([
            'amount' => $amount,
            'donor' => $request->donor,
            'mtl' => $request->mtl,
            'mtl_value' => $mtl_value,
            'address' => $request->address,
            'lucky_no' => $request->lucky_no,
            'user_id' => auth()->id(),
            'times'=> setting('times')
        ]);

        // $lucky_draw = Invoice::create($request->validated() +
        //     [
        //         'lucky_no' => $request->lucky_no,
        //         'user_id' => auth()->id(),
        //         'times'=> setting('times')
        //     ]);

        $file_name = $this->printPdf($lucky_draw->id);

        session(['success' => __('lucky.success')]);

        return view('lucky_draws.show',['fileName' => $file_name, 'id' => $lucky_draw->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $lucky
     * @return string
     */
    public function show(Invoice $lucky)
    {
        $fileName = $this->printPdf($lucky->id);
        return view('lucky_draws.show',['fileName' => $fileName , 'id' => $lucky->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Invoice $lucky
     * @return Application|Factory|View
     */
    public function edit(Invoice $lucky)
    {
        return view('lucky_draws.edit',['lucky'=> $lucky]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLuckyDrawRequest $request
     * @param Invoice $lucky
     * @return Application|Factory|View
     */
    public function update(Request $request, Invoice $lucky)
    {
        $amount = (request()->amount == '') ? 0 : request()->amount;
        $mtl_value = (request()->mtl_value == '') ? 0 : request()->mtl_value;
        // dd($mtl_value);

        $lucky->update([
            'amount' => $amount,
            'donor' => request()->donor,
            'mtl' => request()->mtl,
            'mtl_value' => $mtl_value,
            'address' => request()->address,
            'lucky_no' => request()->lucky_no,
            'user_id' => auth()->id(),
            'times'=> setting('times')
                ]);
        Log::info("Luck ID ". $lucky->id ." updated by ". auth()->user()->name );

        $fileName = $this->printPdf($lucky->id);
        session(['info' =>__('lucky.update')]);
        return view('lucky_draws.show',['fileName' => $fileName , 'id' => $lucky->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $lucky
     * @return RedirectResponse
     */
    public function destroy(Invoice $lucky)
    {
        Log::info("Luck ID ". $lucky->id ." deleted by ". auth()->user()->name );
        $lucky->delete();
        session(['info' =>__('lucky.delete')]);
        return redirect()->route('lucky.index');
    }

    public function find(){
        return view('lucky_draws.find');
    }

    public function search(){
        $fileName = $this->printPdf(mm_number(\request()->lucky_number));
        return view('lucky_draws.find',['fileName' => $fileName]);
    }


}
