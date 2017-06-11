@extends('layouts.site')

@section('content')
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">

            <div class="col-lg-3 col-lg-8">
                <form method="POST" enctype="multipart/form-data"
                      action="{{route('employerStore',['employer'=>$employer->id])}}">
                    <div class="form-group">
                        <label for="fio">ФИО :</label>
                        <input type="text" class="form-control" id="fio" name="fio" placeholder={{$employer->fio}}>
                    </div>
                    <div class="form-group">
                        <label for="position">Должность :</label>
                        <input type="text" class="form-control" id="position" name="position"
                               placeholder={{$employer->position}}>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Дата приема на работу :</label>
                        <input type="date" name="date" id="date" value={{$employer->date}}>
                    </div>
                    <div class="form-group">
                        <label for="salary">Оклад :</label>
                        <input type="text" class="form-control" id="salary" name="salary"
                               placeholder={{$employer->salary}}>
                    </div>
                    <div class="form-group">
                        <label for="chief">Начальник :</label>
                        <p><select name="chief" id="chief">
                                <option value={{$chief->id}}>{{$chief->fio}}</option>
                                @foreach($chiefs as $templ)
                                    <option value={{$templ->id}}>{{$templ->fio}}</option>
                                @endforeach
                            </select></p>
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение :</label>
                        <input type="file" name="img_path"><br>
                    </div>
                    <div class="col-lg-offset-4 col-lg-7">
                        <button type="submit" class="btn btn-default">ОК</button>
                    </div>

                    {{ csrf_field() }}

                </form>


            </div>
        </div>
    </div>
@endsection