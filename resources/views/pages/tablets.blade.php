@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between align-items-center mr-5">
        <h2 class="mt-4">Планшеты ({{$tablets->where('status', 'on')->count()}}/{{$tablets->count()}})</h2>
    </div>
    @include('layouts.alert')
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Мак адрес</th>
                <th scope="col">Состояние</th>
                <th scope="col">Общий заработок</th>
                <th scope="col">Кол-во показов</th>
                <th scope="col">Время работы сегодня</th>
                <th scope="col">Общее время работы</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tablets as $tablet)
                <tr>
                    <th scope="row">{{$tablet->order}}</th>
                    <td>{{ $tablet->mac_address }}</td>
                    <td> @if($tablet->status == 'on') <i class="fa fa-circle text-success"></i> @else <i class="fa fa-circle text-secondary"></i> @endif </td>
                    <td>{{$tablet->views->budget ?? 0}}</td>
                    <td>{{$tablet->views->count ?? 0 }}</td>
                    <td>{{round($tablet->duration) ?? 0 }}</td>
                    <td>{{$tablet->duration_all ?? 0 }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <form method="post" action="{{route('advertisers.delete', $tablet->id)}}"
                                  onsubmit="return confirm('Вы действительно хотите удалить рекломадателя?')">
                                @method('delete') @csrf
                                <button type="submit" class="btn btn-outline-dark border-0 "><i class="fa fa-trash"></i></button>
                            </form>
                            <a href="#" class="btn btn-outline-dark border-0"><i class="fa fa-chart-simple"></i></a>
                            <a href="#" class="btn btn-outline-dark border-0 "> <svg class="icon-hover" width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2187 10.6094C21.2187 16.4657 16.4551 21.2187 10.6094 21.2187L10.3126 21.2147C4.59325 21.0573 -7.15402e-07 16.3665 -4.63751e-07 10.6094C-2.08224e-07 4.76361 4.753 -7.19741e-07 10.6094 -4.63751e-07C16.4551 -2.08224e-07 21.2187 4.76361 21.2187 10.6094ZM13.5694 10.6094C13.5694 10.3972 13.4845 10.1956 13.336 10.0471L9.63331 6.36562C9.48478 6.20648 9.2832 6.13222 9.08162 6.13222C8.86944 6.13222 8.66786 6.20648 8.50872 6.36562C8.20105 6.68391 8.20105 7.18255 8.51933 7.49022L11.6491 10.6094L8.51933 13.7285C8.20105 14.0362 8.20105 14.5455 8.50872 14.8531C8.827 15.1714 9.32564 15.1714 9.63331 14.8531L13.336 11.1717C13.4845 11.0231 13.5694 10.8216 13.5694 10.6094Z"
                                    />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
