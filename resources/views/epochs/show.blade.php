@extends('layouts.app')

@section('title', 'Эпохи кино')

@section('content')

{{-- Подключение стилей Swiper --}}
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<style>
    /* Определяем CSS-переменные для удобства изменения цвета */
    :root {
        --primary-gentle-blue: #aed6f1; /* Нежный голубой */
        --primary-gentle-blue-dark: #85c1e9; /* Чуть темнее для ховера */
        --bg-light-blue: #ebf5fb; /* Очень светлый голубой фон */
        --text-dark: #333; /* Темный текст */
        --text-gentle: #555; /* Нежный темный текст */
        --shadow-gentle: 0 4px 15px rgba(174, 214, 241, 0.5); /* Нежная тень */
        --shadow-gentle-hover: 0 0 25px rgba(133, 193, 233, 0.7); /* Нежная тень при наведении */
        --transition: all 0.4s ease; /* Плавный переход для эффектов */
        --section-padding: 50px 0; /* Отступ для секций */
    }

    body {
        /* Убедимся, что body не имеет странных отступов или переполнения */
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Предотвращаем горизонтальный скролл */
    }

    /* Стили для баннера */
    .banner {
    width: 100%;
    height: 400px; /* Высота баннера */
    background-image: url('{{ asset('img/image 2.jpg') }}'); /* Путь к вашему изображению баннера */
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--light-text-color); /* Используем переменную из layout для белого текста */
    text-align: center;
    position: relative;
    margin-bottom: 50px; /* Отступ после баннера */
    overflow: hidden; /* Скрываем содержимое, выходящее за пределы баннера */
}

     .banner::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background-color: rgba(0, 0, 0, 0.4); /* Менее темное затемнение баннера */
         z-index: 1;
     }

    .banner h1 {
        font-size: 3.5em; /* Чуть больше размер заголовка */
        z-index: 2; /* Чтобы текст был над затемнением */
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.8); /* Чуть более выраженная тень текста */
    }

    /* Стили для цитаты */
    .quote-container {
        max-width: 800px;
        margin: 0 auto 60px auto; /* Отступ после цитаты */
        text-align: center;
        font-style: italic;
        color: var(--text-gentle); /* Нежный темный цвет текста цитаты */
        font-size: 1.3em; /* Чуть больше размер шрифта цитаты */
        padding: 0 20px; /* Отступы по бокам на мобильных */
    }

    .quote-container p {
        margin-bottom: 15px; /* Чуть больше отступ между строками цитаты */
    }

    .quote-container .author {
        font-style: normal;
        font-weight: bold;
        color: var(--primary-gentle-blue-dark); /* Цвет автора цитаты */
    }

    /* Стили для секции слайдера */
    .epochs-section {
        padding: var(--section-padding); /* Отступ сверху и снизу для секции */
        
    }

    /* Стили для слайдера Swiper */
    .swiper-container {
        width: 100%;
        /* Удалены padding-top и padding-bottom, так как они включены в .epochs-section padding */
        /* padding-top: 50px; */
        /* padding-bottom: 50px; */
        overflow: hidden; /* Скрываем лишние слайды */
        position: relative; /* Важно для позиционирования стрелок и пагинации */
    }

    .swiper-slide {
        background-color: var(--bg-light-blue); /* Очень светлый голубой фон для слайдов */
        border-radius: 15px; /* Скругленные углы слайдов */
        box-shadow: var(--shadow-gentle); /* Нежная тень */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start; /* Выравнивание по верху */
        padding: 30px;
        height: auto; /* Автоматическая высота */
        transition: box-shadow var(--transition), transform var(--transition);
        text-decoration: none; /* Убираем подчеркивание у ссылок */
        color: inherit; /* Наследуем цвет текста */
    }

    .swiper-slide:hover {
        box-shadow: var(--shadow-gentle-hover); /* Нежная тень при наведении */
        transform: translateY(-5px); /* Небольшое смещение вверх при наведении */
    }

    .swiper-slide img {
        width: 100%;
        max-height: 250px; /* Ограничение высоты изображения */
        object-fit: cover; /* Обрезка изображения для заполнения */
        border-radius: 10px; /* Скругленные углы изображения */
        margin-bottom: 20px;
        transition: transform var(--transition);
    }

    .swiper-slide:hover img {
        transform: scale(1.02); /* Небольшое увеличение изображения при наведении */
    }

    .swiper-slide h3 {
        font-size: 1.8em; /* Чуть больше размер заголовка эпохи */
        color: var(--text-dark); /* Темный цвет заголовка */
        margin-bottom: 15px;
        text-align: center;
    }

    .swiper-slide p {
        font-size: 1.1em; /* Чуть больше размер текста описания */
        color: var(--text-gentle); /* Нежный темный цвет текста описания */
        text-align: center;
        line-height: 1.6; /* Увеличенный межстрочный интервал */
    }

    /* Стили для кнопок навигации Swiper */
    .swiper-button-next,
    .swiper-button-prev {
        color: var(--primary-gentle-blue-dark); /* Цвет кнопок навигации */
        opacity: 0.7;
        transition: opacity var(--transition);
        /* Возвращаем позиционирование, которое могло быть переопределено */
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10; /* Убедимся, что они поверх слайдов */
    }

    .swiper-button-prev {
        left: 10px; /* Отступ слева */
    }

    .swiper-button-next {
        right: 10px; /* Отступ справа */
    }


    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        opacity: 1;
    }

    /* Стили для пагинации Swiper (точки) */
    .swiper-pagination {
        position: absolute;
        bottom: 10px; /* Позиционирование снизу */
        left: 0;
        width: 100%;
        text-align: center;
        z-index: 10; /* Убедимся, что они поверх слайдов */
    }

    .swiper-pagination-bullet {
        background-color: var(--primary-gentle-blue); /* Цвет неактивных точек */
        opacity: 0.8;
        /* Дополнительные стили для улучшения внешнего вида точек */
        width: 10px;
        height: 10px;
        display: inline-block;
        border-radius: 50%;
        margin: 0 5px;
        transition: background-color var(--transition), opacity var(--transition);
    }

    .swiper-pagination-bullet-active {
        background-color: var(--primary-gentle-blue-dark); /* Цвет активной точки */
        opacity: 1;
    }

    /* Медиа-запросы для адаптивности Swiper */
    @media (max-width: 768px) {
        .banner {
            height: 300px;
        }
        .banner h1 {
            font-size: 2.5em;
        }
        .quote-container {
            font-size: 1.1em;
            margin-bottom: 40px;
        }
        .epochs-section {
             padding: 60px 0; /* Меньший отступ на мобильных */
         }
        .swiper-slide {
            padding: 20px;
        }
        .swiper-slide h3 {
            font-size: 1.6em;
        }
        .swiper-slide p {
            font-size: 1em;
        }
        /* Скрываем стрелки навигации на мобильных, если они мешают */
         .swiper-button-next,
         .swiper-button-prev {
             display: none;
         }
    }

    @media (max-width: 480px) {
         .banner {
             height: 250px;
         }
         .banner h1 {
             font-size: 2em;
         }
         .quote-container {
             font-size: 1em;
             margin-bottom: 30px;
         }
         .epochs-section {
             padding: 40px 0; /* Еще меньший отступ на очень маленьких экранах */
         }
         .swiper-slide {
             padding: 15px;
         }
         .swiper-slide h3 {
             font-size: 1.4em;
         }
         .swiper-slide p {
             font-size: 0.9em;
         }
         /* Скрываем стрелки навигации на мобильных, если они мешают */
         .swiper-button-next,
         .swiper-button-prev {
             display: none;
         }
     }

     /* Убедимся, что у футера нет отрицательных верхних отступов */
     footer {
         margin-top: 0 !important; /* Или установите конкретное положительное значение */
         padding-top: 30px; /* Пример отступа сверху для футера */
         /* Добавьте другие стили футера, если они есть */
     }

