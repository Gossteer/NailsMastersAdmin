@extends('layouts.app', ['page' => __('Masters'), 'pageSlug' => 'masters.index'])

@section('content')

{{-- @push('styles')

@endpush --}}

<div class="container">
    <div class="row justify-content">
        @foreach ($masters as $master)
            <div class="col-md-3">
                @csrf
                <div class="cardForAdmin">
                    <div class="banner" style="background-image: url({{$master->master->image}})">
                    </div>
                    {{-- <div class="menu">
                        <div class="opener"><span></span><span></span><span></span></div>
                    </div> --}}
                    <a href="{{ route('masters.index.show', [$master->id]) }}"><h2 class="name mt-3">{{($master->name . $master->surname . $master->lastname) ? ($master->name . ' ' . $master->surname . ' ' . $master->lastname) : $master->email}}</h2></a>
                    <div class="title"><a href="https://www.instagram.com/{{$master->master->portfolio->login_instagram}}/" target="_blank">{{$master->master->portfolio->login_instagram}}</a> </div>
                    <div class="actions">
                        <div class="follow-info">
                            {{-- <h2><a href="#"><span>{{$master->master->masterPoint->count()}}</span><small>Точек</small></a></h2> --}}
                            <h2><a href="tel:{{$master->phone_number}}"><span>{{$master->phone_number}}</span><small>Телефон</small></a></h2>
                        </div>
                        <div class="follow-info">
                            <h2><a href="mailto:{{$master->email}}"><span>{{$master->email}}</span><small>Телефон</small></a></h2>
                        </div>
                        <div class="follow-info">
                            <h2><a><span>{{$master->created_at->format('d.m.y')}}</span><small>Регистрация</small></a></h2>
                            <h2><a><span>{{$master->master->created_at->format('d.m.y')}}</span><small>Подача заявки</small></a></h2>
                        </div>
                        <div class="follow-info">
                            <h2><a><span>{{$master->master->masterPoint->count()}}</span><small>Точек</small></a></h2>
                            <h2 ><a ><span class="{{$master->master->status ? '' : 'text-danger'}}" id="confirmationspan{{$master->id}}">{{$master->master->status ? 'Да' : 'Нет'}}</span><small >Подтверждение</small></a></h2>
                        </div>
                        <div class="follow-btn">
                            <button onclick="update(this, confirmationspan{{$master->id}})" data-masterid="{{$master->id}}" data-status="{{ $master->master->status ? 1 : 0}}">{{$master->master->status ? 'Отозвать' : 'Одобрить'}}</button>
                        </div>
                    </div>
                    <div class="desc">Описание: {{$master->master->portfolio->description}}</div>
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
        url: '{{ route('master.updateStatus') }}',
        type: "POST",
        data: {status:params.dataset.status, id:params.dataset.masterid},
        headers: {
            'X-CSRF-Token': document.getElementsByName("_token")[0].value
        },
        success: function (data) {
            // alert(data);
            if (data) {
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



