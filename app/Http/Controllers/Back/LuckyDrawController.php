<?php

namespace App\Http\Controllers\Back;

use App\DataTables\LuckyDrawDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLuckyDrawRequest;
use App\Http\Requests\UpdateLuckyDrawRequest;
use App\Models\LuckyDraw;
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
    public function store(StoreLuckyDrawRequest $request)
    {
        $lucky_draw = LuckyDraw::create($request->validated() +
            [
                'lucky_no' => $request->lucky_no,
                'user_id' => auth()->id(),
                'times'=> setting('times')
            ]);

        $file_name = $this->printPdf($lucky_draw->id);

        session(['success' => __('lucky.success')]);

        return view('lucky_draws.show',['fileName' => $file_name, 'id' => $lucky_draw->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param LuckyDraw $lucky
     * @return string
     */
    public function show(LuckyDraw $lucky)
    {
        $fileName = $this->printPdf($lucky->id);
        return view('lucky_draws.show',['fileName' => $fileName , 'id' => $lucky->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LuckyDraw $lucky
     * @return Application|Factory|View
     */
    public function edit(LuckyDraw $lucky)
    {
        return view('lucky_draws.edit',['lucky'=> $lucky]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLuckyDrawRequest $request
     * @param LuckyDraw $lucky
     * @return Application|Factory|View
     */
    public function update(UpdateLuckyDrawRequest $request, LuckyDraw $lucky)
    {
        $lucky->update($request->validated() + [
                'lucky_no' => $request->lucky_no,
                'user_id' => auth()->id(),
                'times'=> setting('times')] );
        Log::info("Luck ID ". $lucky->id ." updated by ". auth()->user()->name );

        $fileName = $this->printPdf($lucky->id);
        session(['info' =>__('lucky.update')]);
        return view('lucky_draws.show',['fileName' => $fileName , 'id' => $lucky->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LuckyDraw $lucky
     * @return RedirectResponse
     */
    public function destroy(LuckyDraw $lucky)
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
