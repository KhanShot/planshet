@extends('layouts.app')
@section('content')

    <div>
        <form method="post"  class="d-flex dropzone" action="{{ route('campaigns.store') }}" enctype="multipart/form-data">
            <div class="col-md-5">
                <div class="d-flex align-items-center mr-5 mt-3 mb-4">
                    <a href="{{route('advertisers')}}" class="btn btn-outline-dark p-0 mr-3 border-radius-20 border-0 background-white">
                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.60986e-07 13.5C2.4985e-07 6.048 6.0615 -3.74241e-06 13.5 -3.65371e-06L13.8777 0.00518625C21.1553 0.205416 27 6.1743 27 13.5C27 20.9385 20.952 27 13.5 27C6.0615 27 7.22827e-08 20.9385 1.60986e-07 13.5ZM9.7335 13.5C9.7335 13.77 9.8415 14.0265 10.0305 14.2155L14.742 18.9C14.931 19.1025 15.1875 19.197 15.444 19.197C15.714 19.197 15.9705 19.1025 16.173 18.9C16.5645 18.495 16.5645 17.8605 16.1595 17.469L12.177 13.5L16.1595 9.531C16.5645 9.1395 16.5645 8.4915 16.173 8.1C15.768 7.695 15.1335 7.695 14.742 8.1L10.0305 12.7845C9.8415 12.9735 9.7335 13.23 9.7335 13.5Z" fill="black"/>
                        </svg></a>
                    <h2 class="mt-2">Новая рекламная кампания</h2>

                </div>


                    @csrf
                    <div class="form-group">
                        <select class="form-select border-radius-20 pl-4 pr-4 pt-2 pb-2" name="advertiser" required>
                            <option value="">Выберите компанию</option>
                            @foreach($advertisers as $adv)
                            <option value="{{$adv->id}}">{{$adv->company_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="budget" type="number" required class="form-control border-radius-20  pl-4 pr-4 pt-2 pb-2" placeholder="Бюджет (₸)">
                    </div>

                    <div class="form-group d-flex align-items-center">
                        <input type="date" id="start_date" name="start_date" required class="form-control border-radius-20  pl-4 pr-4 pt-2 pb-2" placeholder="Начало">
                        <div class="bg-black border-radius-20 ml-3 mr-3" style="height: 5px; width: 50px"></div>
                        <input type="date" id="end_date" name="end_date" required class="form-control border-radius-20  pl-4 pr-4 pt-2 pb-2" placeholder="Конец">
                    </div>


                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-dark border-radius-20 pl-4 pr-4 pt-2 pb-2">Сохранить</button>
                    </div>



            </div>

            <div class="col-md-7 w-100 back-image">
                <input type="file"  required class="my-pond h-100" name="video"/>
            </div>
        </form>
    </div>

@endsection

@section('js')

    <script>

    </script>
<script>
    Date.prototype.addDays = function(days) {
        let date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }

    document.getElementById("start_date").min = new Date().addDays(0).toISOString().split("T")[0];
    document.getElementById("end_date").min = new Date().addDays(1).toISOString().split("T")[0];
</script>
@endsection
