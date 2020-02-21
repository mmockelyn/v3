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

}

