<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //        Böyle tanımlayınca bütün dosyalarda kullanılabilir
        /* $bitiszamani = now()->addMinute(10);
         $istatiskler = Cache::remember('istatiskler', $bitiszamani, function () {
             return [
                 'bekleyen_siparis' => Order::where("status", "Siparişiniz Alındı")->count(),
                 'onaylanan_siparis' => Order::where("status", "Siparişiniz Alındı")->count(),
             ];
         });
         View::share('istatiskler', $istatiskler);*/
        //        Böyle tanımlayınca bütün dosyalarda kullanılabilir


        //        Böyle tanımlayınca sadece belirtilen klasörlerede kullanıla bilir sadece backend klasörü altındaki viewlarda kullanabilecez dosyalarda kullanılabilir
        View::composer(['backend.*'], function ($view) {
            $bitiszamani = now()->addMinute(10);
            $istatiskler = Cache::remember('istatiskler', $bitiszamani, function () {
                return [
                    'bekleyen_siparis' => Order::where("status", "Siparişiniz Alındı")->count(),
                    'kargoda' => Order::where("status", "Kargoya Verildi")->count(),
                    'onaylanan_siparis' => Order::count(),
                    'toplam_urun' => Product::count(),
                    'toplam_kullanici'=>User::count(),
                    'toplam_kategori'=>Category::count()
                ];
            });
            $view->with('istatiskler', $istatiskler);
        });

        //        Böyle tanımlayınca sadece belirtilen klasörlerede kullanıla bilir sadece backend klasörü altındaki viewlarda kullanabilecez dosyalarda kullanılabilir

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
