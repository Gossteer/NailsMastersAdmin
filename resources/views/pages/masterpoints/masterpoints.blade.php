@extends('layouts.app', ['page' => __('MasterPoints'), 'pageSlug' => 'masterPoints.index'])

@section('content')

{{-- @push('styles')

@endpush --}}

<div class="container">
    <div class="row justify-content">
        @foreach ($masterpoints as $masterpoint)
            <div class="col-md-3">
                @csrf
                <div class="cardForAdmin">
                    <div class="banner" style="background-image: url({{$masterpoint->image}})">
                    </div>
                    {{-- <div class="menu">
                        <div class="opener"><span></span><span></span><span></span></div>
                    </div> --}}
                    <h2 class="name mt-3">{{($masterpoint->master->user->name . $masterpoint->master->user->surname . $masterpoint->master->user->lastname) ? ($masterpoint->master->user->name . ' ' . $masterpoint->master->user->surname . ' ' . $masterpoint->master->user->lastname) : $masterpoint->master->user->email}}</h2>
                    <div class="title"><a href="">Подробнее</a></div>
                    <div class="actions">
                        <div class="follow-info">
                            {{-- <h2><a href="#"><span>{{$master->master->masterPoint->count()}}</span><small>Точек</small></a></h2> --}}
                            <h2><a href=""><span>{{$masterpoint->name}}</span><small>Название</small></a></h2>
                        </div>
                        <div class="follow-info">
                            <h2><a><span>{{$masterpoint->address}}</span><small>Адрес</small></a></h2>
                        </div>
                        <div class="follow-info">
                            <h2><a><span>{{$masterpoint->created_at->format('d.m.y')}}</span><small>Создание точки</small></a></h2>
                            <h2 ><a ><span class="{{$masterpoint->status ? '' : 'text-danger'}}" id="confirmationspan{{$masterpoint->id}}">{{$masterpoint->status ? 'Да' : 'Нет'}}</span><small >Подтверждение</small></a></h2>
                        </div>
                        <div class="follow-btn">
                            <button onclick="update(this, confirmationspan{{$masterpoint->id}})" data-masterpointid="{{$masterpoint->id}}" data-status="{{$masterpoint->status}}">{{$masterpoint->status ? 'Отозвать' : 'Одобрить'}}</button>
                        </div>
                    </div>
                    <div class="desc">Описание: {{$masterpoint->description}}</div>
                    {{-- {{ \HTML::image('/storage/app/private/'.$master->master->image, "My logo") }} --}}
                    {{-- <img src="{{URL::to('/storage/app/private/'.$master->master->image)}}" alt="альтернативный текст"> --}}
                </div>
            </div>
            {{-- <img src="{{$master->master->image ? route('storage.gallery.filee', ['file' => $master->master->image]) : ''}}" /> --}}
        @endforeach
    </div>
</div>

@push('styles')
    <link href="{{ asset('css/card.css') }}" rel="stylesheet">
@endpush

<script  type="application/javascript">
function update(params, spantext) {
    // alert(document.getElementsByName("_token")[0].value);
    // var confirm = params.dataset.confirm;
    $.ajax({
        url: '{{ route('masterPoints.updateStatus') }}',
        type: "POST",
        data: {status:params.dataset.status, id:params.dataset.masterpointid},
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
</script>

@endsection



