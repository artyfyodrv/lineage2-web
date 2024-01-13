<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Учётная запись</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark w-100">
            <div class="navbar-brand" style="color: #ffffff">L2WEB</div>
            <div class="navbar-brand mx-auto" style="color: #ffffff">Учётная запись {{ Auth::user()->login }}</div>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-2 bg-dark h-100">
            <div class="sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #ffffff; text-decoration: none;">Профиль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('change-password-page') }}" style="color: #ffffff; text-decoration: none;">Изменить пароль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #ffffff; text-decoration: none;">Изменить почту</a>
                    </li>
                    <li class="nav-item mt-auto mx-auto">
                        <a class="btn btn-primary" href="{{ route('logout') }}">Выход</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="current-password">Текущий пароль</label>
                <input type="password" class="form-control" id="current-password" placeholder="Введите текущий пароль">
            </div>
            <div class="form-group">
                <label for="new-password">Новый пароль</label>
                <input type="password" class="form-control" id="new-password" placeholder="Введите новый пароль">
                <br>
                <input type="password" class="form-control" id="confirm-password" placeholder="Подтвердите новый пароль">
            </div>
        </div>
    </div>
</div>
</body>
</html>
