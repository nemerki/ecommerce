<?php

namespace App\Http\Controllers\Frontend\Payment;

use App\Models\Order;
use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {

        if (!auth()->check()) {
            return redirect()->route("frontend.auth.signin")->with('mesaj_tur', 'info')->with('mesaj', 'Ödeme işemi için oturum açmalısınız');
        } elseif (count(Cart::content()) == 0) {
            return redirect()->route("frontend.home.index")->with('mesaj_tur', 'info')->with('mesaj', 'Ödeme işemi için sepetinizde ürün yok');

        }
        $user_detail = auth()->user()->detail;
        return view("frontend.payment.index", compact("user_detail"));


    }

    public function odemeyap()
    {





        $siparis = request()->all();
        $siparis['basket_id'] = session('aktif_sepet_id');
        $siparis['bank'] = "Garanti";
        $siparis['taksit_sayisi'] = 1;
        $siparis['status'] = "Siparişiniz alındı";
        $siparis['amount'] = Cart::subtotal();

        Order::create($siparis);
        Cart::destroy();
        session()->forget('aktif_sepet_id');

        return redirect()->route('frontend.order.index')
            ->with('mesaj_tur', 'success')
            ->with('mesaj', 'Ödemeniz başarılı bir şekilde gerçekleştirildi.');




    }
}
