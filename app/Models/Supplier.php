<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_name',
        'phone',
        'email',
    ];

    protected $table = 'suppliers';

    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }
}