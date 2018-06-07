<?php

namespace App\Http\Controllers\Frontend\Basket;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;

use  Cart;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasketController extends Controller
{
    public function index()
    {
        return view("frontend.basket.index");
    }

    public function add(Request $request)
    {
        $product = Product::find($request->id);
        $add = Cart::add($product->id, $product->tittle, 1, $product->price, ['slug' => $product->slug]);

        if (auth()->check()) {
            $aktif_sepet_id = session("aktif_sepet_id");
            if (!isset($aktif_sepet_id)) {
                $aktif_sepet = Basket::create([
                    'user_id' => auth()->id()
                ]);
                $aktif_sepet_id = $aktif_sepet->id;
                session()->put('aktif_sepet_id', $aktif_sepet_id);
            }
            BasketProduct::updateOrCreate(
                ['basket_id' => $aktif_sepet_id, 'product_id' => $product->id],//ilk değer veritabanına bakıyor bu kaydı bulura 2 parametre ile gönderilen değerlerle güncelliyor bulamazsa yenisini ekliyor
                ['qty' => $add->qty, 'price' => $add->price, 'status' => 'Beklemede']
            );
        }
        if ($add) {

            return ["status" => "success", "title" => "başarılı", "message" => "Ürün sepete Eklendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Ürün sepete Eklenemedi"];

    }

    public function delete(Request $request)
    {
        if (auth()->check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($request->id);//formu gönderirken ürün ıd sini yox rowID sini göndermişdik o yüzden get fonksiyonu ile rowID den ürün bilgilerine ulaşıyoruz. yukarıda add yaparken product->id yi Carta eklemişdik
            BasketProduct::where('basket_id', $aktif_sepet_id)->where('product_id', $cartItem->id)->delete();
        }

        Cart::remove($request->id);
        return ["status" => "success", "title" => "başarılı", "message" => "Ürün sepete Eklendi"];

    }

    public function destroy()
    {
        if (auth()->check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            BasketProduct::where('basket_id', $aktif_sepet_id)->delete();
        }
        Cart::destroy();
        return ["status" => "success", "title" => "başarılı", "message" => "Ürün sepete Boşaltıldı"];
    }

    public function qtyUpdate(Request $request)
    {
        $rowId = $request->id;

        $validator = Validator::make($request->all(), [
            'qty' => 'required|numeric|between:0,5'
        ]);

        if ($validator->fails()) {
            return ["status" => "error", "title" => "Hatalı", "message" => "5 den fazla olamaz"];
        }

        if (auth()->check()) {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowId);//formu gönderirken ürün ıd sini yox rowID sini göndermişdik o yüzden get fonksiyonu ile rowID den ürün bilgilerine ulaşıyoruz. yukarıda add yaparken product->id yi Carta eklemişdik

            if ($request->qty == 0) { //requestle qelen qty 0 sa siler
                BasketProduct::where("basket_id", $aktif_sepet_id)->where("product_id", $cartItem->id)->delete();
            } else { //sıfır değilse günceller


                BasketProduct::where("basket_id", $aktif_sepet_id)->where("product_id", $cartItem->id)->update([
                    'qty' => $request->qty
                ]);
            }
        }

        Cart::update($rowId, $request->qty);

        return ["status" => "success", "title" => "başarılı", "message" => "Adet Bilgisi Güncellendi"];

    }
}
