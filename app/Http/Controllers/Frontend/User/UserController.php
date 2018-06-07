<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests\Frontend\SignupRequest;
use App\Mail\UserRegisterMail;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\UserDetail;
use App\User;
use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function signup_form()
    {
        return view("frontend.auth.register");
    }

    public function signup(SignupRequest $request)
    {
        $user = User::create([
            "name" => request("name"),
            "email" => request("email"),
            "password" => Hash::make(request("password")),
            "activation_key" => Str::random(60),
            "active" => 0,
        ]);

        $user->detail()->save(new UserDetail());

        Mail::to(request('email'))->send(new UserRegisterMail($user));
        auth()->login($user);

        return redirect()->route("frontend.home.index");
    }

    public function activate($activate_key)
    {
        $user = User::where("activation_key", $activate_key)->first();
        if (!is_null($user)) {

            $user->update([
                "activation_key" => null,
                "active" => 1,

            ]);
            if ($user) {
                return redirect()->to("/")
                    ->with("mesaj", "Kullanıcı Kaydınız Aktivleşdirildi")
                    ->with("mesaj_tur", "success");
            }
        } else {
            return redirect()->to("/")
                ->with("mesaj", "Daha Önce Aktivleşdirildi")
                ->with("mesaj_tur", "danger");
        }
    }

    public function signin_form()
    {
        return view("frontend.auth.login");
    }

    public function signin()
    {
        if (auth()->attempt(["email" => request("email"), "password" => request("password")], request()->has("remember"))) {
            request()->session()->regenerate();

            //sessiondaki ürünleri  veritabanına alıyoruz
//            $aktif_sepet_id = Basket::firstOrCreate(['user_id' => auth()->id()])->id; //kullanıcı giriş yapınca giriş yapan kullanıcının idsi ile bir basket oluşturur varsa direk seçiyor  ve sondaki id ile de oluşturduğu yada seçdiği bu basketın id sini alıyor
            $aktif_sepet_id = Basket::aktif_sepet_id();
            if (is_null($aktif_sepet_id)) {
                $aktif_sepet = Basket::create(['user_id' => auth()->id()]);
                $aktif_sepet_id = $aktif_sepet->id;
            }

//            dd($aktif_sepet_id);
            session()->put('aktif_sepet_id', $aktif_sepet_id); //yukarıda elde ettiğimiz aktif sepet id sini sessiona aldık

            if (Cart::count() > 0) {

                foreach (Cart::content() as $cartItem) {
                    BasketProduct::updateOrCreate(
                        ['basket_id' => $aktif_sepet_id, 'product_id' => $cartItem->id],
                        ['qty' => $cartItem->qty, 'price' => $cartItem->price, 'status' => 'Beklemede']
                    );
                }
            }
            //Sepetdeki ürünler ile sessiondaki ürünleri eşitliyoruz sessionı temizleyib veritabanındaki tüm ürünleri sessiona alıyoruz
            Cart::destroy();
            $sepeUrunler = BasketProduct::where('basket_id', $aktif_sepet_id)->get();
            foreach ($sepeUrunler as $sepetUrun) {
                Cart::add($sepetUrun->product->id, $sepetUrun->product->tittle, $sepetUrun->qty, $sepetUrun->product->price, ['slug' => $sepetUrun->product->slug]);
            }

            return redirect()->intended("/");
        } else {
            $errors = ["email" => "Hatalı giriş"];
            return back()->withErrors($errors);
        }
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route("frontend.home.index");

    }
}
