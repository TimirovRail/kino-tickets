@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $exhibit->name }}</h1>

        <img src="{{ asset($exhibit->image) }}" alt="{{ $exhibit->name }}" class="exhibit-image">

        <p>{{ $exhibit->description }}</p>

        <a href="{{ route('gallery.index') }}" class="back-link">← Вернуться в галерею</a>
    </div>

    <style>
        /* Стили для страницы */
       

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;            /* Скрыть контейнер изначально */
            transform: translateY(-20px); /* Изменить позицию изначально */
            animation: fadeIn 1s ease-in-out forwards; /* Анимация появления */
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .exhibit-image {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3490dc;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s; /* Плавный переход цвета */
        }

        .back-link:hover {
            text-decoration: underline;
            color: #1d68a7; /* Темнее при наведении */
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection