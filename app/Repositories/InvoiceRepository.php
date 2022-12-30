<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Repositories\Contract\InvoiceInterface;

class InvoiceRepository extends Repository implements InvoiceInterface
{
    protected $model;
    public function __construct(Invoice $model)
    {
        $this->model = $model;
    }

    public function emptyLuckyNumber($amount)
    {
        return $this->model->where('lucky_no',"")
            ->where('times',setting('times'))->get();
    }

    public function searchByColumn($column, $value)
    {
        return $this->model->where($column,'LIKE','%'.$value.'%')
            ->distinct()->get($column);
    }
}
