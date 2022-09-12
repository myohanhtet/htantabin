<?php

namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoiceImpoer implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
            'lucky_no' => $row['Lucky Number'],
            'amount' => $row['Amount'],
            'mtl_value' => $row['Material Amount'],
            'mtl' => $row['Material'],
            'donor' => $row['Donor'],
            'address' => $row['Address'],
            'times' => $row['Times'],
            'user_id' => $row['User ID'],
            'number' => $row['Number'],
            'invoice_number' => $row['Invoice Number'],
            'created_at' => $row['Created At'],
            'updated_at' => $row['Updated At']
        ]);
    }

}
