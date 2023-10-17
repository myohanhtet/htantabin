<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection,WithHeadings
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return Invoice::get([
            'lucky_no',
            'amount',
            'mtl_value',
            'mtl',
            'donor',
            'address',
            'times',
            'number',
            'invoice_number',
        ]);
    }

    public function headings(): array
    {
        return ['Lucky Number','Amount','Material Amount',
            'Material','Donor','Address','Times',
            'Number','Invoice Number'];
    }
}
