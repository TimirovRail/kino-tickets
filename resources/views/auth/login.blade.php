@extends('layouts.app')

@section('content')
    <style>
        /* Основной контейнер с анимацией плавного появления снизу вверх */
        .login-container {
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
        .login-container h2 {
            font-size: 2.5em;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
            position: relative;
            padding-bottom: 10px;
        }

        /* Псевдоэлемент подчеркивания заголовка с плавной анимацией */
        .login-container h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background-color: #6ec8e5; /* Изменено на #6ec8e5 */
            transition: width 0.6s ease-out;
        }

        /* Расширение подчеркивания при наведении на контейнер */
        .login-container:hover h2::after {
            width: 80%;
        }

        /* Стили для формы */
        .login-form .form-group {
            margin-bottom: 25px;
            opacity: 0;
            transform: translateX(-20px);
            animation: fadeInLeft 0.8s forwards;
            animation-delay: 0.3s;
        }

        /* Анимация появления элементов слева */
        @keyframes fadeInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Индивидуальные задержки для элементов формы */
        .login-form .form-group:nth-child(1) {
            animation-delay: 0.3s;
        }

        .login-form .form-group:nth-child(2) {
            animation-delay: 0.4s;
        }

        .login-form .form-group:nth-child(3) {
            animation-delay: 0.5s;
        }

        /* Метки */
        .login-form label {
            display: block;
            font-size: 1.2em;
            color: #6ec8e5; /* Изменено на #6ec8e5 */
            margin-bottom: 8px;
            font-weight: 600;
        }

        /* Поля ввода с анимацией */
        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 1.1em;
            border: 1px solid #6ec8e5; /* Изменено на #6ec8e5 */
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
            opacity: 0;
            transform: translateX(-20px);
            animation: fadeInLeft 0.8s forwards;
        }

        /* Задержки для полей ввода */
        .login-form input[type="email"] {
            animation-delay: 0.4s;
        }

        .login-form input[type="password"] {
            animation-delay: 0.5s;
        }

        /* При фокусе меняем цвет рамки */
        .login-form input[type="email"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #6ec8e5; /* Изменено на #6ec8e5 */
            box-shadow: 0 0 8px rgba(110, 200, 229, 0.3); /* Обновлено для нового цвета */
        }

        /* Чекбокс с анимацией */
        .login-form .remember-me {
            display: flex;
            align-items: center;
            margin-top: 15px;
            opacity: 0;
            transform: translateX(-20px);
            animation: fadeInLeft 0.8s forwards;
            animation-delay: 0.6s;
        }

        /* Метка для чекбокса */
        .login-form .remember-me label {
            margin-left: 10px;
            font-weight: 600;
            color: #6ec8e5; /* Изменено на #6ec8e5 */
        }

        /* Кнопка входа с серьезной анимацией */
        .login-button {
            width: 100%;
            padding: 15px;
            font-size: 1.2em;
            color: white;
            background-color: #6ec8e5; /* Изменено на #6ec8e5 */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUpButton 0.8s ease-out forwards;
            animation-delay: 0.7s;
        }

        /* Анимация кнопки */
        @keyframes slideInUpButton {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Эффекты при наведении и активном состоянии */
        .login-button:hover {
            background-color: #56b4d1; /* Более темный оттенок для hover */
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(110, 200, 229, 0.4); /* Обновлено для нового цвета */
        }

        .login-button:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(110, 200, 229, 0.2); /* Обновлено для нового цвета */
        }

        /* Ссылка регистрации с анимацией */
        .register-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #6ec8e5; /* Изменено на #6ec8e5 */
            font-weight: 600;
            text-decoration: none;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.8s ease-out forwards;
            animation-delay: 0.8s;
        }

        /* hover эффект для ссылки */
        .register-link:hover {
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

    <div class="login-container">
        <h2>Вход</h2>

        <x-alert />

        <form action="{{ route('login') }}" method="POST" class="login-form">
            @csrf

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Запомнить меня</label>
            </div>

            <button type="submit" class="login-button">Войти</button>
            <a href="{{ route('register') }}" class="register-link">Зарегистрироваться</a>
        </form>
    </div>
@endsection