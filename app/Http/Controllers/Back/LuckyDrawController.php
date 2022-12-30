<?php

namespace App\Http\Controllers\Back;

use App\Classes\Enum;
use App\DataTables\LuckyDrawDatatable;
use App\Exports\EmptyListExport;
use App\Exports\LuckyExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLuckyDrawRequest;
use App\Http\Requests\UpdateLuckyDrawRequest;
use App\Models\Invoice;
use App\Services\InvoiceService;
use App\Traits\Authorizable;
use App\Traits\PrintPdf;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class LuckyDrawController extends Controller
{
    use Authorizable,PrintPdf;

    /**
     * @var InvoiceService
     */
    private $invoice;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoice = $invoiceService;
    }

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
        $lucky_draw = $this->invoice->create($request);
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
    public function show(Invoice $lucky): string
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
        $lucky = $this->invoice->update($request,$lucky);
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
    public function destroy(Invoice $lucky): RedirectResponse
    {
        Log::info("Luck ID ". $lucky->id ." deleted by ". auth()->user()->name );
        $this->invoice->delete($lucky->id);
        session(['info' =>__('lucky.delete')]);
        return redirect()->route('lucky.index');
    }

    public function find()
    {
        return view('lucky_draws.find');
    }

    public function search()
    {
        $fileName = $this->printPdf(mm_number(\request()->lucky_number));
        return view('lucky_draws.find',['fileName' => $fileName]);
    }

    public function ajaxSearch(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->invoice->ajaxSearch($request);
    }

    public function backup(Request $request)
    {
        return $this->invoice->backup($request);
    }

    public function invoiceCount()
    {
        return view('lucky_draws.count', $this->invoice->invoiceCount());
    }

    /**
     */
    public function LuckyList()
    {
        try {
            return Excel::download(new LuckyExport(), Carbon::now().'_invoices.xlsx');
        } catch (\Exception $e) {
            Log::error("Exception happen in luckyList Download " . $e->getMessage());
            return back();
        }
    }

    /**
     */
    public function EmptyList($amount = null)
    {
        try {
            if (!empty($amount)){
                dd("LOL");
            }
            return Excel::download(new EmptyListExport(), Carbon::now().'_empty_invoices.xlsx');
        } catch (\Exception $e){
            return back();
        }
    }

}
