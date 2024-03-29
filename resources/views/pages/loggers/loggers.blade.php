@extends('layouts.app', ['page' => __('Loggers'), 'pageSlug' => 'logger.index'])

@section('content')

<div class="container">
    <div class="row justify-content">

        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Тип
                                    </th>
                                    <th>
                                        Сообщение
                                    </th>
                                    <th>
                                        Пользователь
                                    </th>
                                    <th >
                                        Переход к
                                    </th>
                                    <th >
                                        Дата
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loggers as $logger)
                                    <tr>
                                        <td>
                                            {{$logger->type}}
                                        </td>
                                        <td>
                                            {{$logger->message}}
                                        </td>
                                        <td>
                                            {{$logger->user->email}}
                                        </td>
                                        <td>
                                            <a href="https://www.instagram.com/{{$logger->nailsJobs->instagram ?? null}}" target="__blank">{{$logger->nailsJobs->instagram ?? null}}</a>
                                        </td>
                                        <td>
                                            {{$logger->created_at}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                {{ $loggers->links() }}
            </div>
        </div>
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-3 text-left">
                            <h3 class="card-category">Полная статистика действий</h3>
                            <h2 class="card-title"><i class="tim-icons icon-send text-success"></i> {{$loggers->total()}}</h2>
                        </div>
                        <div class="col-sm-3 text-left">
                            <h3 class="card-category">Выбранная статистика</h3>
                            <h2 class="card-title" id="loggercanvascountselectoption"><i class="tim-icons icon-cloud-download-93 text-success"></i>{{array_sum(json_decode($canvas[2]))}}</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right"  data-toggle="buttons">
                                <label class="btn btn-sm btn-primary btn-simple" onclick="changeCanvas(0)" id="0">
                                    <input type="radio" name="options"  checked>
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Авторизаций</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-button-power"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple active" onclick="changeCanvas(2)" id="2">
                                    <input type="radio" class="d-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Загрузка ноготков</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-cloud-download-93"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" onclick="changeCanvas(3)" id="3">
                                    <input type="radio" class="d-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Редиректов</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-tap-02"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" onclick="changeCanvas(4)" id="4">
                                    <input type="radio" class="d-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Избранных</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-shape-star"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" onclick="changeCanvas(1)" id="1">
                                    <input type="radio" class="d-none d-sm-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Регистраций</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-simple-add"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="loggercanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Общая статистика</h5>
                    <h2 class="card-title">Приложения</h2>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="fullexperience"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- <script  type="application/javascript">
function update(params, spantext) {
    // alert(document.getElementsByName("_token")[0].value);
    // var confirm = params.dataset.confirm;
    $.ajax({
        url: '{{ route('nailJobs.updateStatus') }}',
        type: "POST",
        data: {status:params.dataset.status, id:params.dataset.nailjobid},
        headers: {
            'X-CSRF-Token': document.getElementsByName("_token")[0].value
        },
        success: function (data) {
            // alert(data);
            if (data == 1 || data == 3) {
                params.dataset.status = data;
                params.innerText = 'Отозвать';
                spantext.innerText = 'Да';
                spantext.className = '';
            } else {
                params.dataset.status = '0';
                params.innerText = 'Одобрить';
                spantext.innerText = 'Нет';
                spantext.className = 'text-danger';
            }
            // $('#addArticle').modal('hide');
            // $('#articles-wrap').removeClass('hidden').addClass('show');
            // $('.alert').removeClass('show').addClass('hidden');
            // var str = '<tr><td>'+data['id']+
            // '</td><td><a href="/article/'+data['id']+'">'+data['title']+'</a>'+
            // '</td><td><a href="/article/'+data['id']+'" class="delete" data-delete="'+data['id']+'">Удалить</a></td></tr>';
            // $('.table > tbody:last').append(str);
        },

        error: function (msg) {
            alert('Ошибка');
        }

    });
}
</script> --}}

