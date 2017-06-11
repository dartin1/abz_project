@extends('layouts.site')


@section('content')

    <div class="container" align="center">
        <!-- Example row of columns -->
        <div class="row">

            <div class="col-lg-3 col-lg-8">
                @if($employer)
                    <div class="form-group">
                        <label for="fio">ФИО :</label>
                        <p>{!! $employer->fio!!}</p>
                    </div>
                    <div class="form-group">
                        <label for="position">Должность :</label>
                        <p>{!! $employer->position!!}</p>
                    </div>
                    <div class="form-group">
                        <label for="date">Дата приема на работу :</label>
                        <p>{!! $employer->date!!}</p>
                    </div>
                    <div class="form-group">
                        <label for="salary">Оклад :</label>
                        <p>{!! $employer->salary!!}</p>
                    </div>
                    @if($chief)
                        <div class="form-group">
                            <label for="chief">Начальник :</label>
                            <p>{!! $chief->fio!!}</p>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="image">Изображение :</label>
                        @if($employer->img_path != NULL)
                            <img src={!!$employer->img_path!!} style="height:300px;width:300px;">
                        @else
                            <p>{!! 'Нет'!!}</p>
                        @endif
                    </div>

                @endif


            </div>


        </div>

        <hr>
    </div> <!-- /container -->

@endsection