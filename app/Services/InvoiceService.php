<?php

namespace App\Services;

use App\Classes\Enum;
use App\Exports\InvoiceExport;
use App\Http\Requests\StoreLuckyDrawRequest;
use App\Imports\InvoiceImpoer;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceService implements \App\Services\Contract\InvoiceService
{

    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function create(StoreLuckyDrawRequest $request): \Illuminate\Database\Eloquent\Model
    {
       return $this->invoiceRepository->create(array_merge($request->input(),
           ['user_id'=> auth()->user()->id,'times'=>setting('times')]));
    }

    public function update(Request $request, Invoice $lucky)
    {
        return $this->invoiceRepository->update($lucky->id,$request->except(['_token','_method']));
    }

    public function ajaxSearch(Request $request): JsonResponse
    {
        $nameQuery = $request->get('name');
        $addressQuery = $request->get('address');
        $materialQuery = $request->get('material');
        if($nameQuery){
            $filterSearch = $this->invoiceRepository->searchByColumn('donor',$nameQuery);
        }
        else if ($addressQuery){
            $filterSearch =$this->invoiceRepository->searchByColumn('address',$addressQuery);
        }
        else if($materialQuery) {
            $filterSearch = $this->invoiceRepository->searchByColumn('mtl',$materialQuery);
        }
        else {
            $this->abort(404);
        }
        return response()->json($filterSearch);
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
                case Enum::TRUNCATE:
                    $status= $this->deleteAll();
                    break;
                default:
                    $status = false;
            }
            $message = ($status) ? ["success"=>Enum::SUCCESS_MESSAGE]: ["error" => Enum::SOMETHING_WRONG_WRONG];
            session($message);
            return back();
        } catch (Exception $exception){
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
        } catch (Exception $e) {
            \Log::error("Exception happen in file import: ". $e->getMessage());
            return false;
        }
    }

    private function export()
    {
        try {
            return  Excel::download(new InvoiceExport(), Carbon::now().'_backup.xlsx');
        } catch (Exception $e) {
            \Log::error("Exception happen in export: ". $e->getMessage());
            return false;
        }
    }

    /**
     * @throws Exception
     */
    private function deleteAll(): bool
    {
        try {
            DB::table('invoices')->truncate();
            return true;
        } catch (Exception $e){
            \Log::error("Exception happen in truncate: ". $e->getMessage());
            return false;
        }
    }

    public function invoiceCount(): array
    {
        $empty_luckys = DB::table('invoices')
            ->select('amount', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_amount'))
            ->where('lucky_no',"")
            ->where('times',setting('times'))
            ->groupBy('amount')->get();

        $lucky_numbers = DB::table('invoices')
            ->select('lucky_no', DB::raw('count(*) as total'),DB::raw("SUM(amount) as amount"))
            ->where('times',setting('times'))
            ->groupBy('lucky_no')
            ->paginate(15);

        return ['empty_luckys' => $empty_luckys,'lucky_numbers' =>$lucky_numbers];
    }

    public function delete($id): bool
    {
        return $this->invoiceRepository->delete($id);
    }

}
