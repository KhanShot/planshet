@extends('layouts.app')
@section('content')
    <style>
        .defis{
            width: 25px;
            height: 5px;
            background: black;
        }
    </style>
    <div class="">
        <form >
            <div class="d-flex align-items-center">
                <div class="form-group mr-3">
                    <input type="date" class="form-control border-radius-20" name="date_from" value="{{request()->date_from}}">
                </div>
                    <div class="defis form-group mr-3 border-radius-20"></div>
                <div class="form-group mr-5">
                    <input type="date" class="form-control border-radius-20" name="date_to" value="{{request()->date_to}}">
                </div>

                <div class="form-group mr-2">
                    <button class="btn btn-outline-dark border-radius-20 border-0 background-white pl-5 pr-5">Фильтр</button>
                </div>
                <div class="form-group">
                    <a href="/dashboard" class="btn btn-outline-dark border-radius-20 border-0 background-white pl-5 pr-5">Cбросить фильтр</a>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid d-flex flex-wrap">
        <div class="card bg-light mb-3 mr-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Кол-во планшетов</h5>
                <p class="card-text">{{ $data['tablets'] ?? 0 }}</p>
            </div>
        </div>

        <div class="card bg-light mb-3 mr-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Общ время видео</h5>
                <p class="card-text">{{ round($data['video_duration_all']) . ' c' ?? 0 }}</p>
            </div>
        </div>

        <div class="card bg-light mb-3 mr-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Кол-во видео</h5>
                <p class="card-text">{{ $data['video_count'] ?? 0 }}</p>
            </div>
        </div>

        <div class="card bg-light mb-3 mr-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Общ заработок</h5>
                <p class="card-text">{{ $data['price_total'] . ' Тг' ?? 0 }}</p>
            </div>
        </div>

        <div class="card bg-light mb-3 mr-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Кол-во показов</h5>
                <p class="card-text">{{ $data['views_total'] ?? 0 }}</p>
            </div>
        </div>
        <div class="card bg-light mb-3 mr-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Общ время показов</h5>
                <p class="card-text">{{ round($data['views_time_total']) }} c</p>
            </div>
        </div>

    </div>
@endsection
