@extends("layouts.backend")
@section("tittle")
@section("content")
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_ls"><a href="#"> <i class="icon-dashboard"></i>Bekleyen Sipariş <br>
                    <span>{{$istatiskler['bekleyen_siparis']}}</span> </a></li>
            <li class="bg_lb"><a href="#"> <i class="icon-plane"></i>Kargodaki Sipariş <br>
                    <span>{{$istatiskler['kargoda']}}</span> </a></li>
            <li class="bg_lg"><a href="#"> <i class="icon-shopping-cart"></i>Toplam Ürün <br>
                    <span>{{$istatiskler['toplam_urun']}}</span></a></li>
            <li class="bg_ly"><a href="#"> <i class=" icon-reorder"></i> Kategori <br>
                    <span>{{$istatiskler['toplam_kategori']}}</span></a></li>
            <li class="bg_lo"><a href="#"> <i class="icon-group"></i> Kullanıcı <br>
                    <span>{{$istatiskler['toplam_kullanici']}}</span> </a></li>
        </ul>
    </div>


    <div class="span8">
        <div class="panel pane-primary">
            <h4 class="panel-heading text-center">Çok Satan Ürünler</h4>
            <div class="panel-content">
                <canvas id="chartCokSatan"></canvas>
            </div>
        </div>

    </div>

    <div class="span8">
        <div class="panel pane-primary">
            <h4 class="panel-heading text-center">Günlük Satış adedi</h4>
            <div class="panel-content">
                <canvas id="chartGunlukSatis"></canvas>
            </div>
        </div>

    </div>

@endsection
@push("customJs")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script>
            @php
                $label="";
                $data="";
                foreach ($cok_satan_urunler as $rapor){
                $label.="\"$rapor->tittle\",";
                $data.="\"$rapor->qty\",";
                }
            @endphp

        var ctx = document.getElementById("chartCokSatan").getContext('2d');
        var chartCokSatan = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [{!! $label !!}],
                datasets: [{
                    label: 'Çok satan ürünler',
                    data: [{!! $data !!}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend:{
                    position:'bottom',
                    display:false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true, stepSize: 1
                        }
                    }]
                }
            }
        });
    </script>

    <script>
            @php
                $label="";
                $data="";
                foreach ($gunleregore_sati as $rapor){
                $label.="\"$rapor->gun\",";
                $data.="\"$rapor->qty\",";
                }
            @endphp

        var ctx2 = document.getElementById("chartGunlukSatis").getContext('2d');
        var chartGunlukSatis = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [{!! $label !!}],
                datasets: [{
                    label: 'Çok satan ürünler',
                    data: [{!! $data !!}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend:{
                    position:'bottom',
                    display:false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true, stepSize: 1
                        }
                    }]
                }
            }
        });
    </script>
@endpush
@push("customCss")



@endpush

