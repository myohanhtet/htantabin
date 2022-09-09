<?php

namespace App\Imports;

use App\Models\Donor;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DonorImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new Donor([
            'name' => $row['name'],
            'address' => $row['address'],
            'material' => $row['material'],
            'times' => $row['times']
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8'
        ];
    }
}
