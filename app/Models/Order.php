<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = ['basket_id', 'amount', 'name', 'adress', 'phone', 'mobile', 'status', 'bank', 'taksit_sayisi',];

    public function basket()
    {
        return $this->belongsTo('App\Models\Basket');
    }





}
