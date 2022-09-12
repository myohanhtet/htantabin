<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invoice::get(c);
    }

    public function headings(): array
    {
        return ['Lucky Number','Amount','Material Amount',
            'Material','Donor','Address','Times','User ID',
            'Number','Invoice Number','Created At','Updated At'];
    }
}
