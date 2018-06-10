@extends("layouts.backend")
@section("tittle")
@section("content")
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
            <h5>Tüm Yazılar </h5>

            <div style="padding-top: 3px; padding-right: 11px;" class="text-right">
                <a href="{{route("backend.user.create")}}" class="btn btn-success ">Ekle</a>
            </div>
        </div>

        <div class="widget-content nopadding">

            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ad Soyad</th>
                    <th>Email</th>
                    <th>Durum</th>
                    <th>Yetki</th>
                    <th>Kayıt Tarihi</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
                </thead>
                <tbody>

                @php($i=0)
                @foreach($users as $user)
                    @php($i++)
                    <tr class="gradeX">
                        <td>{{$i}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->active)
                                <span class="label label-success">Aktif</span>
                            @else
                                <span class="label label-warning">Passiv</span>
                            @endif
                        </td>
                        <td>
                            @if($user->yetki==0)
                                <span class="label label-info">Standart</span>
                            @elseif($user->yetki==1)
                                <span class="label label-important">Satıcı</span>
                            @elseif($user->yetki==2)
                                <span class="label label-inverse">Admin</span>
                            @endif
                        </td>
                        <td>{{date("d-M-Y",strtotime($user->created_at))}}</td>
                        <td class="center">

                            <a href="{{route("backend.user.edit",["id"=>$user->id])}}"
                               class="btb btn-primary  btn-mini categoryEdit">Düzenle</a>
                        </td>
                        <td class="center">
                            <button data-id="{{$user->id}}" class="btn btn-danger btn-mini userDelete">Sil
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@push("customJs")

    <script>
        $(".userDelete").on("click", function () {
            var button = $(this);

            swal({
                title: 'Yükleniyor...',
                html:
                '<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>' +
                ' <span class="sr-only">Loading...</span>',
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $.ajax({
                type: "post",
                url: "{{route("backend.user.delete")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    id: button.data("id")
                },
                success: function (response) {
                    if (response.status == "success") {
                        button.closest("tr").remove();
                    }
                    swal.close();
                    swal({
                        type: response.status,
                        title: response.title,
                        text: response.message,
                        timer: 2000
                    });
                },
                error: function (response) {
                    console.log(response);
                }
            })
        })

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/excanvas.min.js"></script>
    <script src="{{asset("assets/backend/js/jquery.min.js")}}"></script>
    <script src="{{asset("assets/backend/js/jquery.ui.custom.js")}}"></script>

    <script src="{{asset("assets/backend/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/backend/js/matrix.tables.js")}}"></script>
@endpush
@push("customCss")


@endpush

