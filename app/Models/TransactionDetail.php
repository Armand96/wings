<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = [
        'document_code',
        'document_number',
        'product_code',
        'price',
        'quantity',
        'unit',
        'subtotal',
    ];

    public function header()
    {
        return $this->belongsTo(TransactionHeader::class, ['document_code', 'document_number'], ['document_code', 'document_number']);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }
}
