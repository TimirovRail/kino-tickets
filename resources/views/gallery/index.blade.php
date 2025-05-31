@extends('layouts.app')

@section('content')
    <div class="banner">
        <img src="img/image 1.png" alt="Баннер галереи">
        <div class="banner-quote">
            <p class="animated-text">"Кино - это не просто развлечение, это способ познать мир и самого себя."</p>
            <p class="animated-author">- Андрей Тарковский</p>
        </div>
    </div>

    <div class="container">
        <h1>Галерея экспонатов</h1>
        <div class="gallery">
            @foreach($exhibits as $exhibit)
                <a href="{{ route('gallery.show', ['id' => $exhibit->id]) }}" class="gallery-item">
                    <img src="{{ asset($exhibit->image) }}" alt="Экспонат {{ $exhibit->name }}">
                </a>
            @endforeach
        </div>
    </div>

    <style>
        /* Стили страницы */
        body {
           
            color: #333; /* Темный текст */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .banner {
            position: relative;
            width: 100%;
            height: 400px; /* Высота баннера */
            overflow: hidden;
            margin-bottom: 40px;
        }

        .banner img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Растягивает изображение на всю область */
            filter: brightness(0.7); /* Затемнение изображения для лучшей читаемости текста */
            animation: zoomInImage 6s ease-in-out infinite alternate; /* Анимация для изображения */
        }

        @keyframes zoomInImage {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.1);
            }
        }

        .banner-quote {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff; /* Белый текст на баннере */
            font-size: 24px;
            font-style: italic;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            opacity: 0; /* Изначально текст скрыт */
            animation: fadeInText 2s ease-in-out 1s forwards; /* Анимация для текста с задержкой */
        }

        @keyframes fadeInText {
            from {
                opacity: 0;
                transform: translate(-50%, -40%); /* Начальная позиция выше */
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%); /* Конечная позиция */
            }
        }

        .animated-text {
            animation: typeText 4s steps(60, end) 2s forwards; /* Анимация печати текста */
            overflow: hidden;
            white-space: nowrap;
            border-right: .15em solid orange; /* Курсор */
            width: 0;
            display: inline-block;
        }

        @keyframes typeText {
            from { width: 0 }
            to { width: 100% }
        }

        .animated-author {
             animation: slideInAuthor 2s ease-in-out 6s forwards; /* Анимация появления автора */
             opacity: 0;
             transform: translateY(20px);
             display: inline-block; /* Важно для translateY */
        }

        @keyframes slideInAuthor {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        .banner-quote p {
            margin: 0;
            padding: 5px 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 40px;
            animation: slideIn 1s ease-in-out;
            opacity: 0;
            transform: translateY(-20px);
            animation-fill-mode: forwards; /* Позволяет сохранить конечное состояние */
            color: #6ec8e5; /* Цвет заголовка */
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            animation: fadeInUp 1.5s ease-in-out;
            opacity: 0;
            animation-fill-mode: forwards; /* Позволяет сохранить конечное состояние */
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff; /* Белый фон для элементов галереи */
        }

        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.3s;
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .gallery-item:hover img {
            transform: scale(1.1); /* Легкое увеличение изображения при наведении */
        }

        /* Скрипт для плавного появления изображений при прокрутке */
        /* Этот скрипт уже включен в секцию <script> */
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const h1 = document.querySelector('h1');
            h1.style.opacity = 0;
            h1.style.transform = 'translateY(-20px)';

            // Анимация заголовка
            setTimeout(() => {
                h1.style.transition = 'opacity 1s ease-in-out, transform 1s ease-in-out';
                h1.style.opacity = 1;
                h1.style.transform = 'translateY(0)';
            }, 100);

            // Небольшой скрипт для плавного появления изображений
            const galleryItems = document.querySelectorAll('.gallery-item');

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                        // Отключаем наблюдение после появления
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.3 // Насколько должен быть виден элемент, чтобы сработал триггер
            });

            galleryItems.forEach(item => {
                item.style.opacity = 0;
                item.style.transform = 'translateY(20px)';
                observer.observe(item);
            });
        });
    </script>
@endsection