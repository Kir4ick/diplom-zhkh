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
            max-width: 400px;
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
        <h2 class="mb-4">Авторизация</h2>
        <?php $flash = session()->get('message') ?>
        @if($flash)
            <div class="error-message" id="reg-error">
                <?=$flash?>
            </div>
        @endif

        <form method="post" action="{{ route('sign-in.action') }}">
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label">Email или номер телефона</label>
                <input type="text" name="login" class="form-control" id="login" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>
@endsection
