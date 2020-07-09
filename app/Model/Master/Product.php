<?php

namespace App\Model\Master;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Master\PurchaseH;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'code',
        'name',
        'purchase_price',
        'selling_price',
        'information',
        'active',
        'user_modified',
        'stock_available',
        'stock_total'
    ];

    public function user_modify()
    {
        return $this->belongsTo(User::class, 'user_modified');
    }
}

