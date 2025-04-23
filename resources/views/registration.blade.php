@extends('layouts.content')

@section('additionalStyles')
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .custom-navbar {
            background: linear-gradient(135deg, rgba(194,123,17,0.8) 0%, rgba(194,76,17,0.8) 100%);
        }
        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .form-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 700px;
        }
        .btn-primary {
            background: linear-gradient(135deg, rgba(194,123,17,0.8) 0%, rgba(194,76,17,0.8) 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, rgba(194,123,17,0.3) 0%, rgba(194,76,17,0.4) 100%);
        }
    </style>
@endsection

@section('content')
<div class="form-container">
    <div class="form-box">
        <h2 class="mb-4">Регистрация</h2>

        <?php $flash = session()->get('message') ?>
        @if($flash)
            <div class="error-message" id="reg-error">
                    <?=$flash?>
            </div>
        @endif

        <form method="post" action="{{ route('sign-up.action') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона</label>
                <input type="tel" name="phone" class="form-control" id="phone" pattern="\+7\d{3}\d{3}\d{4}" placeholder="+7XXXXXXXXXX">
            </div>
            <div class="mb-3">
                <label for="fullname" class="form-label">ФИО</label>
                <input type="text" name="fullname" class="form-control" id="fullname" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Адрес</label>
                <select name="address" id="address" class="form-control">
                    @foreach($addressList as $address)
                        <option value="<?= $address['id'] ?>"> <?= $address['address'] ?> </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
</div>
@endsection
