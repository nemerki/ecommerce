<h1>{{config("app.name")}}</h1>
<p>Kaydınız başarılı bir Şekilde yapıldı.</p>
<p>Hoşgeldin {{$user->name}}</p>
<p>Kaydınızı Aktifleşdirmek için <a href="{{config("app.url")}}/kullanici/aktiflesdir/{{$user->activation_key}}">tıklayın</a> veya aşağıdaki bağlantıyı açın</p>
<p>{{config("app.url")}}/kullanici/aktiflesdir/{{$user->activation_key}}</p>
