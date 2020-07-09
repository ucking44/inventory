<?php

namespace App\Model\Transaction\Sales;

//use App\Model\Transaction\Sales\SalesH;
use App\Model\Master\Product;
use Illuminate\Database\Eloquent\Model;

class SalesD extends Model
{
    protected $table = 'sales_d';

    protected $fillable = [
        'id_sales',
        'id_product',
        'total',
        'price',
    ];

    public function sale()
    {
        return $this->belongsTo(SalesH::class, 'id_sales');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
