<?php

namespace App\Model\Purchase;

use App\Model\Master\Vendor;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Purchase\PurchaseD;

class PurchaseH extends Model
{
    protected $table = 'purchase_h';
    protected $fillable = [
        'no_invoice',
        'total',
        'id_ven',
        'active',
        'status',
        'user_modified',
        'date',
        'information',
    ];

    public function user_modify()
    {
        return $this->belongsTo(User::class, 'user_modified');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_ven');
    }

}
