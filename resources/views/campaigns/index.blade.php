@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between align-items-center mr-5">
        <h2 class="mt-4">Рекламные кампании</h2>
        <a href="{{route('campaigns.create')}}" class="btn btn-outline-dark border-radius-20 border-0 background-white">
            <svg  width="18" height="17" viewBox="0 0 18 17"  xmlns="http://www.w3.org/2000/svg">
                <path class="icon-hover" d="M6.71053 11.1978C10.3492 11.1978 13.4211 11.7965 13.4211 14.1089C13.4211 16.4212 10.3295 17 6.71053 17C3.07181 17 0 16.4004 0 14.0889C0 11.7766 3.09062 11.1978 6.71053 11.1978ZM15.2096 4.47368C15.6536 4.47368 16.014 4.84003 16.014 5.28934V6.34177H17.0904C17.5335 6.34177 17.8947 6.70812 17.8947 7.15743C17.8947 7.60674 17.5335 7.97309 17.0904 7.97309H16.014V9.02645C16.014 9.47576 15.6536 9.8421 15.2096 9.8421C14.7665 9.8421 14.4053 9.47576 14.4053 9.02645V7.97309H13.3307C12.8867 7.97309 12.5263 7.60674 12.5263 7.15743C12.5263 6.70812 12.8867 6.34177 13.3307 6.34177H14.4053V5.28934C14.4053 4.84003 14.7665 4.47368 15.2096 4.47368ZM6.71053 0C9.17514 0 11.1508 2.0012 11.1508 4.4977C11.1508 6.9942 9.17514 8.9954 6.71053 8.9954C4.24591 8.9954 2.27028 6.9942 2.27028 4.4977C2.27028 2.0012 4.24591 0 6.71053 0Z"
                      />
            </svg>
            Добавить</a>
    </div>
    @include('layouts.alert')
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Рекломадатель</th>
                <th scope="col">Описание</th>
                <th scope="col">Контакты</th>
                <th scope="col">login/email</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($campaigns as $advertiser)
                <tr>
                    <th scope="row">{{$advertiser->id}}</th>
                    <td>{{$advertiser->company_name}}</td>
                    <td>{{$advertiser->description}}</td>
                    <td>{{$advertiser->phone}}</td>
                    <td>{{$advertiser->user->email ?? '-'}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <form method="post" action="{{route('advertisers.delete', $advertiser->id)}}"
                                  onsubmit="return confirm('Вы действительно хотите удалить рекломадателя?')">
                                @method('delete') @csrf
                                <button type="submit" class="btn btn-outline-dark border-0 border-radius-20"><i class="fa fa-trash"></i></button>
                            </form>
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