<script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
<script>
    const type_id_login = {{$canvas[0]}};
    const type_id_register = {{$canvas[1]}};
    const type_id_loadingnailsjobs = {{$canvas[2]}};
    const type_id_redirecttoinstagram = {{$canvas[3]}};
    const type_id_addfavoritenailsjobs = {{$canvas[4]}};
    const loggercanvascountselectoption = document.getElementById('loggercanvascountselectoption');
    const reducer = (accumulator, currentValue) => accumulator + currentValue;

    function changeCanvas(x) {
        switch(x) {
            case 0:
                myChartLogger.data.datasets[0].data = type_id_login;
                loggercanvascountselectoption.innerHTML = '<i class="tim-icons icon-button-power text-success"></i>' + type_id_login.reduce(reducer);
                break;
            case 1:
                myChartLogger.data.datasets[0].data = type_id_register;
                loggercanvascountselectoption.innerHTML = '<i class="tim-icons icon-send text-success"></i>' + type_id_register.reduce(reducer);
                break;
            case 2:
                myChartLogger.data.datasets[0].data = type_id_loadingnailsjobs;
                loggercanvascountselectoption.innerHTML = '<i class="tim-icons icon-cloud-download-93 text-success"></i>' + type_id_loadingnailsjobs.reduce(reducer);
                break;
            case 3:
                myChartLogger.data.datasets[0].data = type_id_redirecttoinstagram;
                loggercanvascountselectoption.innerHTML = '<i class="tim-icons icon-tap-02 text-success"></i>' + type_id_redirecttoinstagram.reduce(reducer);
                break;
            case 4:
                myChartLogger.data.datasets[0].data = type_id_addfavoritenailsjobs;
                loggercanvascountselectoption.innerHTML = '<i class="tim-icons icon-simple-add text-success"></i>' + type_id_addfavoritenailsjobs.reduce(reducer);
                break;
        }
        myChartLogger.update();
    }


    gradientChartOptionsConfiguration =  {
      maintainAspectRatio: false,
      legend: {
            display: false
       },

       tooltips: {
         backgroundColor: '#fff',
         titleFontColor: '#333',
         bodyFontColor: '#666',
         bodySpacing: 4,
         xPadding: 12,
         mode: "nearest",
         intersect: 0,
         position: "nearest"
       },
       responsive: true,
       scales:{
         yAxes: [{
           barPercentage: 1.6,
               gridLines: {
                 drawBorder: false,
                   color: 'rgba(29,140,248,0.0)',
                   zeroLineColor: "transparent",
               },
               ticks: {
                 suggestedMin:50,
                 suggestedMax: 110,
                   padding: 20,
                   fontColor: "#9a9a9a"
               }
             }],

         xAxes: [{
           barPercentage: 1.6,
               gridLines: {
                 drawBorder: false,
                   color: 'rgba(220,53,69,0.1)',
                   zeroLineColor: "transparent",
               },
               ticks: {
                   padding: 20,
                   fontColor: "#9a9a9a"
               }
             }]
         }
    };

    gradientChartOptionsConfigurationexperience =  {
      maintainAspectRatio: false,
      legend: {
            display: false
       },

       tooltips: {
         backgroundColor: '#fff',
         titleFontColor: '#333',
         bodyFontColor: '#666',
         bodySpacing: 4,
         xPadding: 12,
         mode: "nearest",
         intersect: 0,
         position: "nearest"
       },
       responsive: true,
       scales:{
         yAxes: [{
           barPercentage: 1.6,
               gridLines: {
                 drawBorder: false,
                   color: 'rgba(29,140,248,0.0)',
                   zeroLineColor: "transparent",
               },
               ticks: {
                 suggestedMin:50,
                 suggestedMax: 110,
                   padding: 20,
                   fontColor: "#9a9a9a"
               }
             }],

         xAxes: [{
           barPercentage: 1,
               gridLines: {
                 drawBorder: false,
                   color: 'rgba(220,53,69,0.1)',
                   zeroLineColor: "transparent",
               },
               ticks: {
                   padding: 20,
                   fontColor: "#9a9a9a"
               }
             }]
         }
    };

    var ctxlogger = document.getElementById("loggercanvas").getContext("2d");
    var ctxexperience = document.getElementById("fullexperience").getContext("2d");

    var gradientStroke = ctxlogger.createLinearGradient(0,230,0,50);
    var gradientStrokeexperience = ctxexperience.createLinearGradient(0,230,0,50);

    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
    gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    gradientStrokeexperience.addColorStop(1, 'rgba(72,72,176,0.2)');
    gradientStrokeexperience.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStrokeexperience.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    var datalogger = {
      labels: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
      datasets: [{
        label: "",
        fill: true,
        backgroundColor: gradientStroke,
        borderColor: '#d048b6',
        borderWidth: 2,
        borderDash: [],
        borderDashOffset: 0.0,
        pointBackgroundColor: '#d048b6',
        pointBorderColor:'rgba(255,255,255,0)',
        pointHoverBackgroundColor: '#d048b6',
        pointBorderWidth: 20,
        pointHoverRadius: 4,
        pointHoverBorderWidth: 15,
        pointRadius: 4,
        data: type_id_loadingnailsjobs,
      }]
    };

    var dataexperience = {
      labels: [
        @foreach ($fullexperiencearray as $name => $value)
            '{{__('canvas.'. $name)}}',
        @endforeach
      ],
      datasets: [{
        label: "",
        fill: true,
        backgroundColor: gradientStrokeexperience,
        borderColor: '#1f8ef1',
        borderWidth: 2,
        borderDash: [],
        borderDashOffset: 0.0,
        pointBackgroundColor: '#d048b6',
        pointBorderColor:'rgba(255,255,255,0)',
        pointHoverBackgroundColor: '#d048b6',
        pointBorderWidth: 20,
        pointHoverRadius: 4,
        pointHoverBorderWidth: 15,
        pointRadius: 4,
        data: [
            @foreach ($fullexperiencearray as $name => $value)
                {{$value}},
            @endforeach
        ],
      }]
    };

    var myChartLogger = new Chart(ctxlogger, {
      type: 'line',
      data: datalogger,
      options: gradientChartOptionsConfiguration
    });

    var myChartExperience = new Chart(ctxexperience, {
      type: 'bar',
      data: dataexperience,
      options: gradientChartOptionsConfigurationexperience
    });
</script>

@endsection



