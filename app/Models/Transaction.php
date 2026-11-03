<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice_number',
        'supplier_id',
        'transaction_type',
        'subtotal'
    ];

    protected $table = 'transactions';

    public $timestamps = true;

    public function details()
    {
        return $this->hasMany(Transaction_detail::class, 'transaction_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}