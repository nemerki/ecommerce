<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Requests\Backend\User\UserUpdateReguest;
use App\Models\UserDetail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view("backend.user.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->yetki = $request->yetki;
        $user->active = $request->active;

        if ($request->password != $request->password_confirmation) {
            return ["status" => "error", "title" => "Hatalı", "message" => "Şifreler Eşleşmiyor"];
        } else {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user_detail = new UserDetail();
        $user_detail->user_id = $user->id;
        $user_detail->adress = $request->adress;
        $user_detail->phone = $request->phone;
        $user_detail->mobile = $request->mobile;
        $user_detail->save();
        if ($user && $user_detail) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kullanıcı Eklendi"];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kullanıcı Eklenemedi"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where("id", $id)->firstOrFail();
        return view("backend.user.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateReguest $request, $id)
    {

        $user = User::where('id', $id)->firstOrFail();
        $data = request()->only('name', 'email', 'active', 'yetki');
        if (request()->filled('password')) {

            if ($request->password != $request->password_confirmation) {
                return ["status" => "error", "title" => "Hatalı", "message" => "Şifreler Eşleşmiyor"];
            } else {
                $data['password'] = Hash::make($request->password);
            }

        }
        $user->update($data);

        $user = UserDetail::where("user_id", $id)->firstOrFail();
        $user->update([
            "adress" => $request->adress,
            "phone" => $request->phone,
            "mobile" => $request->mobile
        ]);

        if ($user) {

            return redirect()->route("backend.user.index");
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::where("id", $request->id)->delete();

        if ($user) {

            return ["status" => "success", "title" => "başarılı", "message" => "Kullanıcı silindi."];
        }

        return ["status" => "error", "title" => "Hatalı", "message" => "Kullanıcı silinemedi"];
    }
}
