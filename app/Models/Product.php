<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'barcode_number',
        'product_name',
        'buy_price',
        'sell_price',
        'supplier_id'
    ];

    protected $table = 'products';

    public $timestamps = true;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(Transaction_detail::class, 'product_id', 'id');
    }
}