@extends("layouts.backend")
@section("tittle")
@section("content")
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
            <h5>Tüm Yazılar </h5>

            <div style="padding-top: 3px; padding-right: 11px;" class="text-right">
                <a href="" class="btn btn-success ">Ekle</a>
            </div>
        </div>

        <div class="widget-content nopadding">

            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>Kullanıcı Adı</th>
                    <th>Kullanıcı Email</th>
                    <th>Kullanıcı Yetki</th>
                    <th>Resmi</th>
                    <th>Düzenle</th>
                    <th>Sil</th>
                </tr>
                </thead>
                <tbody>

                <tr class="gradeX">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="center">
                        <a href=""
                           class="btb btn-primary  btn-mini categoryEdit">Düzenle</a>

                    </td>
                    <td class="center">
                        <button data-id="" class="btn btn-danger btn-mini userDelete">Sil
                        </button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
@push("customJs")


@endpush
@push("customCss")



@endpush

