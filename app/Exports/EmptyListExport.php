<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmptyListExport implements FromCollection,WithHeadings
{

    public function collection()
    {
      return  $empty_luckys = DB::table('invoices')
            ->select('amount', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_amount'))
            ->where('lucky_no',"")
            ->groupBy('amount')->get();
    }

    public function headings(): array
    {
        return ["ငွေသား", "စောင်ရေ", "ငွေပေါင်း"];
    }
}
