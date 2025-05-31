@extends('layouts.app')

@section('content')
    <style>
        /* Основной контейнер с анимацией плавного появления снизу вверх */
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.8s ease-out forwards;
        }

        /* Анимация контейнера */
        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Заголовок с эффектом подчеркивания при наведении */
        .register-container h2 {
            font-size: 2.5em;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
            position: relative;
            padding-bottom: 10px;
        }

        /* Псевдоэлемент подчеркивания заголовка с плавной анимацией */
        .register-container h2::after {
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

        /* Расширение подчеркивания при наведении на контейнер */
        .register-container:hover h2::after {
            width: 80%;
        }

        /* Стили для формы */
        .register-form .form-group {
            margin-bottom: 25px;
            opacity: 0;
            transform: translateX(-20px);
            animation: fadeInLeft 0.8s forwards;
        }

        /* Анимация появления элементов слева */
        @keyframes fadeInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Индивидуальные задержки для элементов формы */
        .register-form .form-group:nth-child(1) {
            animation-delay: 0.3s;
        }

        .register-form .form-group:nth-child(2) {
            animation-delay: 0.4s;
        }

        .register-form .form-group:nth-child(3) {
            animation-delay: 0.5s;
        }

        .register-form .form-group:nth-child(4) {
            animation-delay: 0.6s;
        }


        /* Метки */
        .register-form label {
            display: block;
            font-size: 1.2em;
            color: #6ec8e5; /* Основной цвет меток */
            margin-bottom: 8px;
            font-weight: 600;
        }

        /* Поля ввода с анимацией */
        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 1.1em;
            border: 1px solid #6ec8e5; /* Цвет рамки */
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
            opacity: 0;
            transform: translateX(-20px);
            animation: fadeInLeft 0.8s forwards;
        }

        /* Задержки для полей ввода */
        .register-form input[type="text"] {
             animation-delay: 0.4s;
        }
        .register-form input[type="email"] {
             animation-delay: 0.5s;
        }
        .register-form input[type="password"] {
             animation-delay: 0.6s;
        }
        .register-form input[type="password_confirmation"] {
             animation-delay: 0.7s;
        }


        /* При фокусе меняем цвет рамки */
        .register-form input[type="text"]:focus,
        .register-form input[type="email"]:focus,
        .register-form input[type="password"]:focus {
            border-color: #6ec8e5; /* Цвет рамки при фокусе */
            box-shadow: 0 0 8px rgba(110, 200, 229, 0.3); /* Тень при фокусе */
        }

        /* Кнопка регистрации с серьезной анимацией */
        .register-button {
            width: 100%;
            padding: 15px;
            font-size: 1.2em;
            color: white;
            background-color: #6ec8e5; /* Цвет кнопки */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUpButton 0.8s ease-out forwards;
            animation-delay: 0.8s; /* Задержка анимации кнопки */
        }

        /* Анимация кнопки */
        @keyframes slideInUpButton {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Эффекты при наведении и активном состоянии */
        .register-button:hover {
            background-color: #56b4d1; /* Более темный оттенок для hover */
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(110, 200, 229, 0.4); /* Тень при наведении */
        }

        .register-button:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(110, 200, 229, 0.2); /* Тень при активном состоянии */
        }

        /* Ссылка на страницу входа с анимацией */
        .login-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #6ec8e5; /* Цвет ссылки */
            font-weight: 600;
            text-decoration: none;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.8s ease-out forwards;
            animation-delay: 0.9s; /* Задержка анимации ссылки */
        }

        /* hover эффект для ссылки */
        .login-link:hover {
            color: #56b4d1; /* Более темный оттенок для hover */
        }

         /* Окружение для алертов */
        .alert-container {
            margin-bottom: 20px;
        }

        /* Оповещения */
        .alert {
            padding: 15px;
            border-radius: 8px;
        }

        /* Цвета алертов оставлены стандартными, так как они информируют о статусе (успех/ошибка) */
        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }
        .alert li {
            margin-bottom: 5px;
        }
    </style>

    <div class="register-container">
        <h2>Регистрация</h2>

        <x-alert />

        <form action="{{ route('register') }}" method="POST" class="register-form">
            @csrf

            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Подтвердите Пароль:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="register-button">Зарегистрироваться</button>

            <div class="form-group">
                <a href="{{ route('login') }}" class="login-link">Уже зарегистрированы?</a>
            </div>
        </form>
    </div>
@endsection