<?php
namespace App\Repository\Account;

use App\Model\Account\Invoice;

class InvoiceRepository
{
    /**
     * @var Invoice
     */
    private $invoice;

    /**
     * InvoiceRepository constructor.
     * @param Invoice $invoice
     */

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function listForUser($id, $limit = null)
    {
        return $this->invoice->newQuery()
            ->where('user_id', $id)
            ->orderBy('date', 'asc')
            ->limit($limit)
            ->get();
    }

}

