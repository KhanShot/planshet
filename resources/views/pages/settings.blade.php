@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between align-items-center mr-5">
        <h2 class="mt-4">Настройки</h2>
    </div>
    @include('layouts.alert')
    <div>
        <div class="card col-md-4">
            <div class="card-header">Цена за секунд показа</div>
            <div class="card-body">
                <form action="{{ route('settings.create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="number" name="price" class="form-control bg-secondary-subtle" required value="{{ $settings->price ?? null }}">
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-secondary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
