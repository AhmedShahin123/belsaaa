<?php

namespace App\Http\Controllers\Api\Employer\Invoice;

use App\Http\Controllers\Api\Controller;
use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;

class IndexInvoicesController extends Controller
{
    public function __invoke(InvoiceRepository $invoiceRepository)
    {
        return $invoiceRepository->paginateByEmployer($this->user());
    }
}
