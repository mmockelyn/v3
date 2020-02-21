<?php
namespace App\Repository\Account;

use App\Model\Account\InvoiceItem;

class InvoiceItemRepository
{
    /**
     * @var InvoiceItem
     */
    private $invoiceItem;

    /**
     * InvoiceItemRepository constructor.
     * @param InvoiceItem $invoiceItem
     */

    public function __construct(InvoiceItem $invoiceItem)
    {
        $this->invoiceItem = $invoiceItem;
    }

    public function create($id, $description, $int, $number_format, $number_format1)
    {
        return $this->invoiceItem->newQuery()
            ->create([
                "invoice_id" => $id,
                "item" => $description,
                "qte" => $int,
                "unitPrice" => $number_format,
                "total_price" => $number_format1
            ]);
    }

}

