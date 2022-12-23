<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Repositories\Contract\InvoiceInterface;
use App\Repositories\Contract\RepositoryInterface;

class InvoiceRepository extends Repository implements InvoiceInterface
{
    protected $model;
    public function __construct(Invoice $model)
    {
        $this->model = $model;
    }
}
