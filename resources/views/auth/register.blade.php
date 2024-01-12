<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body>
<form action="{{ route('register-form') }}" method="POST">
    @csrf

    @error('login')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="username">Логин:</label>
    <input type="text" id="login" name="login" required><br>

    @error('email')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="email">Эмейл:</label>
    <input type="email" id="email" name="email" required><br>

    @error('password')
    <span class="error">{{ $message }}</span>
    @enderror
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br>

    <label for="password_confirmation">Подтверждение пароля:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required><br>

    <input type="submit" value="Зарегистрироваться">
</form>
</body>
</html>
