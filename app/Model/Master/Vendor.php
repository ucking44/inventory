<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Master\PurchaseH;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = ['name', 'address', 'cp', 'phone', 'active', 'user_modified'];

    public function user_modify()
    {
        return $this->belongsTo(User::class, 'user_modified'); //->withDefault();
    }
}

