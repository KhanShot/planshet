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
{{--                <th></th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($tablets as $tablet)
                <tr>
                    <th scope="row">{{$tablet->order}}</th>
                    <td>{{ $tablet->mac_address }}</td>
                    <td> @if($tablet->status == 'on') <i class="fa fa-circle text-success"></i> @else <i class="fa fa-circle text-secondary"></i> @endif </td>
                    <td>{{ $tablet->views_budget ?? 0 }} Тг</td>
                    <td>{{$tablet->views_count ?? 0 }}</td>
                    <td>{{Carbon\CarbonInterval::seconds($tablet->working_today)->cascade()->forHumans() }}</td>
                    <td>{{Carbon\CarbonInterval::seconds($tablet->working_all)->cascade()->forHumans() }}</td>
{{--                    <td>--}}
{{--                        <div class="d-flex align-items-center">--}}

{{--                            <a href="#" class="btn btn-outline-dark border-0"><i class="fa fa-chart-simple"></i></a>--}}
{{--                        </div>--}}
{{--                    </td>--}}
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
