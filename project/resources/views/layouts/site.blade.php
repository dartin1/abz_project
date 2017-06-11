<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="csrf_token" charset="utf-8" content="{{ csrf_token() }}"/>
    <title>Project</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jumbotron.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/project/public">{{ 'Project' }}</a>
        </div>
        <ul id="navbar" class="menu">
            @if(! Auth::check())
                <li><a href="register">Регистрация</a></li>
                <li><a href="login">Вход</a></li>
            @else
                <li><a href="/project/public/employers">Сотрудники</a>
                <li><a href="logout">Выход</a>
            @endif
        </ul><!--/.navbar-collapse -->
    </div>
</nav>

@if(count($errors) > 0)

    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif
<br>
<br>
@yield('content')


</body>
</html>
