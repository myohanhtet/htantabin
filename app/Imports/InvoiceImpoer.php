<?php

namespace App\Imports;

use App\Models\Invoice;
use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoiceImpoer implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new Invoice([
            'lucky_no' => $row['lucky_number'],
            'amount' => $row['amount'],
            'mtl_value' => $row['material_amount'],
            'mtl' => $row['material'],
            'donor' => $row['donor'],
            'address' => $row['address'],
            'times' => $row['times'],
            'user_id' => auth()->user()->id,
            'number' => $row['number'],
            'invoice_number' => empty($row['invoice_number']) ?  $row['times'] .'-'. str_pad($row['number'],5,0,STR_PAD_LEFT): $row['invoice_number'],

        ]);
    }
}
