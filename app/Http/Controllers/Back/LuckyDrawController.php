<?php

namespace App\Http\Controllers\Back;

use App\DataTables\LuckyDrawDatatable;
use App\Exports\InvoiceExport;
use App\Exports\LuckyExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLuckyDrawRequest;
use App\Http\Requests\UpdateLuckyDrawRequest;
use App\Imports\InvoiceImpoer;
use App\Models\Invoice;
use App\Traits\Authorizable;
use App\Traits\PrintPdf;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Classes\Enum;
use PharIo\Manifest\Exception;

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
        $amount = (request()->amount == '') ? 0 : request()->amount;
        $mtl_value = (request()->mtl_value == '') ? 0 : request()->mtl_value;

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
        $nameQuery = $request->get('name');
        $addressQuery = $request->get('address');
        $materialQuery = $request->get('material');

        if($nameQuery){
            $filterSearch = $this->searchByColumn('donor',$nameQuery);
        }
        else if ($addressQuery){
            $filterSearch = $this->searchByColumn('address',$addressQuery);
        }
        else if($materialQuery) {
            $filterSearch = $this->searchByColumn('mtl',$materialQuery);
        }
        else {
            $this->abort(404);
        }
        return response()->json($filterSearch);
    }

    private function searchByColumn($column,$value)
    {
        return Invoice::where($column,'LIKE','%'.$value.'%')
            ->distinct()->get($column);
    }

    public function backup(Request $request)
    {
        if (!Hash::check($request->password,auth()->user()->getAuthPassword())) {
            session(['error' => __('auth.failed')]);
            return back();
        }
        try {
            switch ($request->backup) {
                case Enum::IMPORT:
                   $status = $this->import($request->invoice_file);
                    break;
                case Enum::EXPORT:
                    return $this->export();
                    break;
                case Enum::TRUNCATE:
                    $status= $this->deleteAll();
                    break;
                default:
                    $status = false;
            }
            $message = ($status) ? ["success"=>Enum::SUCCESS_MESSAGE]: ["error" => Enum::SOMETHING_WRONG_WRONG];
            session($message);
            return back();
        } catch (\Exception $exception){
            \Log::error("Exception In file import: ". $exception->getMessage());
            session(['error' => Enum::SOMETHING_WRONG_WRONG]);
            return back();
        }
    }

    private function import($file): bool
    {
        try {
            Excel::import(new InvoiceImpoer(),$file);
            return true;
        } catch (\Exception $e) {
            \Log::error("Exception happen in file import: ". $e->getMessage());
            return false;
        }
    }

    private function export()
    {
        try {
          return  Excel::download(new InvoiceExport(), Carbon::now().'_backup.xlsx');
        } catch (\Exception $e) {
            \Log::error("Exception happen in export: ". $e->getMessage());
            return false;
        }
    }

    /**
     * @throws \Exception
     */
    private function deleteAll(): bool
    {
        try {
            DB::table('invoices')->truncate();
            return true;
        } catch (\Exception $e){
            \Log::error("Exception happen in truncate: ". $e->getMessage());
            return false;
        }
    }
}
