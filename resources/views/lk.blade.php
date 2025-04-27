@extends('layouts.content')

@section('additionalStyles')
    <style>
        .profile-section {
            background: linear-gradient(135deg, rgba(194,123,17,0.1) 0%, rgba(194,76,17,0.1) 100%);
            padding: 50px 0;
        }

        .custom-navbar {
            background: linear-gradient(135deg, rgba(194,123,17,0.8) 0%, rgba(194,76,17,0.8) 100%) !important;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
    </style>
@endsection

@section('content')
<!-- Личный кабинет -->
<section class="profile-section mt-5">
    <div class="container">
        <h2 class="text-center mb-5">Личный кабинет</h2>
        <div class="row">

            <!-- Форма изменения данных -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Изменение данных</h5>
                        <hr>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">ФИО</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->middle_name . ' ' . auth()->user()->name . ' ' . auth()->user()->last_name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Номер телефона</label>
                                <input type="tel"
                                       pattern="\+7\d{3}\d{3}\d{4}" placeholder="+7XXXXXXXXXX" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', auth()->user()->number) }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Отправленные заявки -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Отправленные заявки</h5>
                        <hr>
                        <ul class="list-group">
                            @foreach($requestsList as $request)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $request->title }}
                                    <span class="badge bg-primary rounded-pill"> {{ $request->getStatus() }} </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Отправленный feedback -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Отправленные отзывы</h5>
                        <hr>
                        @foreach($feedbackList as $feedback)
                            <div class="mb-3">
                                <p><strong>Дата:</strong> {{ (new DateTime($feedback->createdAt))->format('d.m.Y') }} </p>
                                <p><strong>Тема:</strong> {{ $feedback->subject }} </p>
                                <p><strong>Сообщение:</strong> {{ $feedback->message }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
