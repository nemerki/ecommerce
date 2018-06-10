@extends("layouts.backend")
@section("tittle")
@section("content")

    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Kullanıcı Düzenle : {{$user->name}}</h5>
                </div>
                <div class="widget-content nopadding">
                    <form id="userForm" class="form-horizontal" method="POST" action="{{route("backend.user.update",["id"=>$user->id])}}">
                        {{csrf_field()}}

                        <div class="control-group">
                            <label class="control-label">Durum</label>
                            <div class="controls">
                                <select class="span11" name="active" id="">
                                    <option value="0" @if($user->active==0) selected @endif>Passiv</option>
                                    <option value="1" @if($user->active==1) selected @endif>Aktiv</option>

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Ad Soyad </label>
                            <div class="controls">
                                <input type="text" name="name" value="{{old("name",$user->name)}}" class="span11" required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">E-Mail Adresi</label>
                            <div class="controls">
                                <input type="email" name="email" value="{{old("email",$user->email)}}" class="span11" required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Yetki</label>
                            <div class="controls">
                                <select class="span11" name="yetki" id="">
                                    <option value="0" @if($user->yetki==0) selected @endif>Standart Kullanıcı</option>
                                    <option value="1" @if($user->yetki==1) selected @endif>Satıcı</option>
                                    <option @if($user->yetki==2) selected @endif value=2>Admin</option>
                                </select>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Şifre</label>
                            <div class="controls">
                                <input type="password" name="password" class="span11"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Şifre Tekrar</label>
                            <div class="controls">
                                <input type="password" name="password_confirmation" class="span11"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Adres </label>
                            <div class="controls">
                                <input type="text" name="adress" value="{{$user->detail->adress}}" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Telefon </label>
                            <div class="controls">
                                <input type="text" name="phone" value="{{$user->detail->phone}}" class="span11"
                                       required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Mobil </label>
                            <div class="controls">
                                <input type="text" name="mobile" value="{{$user->detail->mobile}}" class="span11"
                                       required/>
                            </div>
                        </div>


                        <div class="form-actions text-right">
                            <button type="submit" id="userUpdate" class="btn btn-success">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
@push("customJs")

@endpush
@push("customCss")



@endpush

