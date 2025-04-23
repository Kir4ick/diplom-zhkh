@extends('layouts.content')
@section('content')
<header class="vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, rgba(194,123,17,0.8) 0%, rgba(194,76,17,0.8) 100%), url('bg-image.jpg') no-repeat center center; background-size: cover;">
    <div class="container text-center text-white">
        <h1 class="display-4 mb-4">УК ДОМОВОЙ</h1>
        <p class="lead mb-5">Профессиональное управление вашей недвижимостью</p>
        <a href="#services" class="btn btn-light btn-lg">Узнать больше</a>
    </div>

    <div class="scroll-arrow" id="scrollArrow"></div>
</header>

<section id="services" class="elegant-section">
    <div class="container">
        <h2 class="text-center mb-5">Наши услуги</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="https://avatars.mds.yandex.net/i?id=45e69f4ca6031120366565de2ce887b9_l-4688954-images-thumbs&n=13" class="card-img-top" alt="Ремонт">
                    <div class="card-body">
                        <h5 class="card-title">Ремонт помещений</h5>
                        <p class="card-text">Профессиональный ремонт жилых и коммерческих помещений. Выполняем отделочные работы, замену коммуникаций, перепланировку и дизайн интерьера. Гарантия качества на все виды работ.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="https://avatars.mds.yandex.net/i?id=6e91869eb00e1fe400c5d6a7fdfac3e9_l-5235458-images-thumbs&n=13" class="card-img-top" alt="Благоустройство">
                    <div class="card-body">
                        <h5 class="card-title">Благоустройство</h5>
                        <p class="card-text">
                            Комплексный ремонт квартир, офисов и подъездов.
                            Включает малярные работы, электрику, сантехнику
                            и отделку под ключ. Индивидуальный подход к каждому проекту.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="https://i.vuzopedia.ru/storage/app/uploads/public/66f/e58/6ed/66fe586ed2b0e851997346.jpg" class="card-img-top" alt="Коммунальные услуги">
                    <div class="card-body">
                        <h5 class="card-title">Коммунальные услуги</h5>
                        <p class="card-text">Полный спектр коммунальных услуг для жилых домов и предприятий. Включает водоснабжение, отопление, электричество и вывоз мусора. Качественное обслуживание и оперативное устранение аварий.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(!\Illuminate\Support\Facades\Auth::guest())
<section class="news-section">
    <div class="container">
        <div class="news-grid">
            @foreach($notification as $newsItem)
                <div class="news-card">
                    <div class="news-card-body">
                        {!! $newsItem->message !!}
                    </div>
                    <div class="news-card-actions">
                        <span class="news-date">{{ $newsItem->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<?php $flash = session()->get('requestMessage') ?>
@if($flash)
    <div class="alert alert-success alert-dismissible fade show alert-absolute" role="alert">
        <?= $flash ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    setTimeout(function() {
        let alert = document.querySelector('.alert-absolute');
        if (alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollArrow = document.getElementById('scrollArrow');

        // Анимация при загрузке
        function initialAnimation() {
            scrollArrow.style.animation = 'moveDown 1s forwards';

            setTimeout(() => {
                scrollArrow.style.animation = 'moveUp 1s forwards';
            }, 1500);
        }

        // Прокрутка при клике
        scrollArrow.addEventListener('click', function() {
            document.querySelector('#services').scrollIntoView({
                behavior: 'smooth'
            });
        });

        // Добавляем пользовательские анимации
        const style = document.createElement('style');
        style.innerHTML = `
        @keyframes moveDown {
            from { transform: translate(-50%, 0); }
            to { transform: translate(-50%, 100px); }
        }
        @keyframes moveUp {
            from { transform: translate(-50%, 100px); }
            to { transform: translate(-50%, 0); }
        }
    `;
        document.head.appendChild(style);

        // Запускаем начальную анимацию
        initialAnimation();
    });
</script>
@endsection
