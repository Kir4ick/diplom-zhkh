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
                    <h2 class="mb-4">Обратная связь</h2>

                    <?php $flash = session()->get('message') ?>
                    @if($flash)
                        <div class="alert-success" id="reg-error">
                                <?=$flash?>
                        </div>
                    @endif

                    <form method="post" action="{{ route('feedback.action') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">Тема сообщения</label>
                            <input type="text" name="subject" min="4" class="form-control" id="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Сообщение</label>
                            <textarea class="form-control" name="body" minlength="10" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
