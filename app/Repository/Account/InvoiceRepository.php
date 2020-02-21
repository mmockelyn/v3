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

    public function create($id, $number, $createFromTimestamp, $number_format)
    {
        return $this->invoice->newQuery()
            ->create([
                "user_id" => $id,
                "numberInvoice" => $number,
                "date" => $createFromTimestamp,
                "total" => $number_format
            ]);
    }

    public function get($invoice_id)
    {
        return $this->invoice->newQuery()
            ->find($invoice_id);
    }

}

