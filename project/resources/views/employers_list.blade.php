@extends('layouts.site')

@section('content')
    <div class="container">
        <table id="employers" class="table table-hover table-condensed" style="width:100%">
            <thead>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>Должность</th>
                <th>Дата</th>
                <th>Оклад</th>
                <th>Начальник</th>
                <th>Изображение</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript"
            src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function () {
            $('#employers').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('employers.index') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'fio', name: 'fio'},
                    {data: 'position', name: 'position'},
                    {data: 'date', name: 'date'},
                    {data: 'salary', name: 'salary'},
                    {data: 'chief', name: 'chief'},
                    {
                        "data": "img_path",
                        "render": function ($data, type, row) {
                            if ($data)
                                return '<img src="' + $data + '" style="height:100px;width:100px;" />';
                            else
                                return 'Нет';
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
    <div style="text-align:center">
        <button type="submit" class="btn btn-default"><a href='employers/new'>Новый сотрудник</a></button>
    </div>
@endsection
