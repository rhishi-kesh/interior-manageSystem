<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'paymentType', 'pay', 'total', 'due', 'paymentNumber', 'admissionFee', 'discount', 'updated_at', 'created_at'
    ];

    public function pament_mode(): HasOne
    {
        return $this->hasOne(PaymentMode::class,'id','paymentType');
    }
}
