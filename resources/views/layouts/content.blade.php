<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title', 'УК домовой') </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
    <style>
        :root {
            --primary: #c27b11;
            --secondary: #c24c11;
            --dark: #544e4b;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
        }

        .elegant-section {
            background: linear-gradient(135deg, rgba(194,123,17,0.1) 0%, rgba(194,76,17,0.1) 100%);
            padding: 80px 0;
        }

        .service-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .service-card img {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .service-card:hover img {
            transform: scale(1.1);
        }

        .service-card .card-body {
            background: white;
            padding: 20px;
        }

        .custom-navbar {
            background: transparent;
            transition: background 0.3s ease;
        }

        .custom-navbar.scrolled {
            background: rgba(255,255,255,0.9);
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .footer {
            background-color: var(--dark);
            color: white;
            padding: 60px 0;
        }

        .footer-social a {
            color: white;
            margin-right: 15px;
            font-size: 24px;
            transition: color 0.3s ease;
        }

        .footer-social a:hover {
            color: var(--primary);
        }

        .scroll-arrow {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            cursor: pointer;
            width: 50px;
            height: 50px;
        }

        .scroll-arrow::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-bottom: 3px solid white;
            border-right: 3px solid white;
            transform: rotate(45deg);
            animation: scroll-down 2s infinite;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        @keyframes scroll-down {
            0% {
                top: -10px;
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                top: 10px;
                opacity: 0;
            }
        }

        .scroll-arrow:hover::before {
            animation: none;
            border-color: #f8f9fa;
            transform: rotate(45deg) scale(1.2);
        }

        .hero-image img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }

        @keyframes fadeInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Стили для стрелки */
        .scroll-arrow {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
            cursor: pointer;
            animation: fadeInArrow 1s 2s forwards;
        }

        .scroll-arrow::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-bottom: 3px solid white;
            border-right: 3px solid white;
            transform: rotate(45deg);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: rotate(45deg) translate(0, 0); }
            50% { transform: rotate(45deg) translate(10px, 10px); }
        }

        @keyframes fadeInArrow {
            to {
                opacity: 1;
            }
        }

        .news-section {
            background: linear-gradient(135deg, rgba(194,123,17,0.05) 0%, rgba(194,76,17,0.05) 100%);
            padding: 80px 0;
        }

        .news-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .news-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 30px;
            position: relative;
        }

        .news-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(135deg, #c27b11 0%, #c24c11 100%);
            transition: all 0.4s ease;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 45px rgba(0,0,0,0.1);
        }

        .news-card:hover::before {
            width: 10px;
        }

        .news-card-body {
            flex-grow: 1;
            margin-right: 30px;
        }

        .news-card-actions {
            display: flex;
            align-items: center;
        }

        .news-date {
            color: #888;
            margin-right: 20px;
            font-size: 0.9em;
        }

        .news-link {
            text-decoration: none;
            color: #c27b11;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
        }

        .news-link::after {
            content: '→';
            margin-left: 5px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .news-link:hover {
            color: #c24c11;
        }

        .news-link:hover::after {
            opacity: 1;
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .news-card {
                flex-direction: column;
                text-align: center;
            }

            .news-card-body {
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
    </style>
    @yield('additionalStyles', '')
</head>
<body>

@include('layouts.header')

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Контакты</h3>
                <p>Адрес: ул. Примерная, д. 123</p>
                <p>Телефон: +7 (123) 456-78-90</p>
                <p>Email: info@zhkh-service.ru</p>
            </div>
        </div>
    </div>
</footer>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.custom-navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
</body>
</html>
