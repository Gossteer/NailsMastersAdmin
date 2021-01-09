<div class="col-md-3">
    @csrf
    <div class="cardForAdmin">
        <div class="banner" style="background-image: url({{$NailsJobsView->image}})">
        </div>
        {{-- <div class="menu">
            <div class="opener"><span></span><span></span><span></span></div>
        </div> --}}
        <h2 class="name mt-3">{{($NailsJobsView->masterPoint->master->user->name . $NailsJobsView->masterPoint->master->user->surname . $NailsJobsView->masterPoint->master->user->lastname) ? ($NailsJobsView->masterPoint->master->user->name . ' ' . $NailsJobsView->masterPoint->master->user->surname . ' ' . $NailsJobsView->masterPoint->master->user->lastname) : $NailsJobsView->masterPoint->master->user->email}}</h2>
        <div class="title"><a href="">Подробнее</a></div>
        <div class="actions">
            <div class="follow-info">
                {{-- <h2><a href="#"><span>{{$master->master->masterPoint->count()}}</span><small>Точек</small></a></h2> --}}
                <h2><a href=""><span>{{$NailsJobsView->name}}</span><small>Название</small></a></h2>
            </div>
            <div class="follow-info">
                <h2><a><span>{{$NailsJobsView->categoryNails->name ?? 'Отсутствует'}}</span><small>Категория</small></a></h2>
            </div>
            <div class="follow-info">
                <h2><a><span>{{$NailsJobsView->created_at->format('d.m.y')}}</span><small>Создание работы</small></a></h2>
                <h2 ><a ><span class="{{$NailsJobsView->status ? '' : 'text-danger'}}" id="confirmationspan{{$NailsJobsView->id}}">{{$NailsJobsView->status ? 'Да' : 'Нет'}}</span><small >Подтверждение</small></a></h2>
            </div>
            <div class="follow-btn">
                <button onclick="update(this, confirmationspan{{$NailsJobsView->id}})" data-nailjobid="{{$NailsJobsView->id}}" data-status="{{$NailsJobsView->status}}">{{$NailsJobsView->status ? 'Отозвать' : 'Одобрить'}}</button>
            </div>
        </div>
        <div class="desc">Описание: {{$NailsJobsView->description}}</div>
        {{-- {{ \HTML::image('/storage/app/private/'.$master->master->image, "My logo") }} --}}
        {{-- <img src="{{URL::to('/storage/app/private/'.$master->master->image)}}" alt="альтернативный текст"> --}}
    </div>
</div>
