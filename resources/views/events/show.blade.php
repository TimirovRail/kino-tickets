@extends('layouts.app')

@section('content')
    <style>
        .event-details-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0; /* Начальное состояние для анимации */
            transform: translateY(20px); /* Начальное состояние для анимации */
            animation: slide-in-up 0.6s ease-out forwards; /* Анимация появления контейнера */
        }

        /* Анимация появления контейнера */
        @keyframes slide-in-up {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .event-details-container h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            position: relative; /* Для подчеркивания */
            padding-bottom: 10px; /* Отступ для подчеркивания */
        }

        /* Анимация подчеркивания заголовка */
        .event-details-container h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background-color: #6ec8e5; /* Цвет подчеркивания */
            transition: width 0.6s ease-out;
        }

        .event-details-container:hover h2::after {
            width: 80%;
        }

        .event-details-container p {
            font-size: 1.1em;
            margin-bottom: 15px;
            line-height: 1.6;
            opacity: 0;
            transform: translateX(-20px);
            animation: slide-in-left 0.5s ease-out forwards;
            animation-delay: 0.3s;
        }

        @keyframes slide-in-left {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Задержки для параграфов */
        .event-details-container p:nth-of-type(2) { animation-delay: 0.4s; }
        .event-details-container p:nth-of-type(3) { animation-delay: 0.5s; }
        .event-details-container p:nth-of-type(4) { animation-delay: 0.6s; }

        .event-details-container b {
            font-weight: bold;
            color: #555;
        }

        /* Общие стили для кнопок */
        .event-details-container a,
        .event-details-container button {
            display: inline-block;
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            margin-right: 15px;
            text-decoration: none;
            color: #fff;
            position: relative;
            overflow: hidden;
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            animation: slide-in-up-button 0.5s ease-out forwards;
            animation-delay: 0.7s;
        }

        /* Анимация появления кнопок */
        @keyframes slide-in-up-button {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Задержки для кнопок */
        .event-details-container a:nth-of-type(2) { animation-delay: 0.8s; }
        .event-details-container button { animation-delay: 0.9s; }

        /* Эффект свечения при наведении */
        .event-details-container a::before,
        .event-details-container button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: all 0.5s;
        }

        .event-details-container a:hover::before,
        .event-details-container button:hover::before {
            left: 100%;
        }

        /* Эффект при наведении и активном состоянии */
        .event-details-container a:hover,
        .event-details-container button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(110, 200, 229, 0.4);
        }

        .event-details-container a:active,
        .event-details-container button:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(110, 200, 229, 0.2);
        }

        /* Специальные стили для конкретных ссылок */
        .event-details-container a[href*="edit"] {
            background-color: #6ec8e5;
            box-shadow: 0 4px 8px rgba(110, 200, 229, 0.3);
        }

        .event-details-container a[href*="purchase"] {
            background-color: #6ec8e5;
            box-shadow: 0 4px 8px rgba(110, 200, 229, 0.3);
        }

        .event-details-container a[href*="index"] {
            background-color: #6c757d;
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
        }

        /* Стиль для кнопки удаления */
        .event-details-container button {
            background-color: #dc3545;
            color: #fff;
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Стиль для кнопки "Посмотреть билет" */
        /* Обеспечим, чтобы она была голубой как остальные */
        .btn-visit-ticket {
            background-color: #6ec8e5; /* голубой цвет */
            border-color: #6ec8e5;
            box-shadow: 0 4px 8px rgba(110, 200, 229, 0.3);
        }
        .btn-visit-ticket:hover {
            background-color: #5bb0d5; /* чуть темнее при наведении */
            border-color: #5bb0d5;
        }
    </style>

    <div class="event-details-container">
        <h2>{{ $event->title }}</h2>
        <p><b>Дата:</b> {{ $event->start_time->format('d.m.Y H:i') }} - {{ $event->end_time->format('H:i') }}</p>
        <p><b>Описание:</b> {{ $event->description }}</p>
        <p><b>Цена:</b> {{ $event->price }} руб.</p>
        <p><b>Доступно билетов:</b> {{ $event->available_tickets }}</p>

        @auth
            @if (Auth::user()->is_admin)
                <div class="admin-actions">
                    <a href="{{ route('admin.events.edit', $event) }}">Редактировать</a>
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить это событие?')">Удалить</button>
                    </form>
                </div>
            @endif
        @endauth

        <!-- Удалена строка с маршрутом events.ticket -->
        <!-- <a href="{{ route('events.ticket', $event) }}" class="btn btn-info btn-visit-ticket" style="margin-top: 15px;">Посмотреть билет</a> -->

        <a href="{{ route('events.purchase', $event) }}">Купить билет</a>
       
    </div>
@endsection