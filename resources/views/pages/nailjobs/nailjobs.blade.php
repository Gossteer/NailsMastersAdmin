@extends('layouts.app', ['page' => __('NailJobs'), 'pageSlug' => 'nailJobs.index'])

@section('content')

{{-- @push('styles')

@endpush --}}

<div class="container">
    <div class="row justify-content">
        @foreach ($nailjobs as $nailjob)
            @livewire('nails-jobs', ['NailsJobsView' => $nailjob], key($nailjob->id))
            {{-- <img src="{{$master->master->image ? route('storage.gallery.filee', ['file' => $master->master->image]) : ''}}" /> --}}
        @endforeach
    </div>
</div>

@push('styles')
    <link href="{{ asset('css/card.css') }}" rel="stylesheet">
@endpush

<script  type="application/javascript">

    function deleteDiv($selector) {
        document.querySelector("#NailsJobs"+$selector).remove();
    }

</script>

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

@endsection



