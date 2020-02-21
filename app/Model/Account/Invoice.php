<?php

namespace App\Model\Account;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    protected $dates = ["date"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
