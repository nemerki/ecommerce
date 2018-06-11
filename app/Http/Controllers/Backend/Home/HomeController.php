<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        //View share ile AppProvidera ekledim
//        $bitiszamani = now()->addMinute(10);
//        $istatiskler = Cache::remember('istatiskler', $bitiszamani, function () {
//            return [
//                'bekleyen_Siparis' => Order::where("status", "Siparişiniz Alındı")->count()
//            ];
//        });
//View share ile AppProvidera ekledim

        $cok_satan_urunler = DB::select("
SELECT p.tittle, SUM(bp.qty)qty
FROM orders o
  INNER JOIN baskets b ON b.id=o.basket_id
  INNER JOIN basket_products bp on b.id = bp.basket_id
  INNER JOIN products p ON p.id=bp.product_id
GROUP BY p.tittle 
ORDER BY SUM(bp.qty) DESC
");
        $gunleregore_sati = DB::select("
        SELECT DATE_FORMAT(o.created_at,'%Y-%m-%d') gun,sum(bp.qty) qty
FROM orders o
  INNER JOIN baskets b ON b.id=o.basket_id
  INNER JOIN basket_products bp on b.id = bp.basket_id

GROUP BY DATE_FORMAT(o.created_at,'%Y-%m-%d')
ORDER BY DATE_FORMAT(o.created_at,'%Y-%m-%d')
        ");

        return view("backend.home.index", compact("cok_satan_urunler","gunleregore_sati"));
    }
}
