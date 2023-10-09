<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;

    protected $primaryKey = ['document_code', 'document_number'];
    public $incrementing = false;

    protected $fillable = [
        'document_code',
        'document_number',
        'user',
        'total',
        'date',
    ];

    public function detail()
    {
        return $this->hasMany(TransactionDetail::class, ['document_code', 'document_number'], ['document_code', 'document_number']);
    }
}
