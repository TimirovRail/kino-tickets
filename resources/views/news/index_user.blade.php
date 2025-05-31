@extends('layouts.app')

@section('content')
    <!-- Banner with Image -->
    <section class="banner">
        <div class="banner-image" style="background-image: url('{{ asset('img/image 1.png') }}');"></div>
        <div class="banner-content">
            <h1>Добро пожаловать в мир новостей!</h1>
            <p>Будьте в курсе последних событий с нашими новостями. Актуально, интересно, всегда свежо!</p>
            <a href="#news-section" class="btn-primary">Узнать больше</a>
        </div>
    </section>

    <main id="news-section">
        <div class="news-grid">
            @foreach($news as $item)
                <div class="news-card">
                    <div class="news-background">
                        <span class="news-icon">★</span> <!-- Звезда как иконка -->
                    </div>
                    <div class="news-content">
                        <h2 class="news-title"><a href="{{ route('news.show', $item) }}">{{ $item->title }}</a></h2>
                        <p class="news-description">{{ Str::limit($item->description, 150) }}</p>
                        <a href="{{ route('news.show', $item) }}" class="btn-secondary">Читать далее</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <style>
        /* Общие стили */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
           
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        /* Улучшенные стили кнопок */
        .btn-primary, .btn-secondary {
            display: inline-block;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; /* Добавлена анимация тени */
            position: relative; /* Для эффекта волны */
            overflow: hidden; /* Для эффекта волны */
            z-index: 1; /* Для эффекта волны */
        }

        .btn-primary {
            background-color: #6ec8e5; /* Основной цвет */
            color: #fff; /* Цвет текста */
        }

        .btn-secondary {
            background-color: #6ec8e5; /* Основной цвет для вторичной кнопки */
            color: #fff; /* Цвет текста */
        }

        /* Эффект волны при наведении на кнопки */
        .btn-primary:hover::before,
        .btn-secondary:hover::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3); /* Белая полупрозрачная волна */
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: wave 0.6s ease-out;
            z-index: 0; /* Под текстом кнопки */
        }

        @keyframes wave {
            to {
                width: 200%;
                height: 200%;
                opacity: 0;
            }
        }

        .btn-primary:hover {
            background-color: #5bb0d0; /* Оттенок основного цвета при наведении */
            transform: translateY(-3px); /* Эффект при наведении, немного больше */
            box-shadow: 0 8px 16px rgba(110, 200, 229, 0.4); /* Более выраженная тень */
        }

        .btn-secondary:hover {
            background-color: #5bb0d0; /* Оттенок основного цвета при наведении */
            transform: translateY(-3px); /* Эффект при наведении, немного больше */
            box-shadow: 0 8px 16px rgba(110, 200, 229, 0.4); /* Более выраженная тень */
        }

        /* Стили баннера */
        .banner {
            position: relative;
            height: 500px;
            overflow: hidden;
            color: #fff;
            text-align: center;
            display: flex; /* Используем Flexbox для центрирования контента */
            justify-content: center;
            align-items: center;
        }

        .banner-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0.9;
            transition: opacity 0.5s ease; /* Более плавная анимация прозрачности */
        }

        /* Эффект легкого зума на изображении баннера при наведении */
        .banner:hover .banner-image {
             transform: scale(1.03);
             transition: transform 0.5s ease;
        }


        .banner-content {
            position: relative; /* Изменено на relative, так как родитель Flexbox */
            padding: 20px;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            max-width: 800px; /* Ограничиваем ширину контента */
        }

        .banner-content h1 {
            font-size: 3.5em;
            margin-bottom: 15px;
            animation: fadeInDown 1s ease-out;
        }

        .banner-content p {
            font-size: 1.2em;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease-out;
        }

        /* Стили новостей */
        #news-section {
            padding: 30px 0;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px;
        }

        .news-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Добавлена анимация тени */
            position: relative;
            display: flex;
            flex-direction: column;
            /* Добавлен эффект "поднятия" карточки при наведении */
            transform: perspective(1px) translateZ(0); /* Для лучшей совместимости с transform */
        }

        .news-card:hover {
            transform: translateY(-7px); /* Эффект поднятия стал немного больше */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); /* Тень стала более выраженной */
        }

        /* Новый блок с фоном для карточки */
        .news-background {
            background-color: #e0f7fa; /* Очень светлый оттенок основного цвета */
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3em;
            color: #6ec8e5; /* Основной цвет для иконки */
            transition: color 0.3s ease; /* Анимация цвета иконки */
        }

        /* Эффект наведения на иконку звезды */
        .news-card:hover .news-icon {
            transform: rotate(360deg); /* Вращение звезды */
            color: #5bb0d0; /* Изменение цвета звезды */
            transition: transform 0.6s ease-out, color 0.3s ease; /* Анимация вращения и цвета */
        }


        .news-content {
            padding: 20px;
            margin-top: auto;
        }

        .news-title {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #333;
            transition: color 0.3s ease;
        }

        .news-title a {
            text-decoration: none;
            color: inherit;
        }

        .news-title a:hover {
            color: #6ec8e5; /* Основной цвет при наведении на заголовок */
            text-decoration: underline; /* Добавим подчеркивание при наведении */
        }

        .news-description {
            font-size: 1em;
            color: #666;
            line-height: 1.4;
            margin-bottom: 15px;
        }

        /* Анимации */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

         /* Медиа-запросы для адаптивности */
        @media (max-width: 768px) {
            .banner-content h1 {
                font-size: 2.5em;
            }

            .banner-content p {
                font-size: 1em;
            }

            .news-grid {
                grid-template-columns: 1fr; /* На мобильных устройствах - один столбец */
                padding: 10px;
            }

            .news-card {
                margin-bottom: 15px; /* Добавлен отступ между карточками на мобильных */
            }
        }
    </style>
@endsection