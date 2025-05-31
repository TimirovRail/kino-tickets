@extends('layouts.app')

@section('content')
<style>
    /* Общие стили для страницы просмотра новости */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
    }

    /* Стили main (без изменений в header) */
    main {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Более выраженная тень */
        animation: fadeIn 1s forwards; /* Анимация для основного контента */
    }

    main h2 {
        color: #6ec8e5; /* Основной цвет для подзаголовков */
        margin-top: 20px;
        margin-bottom: 10px;
        border-bottom: 2px solid #e0f7fa; /* Тонкая граница под заголовком */
        padding-bottom: 5px;
    }

    main p {
        line-height: 1.6; /* Увеличен межстрочный интервал */
        color: #555; /* Немного более темный цвет текста для лучшей читаемости */
        margin-bottom: 15px;
    }

    /* Анимации (без анимации header) */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Медиа-запросы для адаптивности */
    @media (max-width: 768px) {
        main {
            margin: 10px;
            padding: 15px;
        }
    }
</style>

<header>
    <h1>{{ $news->title }}</h1>
    <a href="{{ route('news.index') }}">Назад к новостям</a>
</header>
<main>
    <h2>Описание:</h2>
    <p>{{ $news->description }}</p>
    <h2>Содержимое:</h2>
    <p>{{ $news->content }}</p>
</main>
@endsection