</style>

{{-- Баннер --}}
<div class="banner" style="background-image: url('{{ asset('img/image 2.jpg') }}');">
    <h1>Эпохи кино</h1>
</div>
{{-- Цитата --}}
<div class="quote-container">
    <p>"Кино – это жизнь, из которой вырезано всё скучное."</p>
    <p class="author">Альфред Хичкок</p>
</div>

{{-- Секция слайдера --}}
<section class="epochs-section"> {{-- Обернули слайдер в секцию с отступами --}}
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($epochs as $epoch)
                <a href="{{ route('epochs.show', $epoch->id) }}" class="swiper-slide">
                    <img src="{{ asset($epoch->image) }}" alt="{{ $epoch->title }}" title="{{ $epoch->title }}">
                    <h3>{{ $epoch->title }}</h3>
                    <p>{{ $epoch->description }}</p>
                </a>
            @endforeach
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>

        <!-- Add Navigation (Optional) -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>


{{-- Подключение скрипта Swiper --}}
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.swiper-container', {
            // Optional parameters
            loop: true, // Бесконечная прокрутка
            spaceBetween: 30, // Расстояние между слайдами
            centeredSlides: true, // Центрирование активного слайда

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true, // Сделать точки пагинации кликабельными
            },

            // Navigation arrows (Optional)
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                // when window width is >= 1024px
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40
                }
            },

            // Autoplay (Optional)
            autoplay: {
                delay: 5000, // Задержка между переключениями слайдов в миллисекундах
                disableOnInteraction: false, // Не останавливать автопрокрутку при взаимодействии пользователя
            },
        });
    });
</script>
@endsection