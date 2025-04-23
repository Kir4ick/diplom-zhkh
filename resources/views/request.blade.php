@extends('layouts.content')

@section('additionalStyles')
    <style>
        .content {
            flex: 1;
            padding: 40px 0;

            padding-top: 200px;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .custom-navbar {
            background: linear-gradient(135deg, rgba(194,123,17,0.8) 0%, rgba(194,76,17,0.8) 100%);
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

<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="mb-4">Отправка заявки</h2>

                    <?php $flash = session()->get('message') ?>
                    @if($flash)
                        <div class="alert-success" id="reg-error">
                                <?=$flash?>
                        </div>
                    @endif

                    <form method="post" action="{{ route('request.action') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Причина</label>
                            <input type="text" required minlength="3" name="title" class="form-control" id="title">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Номер телефона</label>
                            <input value="{{ auth()->user()->number }}" required type="tel" name="phone" class="form-control" id="phone" pattern="\+7\d{3}\d{3}\d{4}" placeholder="+7XXXXXXXXXX">
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
