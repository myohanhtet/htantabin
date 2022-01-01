<?php

namespace App\Http\Controllers\Back;

use App\DataTables\PathanDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePathanRequest;
use App\Http\Requests\UpdatePathanRequest;
use App\Models\Pathan;
use App\Traits\Authorizable;
use App\Traits\PrintPdf;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PathanController extends Controller
{
    use Authorizable,PrintPdf;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PathanDatatable $datatable)
    {
        return $datatable->render('pathans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('pathans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePathanRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function store(StorePathanRequest $request)
    {
        try {
            $pathan = Pathan::create($request->validated() +
                [
                    'material' => $request->material,
                    'mtl_value' => $request->mtl_value,
                    'user_id' => auth()->id(),
                    'times'=> setting('times')
                ]);
            session(['success' =>__('pathan.success')]);
        } catch (Exception $e) {
            Log::error($e);
            session(['error' =>"There was an error"]);
            return redirect()->back();
        }
        $fileName = $this->printPdf($pathan->id,$pathan);
        return view('pathans.show',['id'=>$pathan->id,'fileName'=>$fileName]);
    }

    /**
     * Display the specified resource.
     *
     * @param Pathan $pathan
     * @return Application|Factory|View
     */
    public function show(Pathan $pathan)
    {
        $fileName = $this->printPdf($pathan->id,$pathan);
        return view('pathans.show',['fileName'=>$fileName,'id'=>$pathan->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pathan $pathan
     * @return Application|Factory|View
     */
    public function edit(Pathan $pathan)
    {
        return view('pathans.edit',['pathan'=>$pathan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePathanRequest $request
     * @param Pathan $pathan
     * @return Application|Factory|View
     */
    public function update(UpdatePathanRequest $request, Pathan $pathan)
    {
        $pathan->update($request->validated()+
            [
                'material' => $request->material,
                'mtl_value' => $request->mtl_value,
                'user_id' => auth()->id(),
                'times'=> setting('times')
            ]);
        $fileName = $this->printPdf($pathan->id,$pathan);
        session(['info' =>__('pathan.update')]);
        return view('pathans.show',['fileName'=>$fileName,'id'=>$pathan->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pathan $pathan
     * @return RedirectResponse
     */
    public function destroy(Pathan $pathan)
    {
        Log::info("Deleted pathan ID {$pathan->id}");
        $pathan->delete();
        session(['info' =>__('pathan.delete')]);
        return redirect()->back();
    }
}
