<?php

namespace App\Model\Purchase;

use App\Model\Purchase\PurchaseH;
use App\Model\Master\Product;
use Illuminate\Database\Eloquent\Model;

class PurchaseD extends Model
{
    protected $table = 'purchase_d';

    protected $fillable = [
        'id_purchase',
        'id_product',
        'total',
        'price',
    ];

    public function purchase()
    {
        return $this->belongsTo(PurchaseH::class, 'id_purchase');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
