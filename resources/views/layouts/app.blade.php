<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Российский музей истории кино')</title> {{-- Используем @yield('title') для динамического заголовка --}}
    <style>
        :root {
            /* Brand Colors */
            --primary-color: #007bff;
            --primary-color-dark: #0056b3;
            --secondary-color: #6c757d;

            /* Text Colors */
            --text-color: #333;
            --light-text-color: #fff;

            /* Background Colors */
            --background-color: #FFF6EA;

            /* Alert Colors */
            --alert-success-bg: #d4edda;
            --alert-success-text: #155724;
            --alert-error-bg: #f8d7da;
            --alert-error-text: #721c24;

            /* Font */
            --font-family: 'Arial', sans-serif;
        }

        body {
            font-family: var(--font-family);
            margin: 0;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            /* Убедимся, что body не имеет странных отступов или переполнения */
            overflow-x: hidden; /* Предотвращаем горизонтальный скролл */
            overflow-y: auto; /* Разрешаем вертикальный скролл */
            display: flex; /* Используем flexbox для layout */
            flex-direction: column; /* Элементы располагаются в колонку */
            min-height: 100vh; /* Минимальная высота body равна высоте viewport */
        }

        a {
            text-decoration: none;
            color: var(--text-color);
            transition: color 0.3s ease;
        }

        a:hover {
            color: var(--primary-color-dark);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            width: 100%; /* Убедимся, что контейнер занимает всю доступную ширину */
            box-sizing: border-box; /* Включаем padding в ширину */
        }

        header {
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            /* Убираем фиксированное позиционирование, если оно было */
            position: static;
        }

        .header-content {
            display: flex;
            justify-content: space-between; /* Распределяем элементы по краям */
            align-items: center;
            max-width: 1200px; /* Ограничиваем ширину содержимого хедера */
            margin: 0 auto; /* Центрируем содержимое хедера */
        }

        header h1 {
            font-size: 2em;
            margin: 0; /* Убираем лишние margin */
            color: var(--text-color);
            text-align: center;
            flex-grow: 1; /* Позволяем заголовку занимать доступное пространство */
        }

        .nav-left {
            display: flex;
            align-items: center;
            /* margin-right: 20px; /*  Задаем отступ */
        }

        .nav-left a {
            margin-right: 20px;
            font-size: 1em;
        }
        .nav-left a:last-child {
             margin-right: 0; /* Убираем отступ у последнего элемента */
        }


        nav {
            display: flex;
            align-items: center;
            /* margin-left: 20px; /*  Задаем отступ */
        }

        nav a,
        nav button[type="submit"] {
            margin-left: 10px;
            font-size: 1em;
            padding: 0;
            border: none;
            cursor: pointer;
            text-decoration: none;
            color: var(--text-color);
            background-color: transparent;
            transition: color 0.3s ease;
        }

        nav a:hover,
        nav button[type="submit"]:hover {
            color: var(--primary-color-dark);
        }
         nav a:first-child,
         nav button[type="submit"]:first-child {
             margin-left: 0; /* Убираем отступ у первого элемента */
         }


        main {
            flex-grow: 1; /* Позволяет main занять все доступное вертикальное пространство */
            padding: 20px 0; /* Добавляем вертикальные отступы, горизонтальные будут в .container */
        }

        footer {
            background-color: #000;
            color: var(--light-text-color);
            text-align: center;
            padding: 20px 10px; /* Увеличим вертикальный padding футера */
            /* УДАЛЯЕМ ВСЕ СВОЙСТВА ПОЗИЦИОНИРОВАНИЯ */
            /* position: fixed; */
            /* bottom: 0; */
            /* left: 0; */
            width: 100%; /* Футер должен занимать всю ширину */
            margin-top: auto; /* Прижимает футер к низу, если контента мало */
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert.success {
            background-color: var(--alert-success-bg);
            color: var(--alert-success-text);
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background-color: var(--alert-error-bg);
            color: var(--alert-error-text);
            border: 1px solid #f5c6cb;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert li {
            margin-bottom: 5px;
        }

        /* Медиа-запросы для адаптивности хедера */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column; /* В колонку на маленьких экранах */
                align-items: center;
                text-align: center;
            }

            .nav-left {
                margin-right: 0;
                margin-bottom: 10px; /* Отступ после nav-left */
            }

            .nav-left a {
                margin-right: 10px; /* Уменьшим отступ между ссылками nav-left */
            }
             .nav-left a:last-child {
                 margin-right: 0;
             }

            nav {
                margin-left: 0;
                margin-top: 10px; /* Отступ перед nav */
            }

            nav a,
            nav button[type="submit"] {
                margin: 0 5px; /* Уменьшим отступ между ссылками nav */
            }
        }

         @media (max-width: 480px) {
             header h1 {
                 font-size: 1.5em; /* Еще меньше заголовок на очень маленьких экранах */
             }
             .nav-left, nav {
                 flex-wrap: wrap; /* Разрешаем перенос ссылок на новую строку */
                 justify-content: center; /* Центрируем ссылки */
             }
             .nav-left a, nav a, nav button[type="submit"] {
                 margin: 5px; /* Добавляем небольшой отступ со всех сторон */
             }
         }

    </style>
<header onclick="window.location.href = '{{ route('welcome') }}'" style="cursor: pointer;">
    <div class="header-content">
        <div class="nav-left">
            <a href="{{ route('events.index') }}">События</a>
            <a href="{{ route('news.index.user') }}">Новости</a> <!-- Добавленная кнопка для новостей -->
            <a href="{{ route('gallery.index') }}">Галерея</a> <!-- Добавленная кнопка для галереи -->
            <a href="{{ route('epochs.index') }}">Эпохи</a> <!-- Добавленная кнопка для эпох -->
            @auth
                @if(Auth::user()->is_admin) <!-- Проверка, является ли пользователь администратором -->
                    <a href="{{ route('admin.dashboard') }}">Админка</a> <!-- Кнопка для панели администратора -->
                @endif
            @endauth
        </div>
        <h1>Российский музей истории кино</h1>
        <nav>
            @auth
                <span>Привет, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}">Войти</a>
                <a href="{{ route('register') }}">Зарегистрироваться</a>
            @endauth
        </nav>
    </div>
</header>
<main>
    <div class="container">
        <x-alert/>
        @yield('content')
    </div>
</main>
<footer>
    <p>© {{ date('Y') }} Российский музей истории кино</p>
</footer>
</body>
</html>