@extends('layouts.app')

@section('content')
    <div class="admin-container">
        <h1 class="admin-title">Административная панель</h1>
        <p class="admin-description">Управляйте контентом и функциональностью вашего сайта.</p>

        <div class="admin-list-group">
            <a href="{{ route('admin.events.create') }}" class="admin-list-item">
                <i class="fas fa-plus-circle"></i> Создать новое событие
            </a>
            <a href="{{ route('admin.tickets.index') }}" class="admin-list-item">
                <i class="fas fa-ticket-alt"></i> Посмотреть все билеты
            </a>
            <a href="{{ route('news.index') }}" class="admin-list-item">
                <i class="fas fa-newspaper"></i> Управление новостями
            </a>
            <a href="{{ route('news.create') }}" class="admin-list-item">
                <i class="fas fa-file-alt"></i> Создать новость
            </a>
            <a href="{{ route('events.index') }}" class="admin-list-item">
                <i class="fas fa-calendar-alt"></i> Управление событиями
            </a>
            <!-- Добавьте дополнительные ссылки по мере необходимости -->
        </div>
    </div>

    <style>
        /* Общие стили */
        body {
            font-family: 'Arial', sans-serif;
            color: #343a40;
        }

        /* Контейнер административной панели */
        .admin-container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .admin-container:hover {
            transform: scale(1.02);
        }

        /* Заголовок */
        .admin-title {
            font-size: 2.5em;
            color: #007bff;
            margin-bottom: 15px;
            text-align: center;
            animation: fadeInDown 1s ease-out;
        }

        /* Описание */
        .admin-description {
            font-size: 1.1em;
            color: #6c757d;
            text-align: center;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-out;
        }

        /* Список элементов */
        .admin-list-group {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Расстояние между элементами */
            width: 100%;
        }

        /* Элемент списка */
        .admin-list-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            background-color: #e9ecef;
            color: #495057;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden; /* Обрезаем содержимое, если оно выходит за границы */
            position: relative; /* Для позиционирования псевдоэлемента */
        }

        .admin-list-item:hover {
            background-color: #007bff;
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .admin-list-item i {
            margin-right: 15px; /* Отступ для иконки */
            font-size: 1.2em;
            width: 20px; /* Фиксированная ширина для иконки */
            text-align: center; /* Выравнивание иконки по центру */
        }

        /* Анимация при загрузке страницы */
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
    </style>

    <!-- Подключаем Font Awesome (если еще не подключен) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection