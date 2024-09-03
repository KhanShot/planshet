@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between align-items-center mr-5">
        <h2 class="mt-4">Рекламные кампании</h2>
        <div>
            <a href="{{route('video.create')}}" class="btn btn-outline-dark border-0 background-white border-radius-20">
                <i class="fa fa-plus-circle mt-1"></i>
                добавить закладку
            </a>

            <a href="{{route('campaigns.create')}}" class="btn btn-outline-dark border-radius-20 border-0 background-white">
                <svg  width="18" height="17" viewBox="0 0 18 17"  xmlns="http://www.w3.org/2000/svg">
                    <path class="icon-hover" d="M6.71053 11.1978C10.3492 11.1978 13.4211 11.7965 13.4211 14.1089C13.4211 16.4212 10.3295 17 6.71053 17C3.07181 17 0 16.4004 0 14.0889C0 11.7766 3.09062 11.1978 6.71053 11.1978ZM15.2096 4.47368C15.6536 4.47368 16.014 4.84003 16.014 5.28934V6.34177H17.0904C17.5335 6.34177 17.8947 6.70812 17.8947 7.15743C17.8947 7.60674 17.5335 7.97309 17.0904 7.97309H16.014V9.02645C16.014 9.47576 15.6536 9.8421 15.2096 9.8421C14.7665 9.8421 14.4053 9.47576 14.4053 9.02645V7.97309H13.3307C12.8867 7.97309 12.5263 7.60674 12.5263 7.15743C12.5263 6.70812 12.8867 6.34177 13.3307 6.34177H14.4053V5.28934C14.4053 4.84003 14.7665 4.47368 15.2096 4.47368ZM6.71053 0C9.17514 0 11.1508 2.0012 11.1508 4.4977C11.1508 6.9942 9.17514 8.9954 6.71053 8.9954C4.24591 8.9954 2.27028 6.9942 2.27028 4.4977C2.27028 2.0012 4.24591 0 6.71053 0Z"
                    />
                </svg>
                Добавить</a>
        </div>

    </div>
    @include('layouts.alert')
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Рекломадатель</th>
                <th scope="col">Бюджет (₸)</th>
                <th scope="col">Срок</th>
                <th scope="col">Хронометраж (с)</th>
                <th scope="col">Тип</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($ad_videos as $video)
                <tr>
                    <th scope="row">{{$video->order }}</th>
                    <td>{{$video->advertiser->company_name ?? '-'}}</td>
                    <td>{{$video->campaign->budget ?? 0}}</td>
                    <td>{{$video->campaign ? $video->campaign->start_date . '----' . $video->campaign->end_date : '-'}}</td>
                    <td>{{round($video->duration) ?? 0 }}</td>
                    <td>{{$video->is_placeholder ? 'Заставка' : "Клиент" }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <form method="post" action="{{route('campaigns.delete', $video->id)}}"
                                  onsubmit="return confirm('Вы действительно хотите удалить рекломадателя?')">
                                @method('delete') @csrf
                                <button type="submit" class="btn btn-outline-dark border-0 "><i class="fa fa-trash"></i></button>
                            </form>
                            <button class="btn btn-outline-dark border-0" data-toggle="modal" data-target="#editModal{{$video->id}}"><i class="fa fa-pen-to-square"></i></button>

                            <!-- edit modal -->
                            <div class="modal fade " id="editModal{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$video->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document" >
                                    <div class="modal-content" style="background: #EDEDED">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{$video->id}}">Редактировать видео</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('video.update', $video->id) }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Очередь</label>
                                                    <input type="number" required value="{{$video->order}}" class="form-control border-radius-20" name="order">
                                                </div>
                                                <div class="form-group d-flex justify-content-end">
                                                    <button class="btn btn-dark border-0 border-radius-20">Сохранить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <a href="{{ route('video.detail', $video->id) }}" class="btn btn-outline-dark border-0"><i class="fa fa-chart-simple"></i></a>

                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
