<?php
namespace App\Repository\Account;

use App\HelpersClass\Generator;
use App\Model\Account\Invoice;
use Carbon\Carbon;

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

    public function listForUserByDate($q)
    {
        return $this->invoice->newQuery()
            ->where('user_id', auth()->user()->id)
            ->where('date', 'like', '%'.$q.'%')
            ->get();
    }

    public function loadChartData($firstMonth, $LastMonth)
    {
        $data = $this->invoice->newQuery()
            ->whereBetween('date', [Carbon::createFromTimestamp(strtotime($firstMonth)), Carbon::createFromTimestamp(strtotime($LastMonth))])
            ->sum('total');

        return Generator::formatCurrency($data);
    }

}

