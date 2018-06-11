@extends("layouts.backend")
@section("tittle")
@section("content")
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
            <h5>Tüm Siparişler </h5>


        </div>

        <div class="widget-content nopadding">

            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Sipariş Kodu</th>
                    <th>Kullanıcı</th>
                    <th>Tutar</th>
                    <th>Durum</th>
                    <th>Sipariş Tarihi</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tbody>

                @php($i=0)
                @foreach($orders as $order)
                    @php($i++)
                    <tr class="gradeX">
                        <td>{{$i}}</td>
                        <td>SP-{{$order->id}}</td>
                        <td>{{$order->basket->user->name}}</td>
                        <td>{{$order->amount*((100+config('cart.tax'))/100)}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{date("d-M-Y",strtotime($order->created_at))}}</td>
                        <td class="center">

                            <a href="{{route("backend.order.detail",["id"=>$order->id])}}"
                               class="btb btn-primary  btn-mini categoryEdit">Detay</a>
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
        $(".productDelete").on("click", function () {
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
                url: "{{route("backend.product.delete")}}",
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

