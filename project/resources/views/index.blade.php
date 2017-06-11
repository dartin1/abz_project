@extends('layouts.site')


@section('content')

    <div class="container">
        {!! $tree !!}

    </div>
    <script type="text/javascript"
            src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('http://code.jquery.com/ui/1.10.4/jquery-ui.min.js') }}"/>
    <script type="text/javascript" src="{{ asset('js/jquery.ui.touch-punch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.mjs.nestedSortable.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.sortable').nestedSortable({
                handle: 'div',
                items: 'li',
                update: function () {
                    var orderNew = $(this).nestedSortable('serialize');
                    $.ajax({
                        type: 'post',
                        rootID: 1,
                        url: '{{ URL::to("/#") }}',
                        headers: '{{ csrf_token() }}',
                        data: {
                            list: orderNew,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                },
                toleranceElement: '> div',
                listType: 'ul',
            });
        });
    </script>
@endsection    