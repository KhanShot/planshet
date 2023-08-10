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
                <th scope="col">Название</th>
                <th scope="col">Мак адрес</th>
                <th scope="col">Состояние</th>
                <th scope="col">Общий заработок</th>
                <th scope="col">Кол-во показов</th>
                <th scope="col">Время показа сегодня</th>
                <th scope="col">Общее время показа</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tablets as $tablet)
                <tr>
                    <th scope="row">{{$tablet->id}}</th>
                    <td>{{ $tablet->name }}</td>
                    <td>{{ $tablet->mac_address }}</td>
                    <td> @if($tablet->status == 'on') <i class="fa fa-circle text-success"></i> @else <i class="fa fa-circle text-secondary"></i> @endif </td>
                    <td>{{ $tablet->views_budget ?? 0 }} Тг</td>
                    <td>{{ count($tablet->views) }}</td>
                    <td>{{Carbon\CarbonInterval::seconds($tablet->views_today)->cascade()->forHumans() }}</td>
                    <td>{{Carbon\CarbonInterval::seconds($tablet->views_all)->cascade()->forHumans() }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-outline-dark border-0" data-toggle="modal" data-target="#tablet_edit_{{$tablet->id}}" ><i class="fa fa-edit"></i></a>
                            <form action="{{route('tablets.reset', $tablet->id)}}" method="post"
                            onsubmit="return confirm('Вы действительно хотите сбросить все данные для этого планшета ?')">
                                @csrf <button type="submit" class="btn btn-outline-dark border-0"><i class="fa fa-rotate"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="tablet_edit_{{$tablet->id}}" tabindex="-1" role="dialog" aria-labelledby="tablet_edit_Label{{$tablet->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background: #EDEDED">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tablet_edit_Label{{$tablet->id}}">Редактировать планшет</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('tablets.update', $tablet->id ) }}">
                                    @csrf

                                    <div class="form-group">
                                        <label>Название планшета</label>
                                        <input type="text" class="form-control border-radius-20" name="name" value="{{$tablet->name}}">
                                    </div>

                                    <div class="form-group d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-dark border-0 background-white border-radius-20">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
