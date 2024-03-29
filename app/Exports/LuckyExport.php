<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LuckyExport implements  FromCollection,WithHeadings
{

    public function collection(): \Illuminate\Support\Collection
    {
        return $lucky_numbers = DB::table('invoices')
            ->select('lucky_no', DB::raw('count(*) as total'),DB::raw("SUM(amount) as amount"))
            ->where('times',setting('times'))
            ->groupBy('lucky_no')
            ->orderBy('lucky_no')->get();
    }

    public function headings(): array
    {
        return ["မဲနံပါတ်", "စောင်ရေ", "ငွေပေါင်း"];
    }
}
