<div class="col-md-3">
    @csrf
    <div class="cardForAdmin">
        <div class="banner" style="background-image: url({{$MasterPointView->image}})">
        </div>
        {{-- <div class="menu">
            <div class="opener"><span></span><span></span><span></span></div>
        </div> --}}
        <h2 class="name mt-3">{{($MasterPointView->master->user->name . $MasterPointView->master->user->surname . $MasterPointView->master->user->lastname) ? ($MasterPointView->master->user->name . ' ' . $MasterPointView->master->user->surname . ' ' . $MasterPointView->master->user->lastname) : $MasterPointView->master->user->email}}</h2>
        <div class="title"><a href="">Подробнее</a></div>
        <div class="actions">
            <div class="follow-info">
                {{-- <h2><a href="#"><span>{{$master->master->masterPoint->count()}}</span><small>Точек</small></a></h2> --}}
                <h2><a href=""><span>{{$MasterPointView->name}}</span><small>Название</small></a></h2>
            </div>
            <div class="follow-info">
                <h2><a><span>{{$MasterPointView->address}}</span><small>Адрес</small></a></h2>
            </div>
            <div class="follow-info">
                <h2><a><span>{{$MasterPointView->created_at->format('d.m.y')}}</span><small>Создание точки</small></a></h2>
                <h2 ><a ><span class="{{$MasterPointView->status ? '' : 'text-danger'}}" id="confirmationspan{{$MasterPointView->id}}">{{$MasterPointView->status ? 'Да' : 'Нет'}}</span><small >Подтверждение</small></a></h2>
            </div>
            <div class="follow-btn">
                <button onclick="update(this, confirmationspan{{$MasterPointView->id}})" data-masterpointid="{{$MasterPointView->id}}" data-status="{{$MasterPointView->status}}">{{$MasterPointView->status ? 'Отозвать' : 'Одобрить'}}</button>
            </div>
        </div>
        <div class="desc">Описание: {{$MasterPointView->description}}</div>
        {{-- {{ \HTML::image('/storage/app/private/'.$master->master->image, "My logo") }} --}}
        {{-- <img src="{{URL::to('/storage/app/private/'.$master->master->image)}}" alt="альтернативный текст"> --}}
    </div>
</div>
