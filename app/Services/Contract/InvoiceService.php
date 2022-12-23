<?php

namespace App\Services\Contract;

use App\Http\Requests\StoreLuckyDrawRequest;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface InvoiceService
{
    public function create(StoreLuckyDrawRequest $request);

    public function update(Request $request, Invoice $lucky);

    public function ajaxSearch(Request $request) : JsonResponse;

    public function backup(Request $request);

    public function invoiceCount();
}
