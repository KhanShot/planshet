@extends('layouts.app')
@section('content')
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
                <p class="card-text">{{ $data['tablets'] ?? 0 }}</p>
            </div>
        </div>

        <div class="card bg-light mb-3 mr-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Кол-во видео</h5>
                <p class="card-text">{{ $data['tablets'] ?? 0 }}</p>
            </div>
        </div>

        <div class="card bg-light mb-3 mr-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Общ заработок</h5>
                <p class="card-text">{{ $data['tablets'] ?? 0 }}</p>
            </div>
        </div>
    </div>
@endsection
