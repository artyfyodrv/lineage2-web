<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход в учётную запись</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<form action="{{ route('login-form') }}" method="POST">
    @csrf

    @error('login')
    <span class="error">{{ $message }}</span>
    @enderror

    <label for="username">Логин:</label>
    <input type="text" id="login" name="login" required><br>

    @error('password')
    <span class="error">{{ $message }}</span>
    @enderror
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br>

    <div class="col-md-12">
        <div class="form-group">
            <strong>ReCaptcha:</strong>
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            @if ($errors->has('g-recaptcha-response'))
                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
            @endif
        </div>
    </div>

    @error('login-error')
    <span class="error">{{ $message }}</span>
    @enderror
    <input type="submit" value="Зарегистрироваться">
</form>
</body>
</html>
