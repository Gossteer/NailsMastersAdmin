<div class="col-md-3">
    @csrf
    <div class="cardForAdmin">
        {{-- {{dd($userMaster)}} --}}
        {{--{{$userMaster = new App\Models\UserMaster($userMaster)}} --}}

        <div class="banner" style="background-image: url({{$userMaster->master->image}})">
        </div>
        {{-- <div class="menu">
            <div class="opener"><span></span><span></span><span></span></div>
        </div> --}}
        <a href="{{ route('masters.index.show', [$userMaster->id]) }}"><h2 class="name mt-3">{{($userMaster->name . $userMaster->surname . $userMaster->lastname) ? ($userMaster->name . ' ' . $userMaster->surname . ' ' . $userMaster->lastname) : $userMaster->email}}</h2></a>
        <div class="title"><a style="font-weight: 550" href="https://www.instagram.com/{{$userMaster->master->portfolio->login_instagram}}/" target="_blank">{{$userMaster->master->portfolio->login_instagram}}</a> </div>
        <div class="actions">
            <div class="follow-info">
                <h2><a href="tel:{{$userMaster->phone_number}}"><span>{{$userMaster->phone_number}}</span><small>Телефон</small></a></h2>
            </div>
            <div class="follow-info">
                <h2><a href="mailto:{{$userMaster->email}}"><span>{{$userMaster->email}}</span><small>Почта</small></a></h2>
            </div>
            <div class="follow-info">
                <h2><a><span>{{$userMaster->created_at->format('d.m.y')}}</span><small>Регистрация</small></a></h2>
                <h2><a><span>{{$userMaster->master->created_at->format('d.m.y')}}</span><small>Подача заявки</small></a></h2>
            </div>
            <div class="follow-info">
                <h2><a><span>{{$userMaster->master->masterPoint->count()}}</span><small>Точек</small></a></h2>
                <h2 ><a ><span class="{{$userMaster->master->status ? '' : 'text-danger'}}" id="confirmationspan{{$userMaster->id}}">
                    @switch($userMaster->master->status)
                        @case(-1)
                            Заблокирован
                            @break
                        @case(0)
                            Нет
                            @break
                        @case(1)
                            Да
                            @break
                        @default

                    @endswitch
                </span><small >Подтверждение</small></a></h2>
            </div>
            <div class="follow-btn mt-2">
                <button wire:click="setStatus()">{{$userMaster->master->status ? 'Отозвать' : 'Одобрить'}}</button>
            </div>
        </div>
        <div class="desc ">Описание: {{$userMaster->master->portfolio->description}}</div>
        {{-- {{ \HTML::image('/storage/app/private/'.$userMaster->master->image, "My logo") }} --}}
        {{-- <img src="{{URL::to('/storage/app/private/'.$userMaster->master->image)}}" alt="альтернативный текст"> --}}

    </div>
</div>
{{-- <img src="{{$userMaster->master->image ? route('storage.gallery.filee', ['file' => $userMaster->master->image]) : ''}}" /> --}}
