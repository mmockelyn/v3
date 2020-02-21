<?php

namespace App\Model\Account;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
