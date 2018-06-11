<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Basket extends Model
{
    use SoftDeletes;
    protected $table = "baskets";
    protected $guarded = [];

    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }

    public function basket_product()
    {
        return $this->hasMany('App\Models\BasketProduct');
    }


    public static function aktif_sepet_id()
    {
        $aktif_sepet = DB::table('baskets as b')
            ->leftJoin('orders as or', 'or.basket_id', 'b.id')
            ->where('b.user_id', auth()->id())
            ->whereRaw('or.id is null')
            ->orderByDesc('b.created_at')
            ->select('b.id')
            ->first();

        if (!is_null($aktif_sepet)) return $aktif_sepet->id;

    }

    public function sepet_urun_adet()
    {
        return DB::table('basket_products')->where('basket_id', $this->id)->sum('qty');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
