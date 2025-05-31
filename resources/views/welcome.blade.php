<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Российский музей истории кино</title>

  <!-- Шрифт -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Font Awesome - Замените YOUR_KIT_ID на свой ID -->
  <script src="https://kit.fontawesome.com/YOUR_KIT_ID.js" crossorigin="anonymous"></script>

  <style>
    :root {
      --custom-light-blue: #6ec8e5; /* Ваш выбранный нежно-голубой */
      --custom-light-blue-dark: #5ab2cf; /* Чуть темнее для ховера */
      --bg-light: #fff6ea;
      --text-color: #333;
      --font: 'Inter', sans-serif;
      --shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: var(--font);
      background: var(--bg-light);
      color: var(--text-color);
      overflow-x: hidden; /* Избегаем горизонтальной прокрутки из-за анимаций */
    }

    header {
      position: absolute;
      top: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.4);
      color: white;
      z-index: 10;
      padding: 15px 20px;
      opacity: 0; /* Начальное состояние для анимации */
      transform: translateY(-20px); /* Начальное состояние для анимации */
      animation: slideInDown 0.8s ease-out forwards 0.2s; /* Анимация заголовка */
    }

    @keyframes slideInDown {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    header .container {
      max-width: 1200px;
      margin: auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: white;
    }

    nav {
      display: flex;
      gap: 20px;
      align-items: center;
    }

    nav a {
      font-weight: 600;
      color: white;
      text-decoration: none;
      transition: color var(--transition);
      opacity: 0; /* Начальное состояние для анимации */
      transform: translateY(-10px); /* Начальное состояние для анимации */
      animation: fadeInNav 0.6s ease-out forwards; /* Анимация ссылок */
    }

    @keyframes fadeInNav {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    nav a:nth-child(1) { animation-delay: 0.4s; }
    nav a:nth-child(2) { animation-delay: 0.5s; }
    nav a:nth-child(3) { animation-delay: 0.6s; }
    nav a:nth-child(4) { animation-delay: 0.7s; }
    nav a:nth-child(5) { animation-delay: 0.8s; }


    nav a:hover {
      color: var(--custom-light-blue);
    }

    /* Баннер */
    .banner-swiper {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow: hidden;
    }

    .banner-swiper .swiper-slide {
      height: 100%;
    }

    .banner-swiper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      transform: scale(1.05); /* Параллакс эффект */
      will-change: transform;
    }

    .banner-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2));
      z-index: 1;
    }

    .banner-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      text-align: center;
      z-index: 2;
      opacity: 0; /* Начальное состояние для анимации */
      animation: fadeInScale 1s ease-out forwards 0.5s; /* Анимация контента баннера */
    }

     @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }


    .banner-content h1 {
      font-size: 48px;
      margin-bottom: 20px;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
    }

    .banner-content .btn {
      font-size: 18px;
      padding: 12px 24px;
      background: var(--custom-light-blue);
      border: none;
      color: white;
      border-radius: 6px;
      cursor: pointer;
      transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
      text-decoration: none;
    }

    .banner-content .btn:hover {
      background: var(--custom-light-blue-dark);
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(110, 200, 229, 0.4); /* Тень при наведении */
    }

    main {
      max-width: 1200px;
      margin: auto;
      padding: 60px 20px 30px;
    }

    /* Анимация для секций при прокрутке */
    .section {
      margin: 40px 0;
      padding: 20px;
      background: #fff;
      border-radius: 12px;
      box-shadow: var(--shadow);
      opacity: 0; /* Начальное состояние для анимации при прокрутке */
      transform: translateY(30px); /* Начальное состояние для анимации при прокрутке */
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .section.is-visible {
        opacity: 1;
        transform: translateY(0);
    }


    h2 {
      font-weight: 600;
      margin-bottom: 20px;
      position: relative;
      opacity: 0; /* Начальное состояние для анимации */
      transform: translateX(-20px); /* Начальное состояние для анимации */
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .section.is-visible h2 {
        opacity: 1;
        transform: translateX(0);
    }


    h2::after {
      content: '';
      display: block;
      width: 50px;
      height: 2px;
      background: var(--custom-light-blue);
      margin-top: 5px;
      transition: width 0.3s ease;
    }

    h2:hover::after {
      width: 100%;
    }

    .quote {
      font-style: italic;
      margin: 20px 0;
      padding: 10px;
      border-left: 4px solid var(--custom-light-blue);
      background-color: #f8f9fa;
      border-radius: 5px;
      opacity: 0; /* Начальное состояние для анимации */
      transform: translateX(-20px); /* Начальное состояние для анимации */
      transition: opacity 0.6s ease-out 0.3s, transform 0.6s ease-out 0.3s; /* Задержка для анимации цитаты */
    }

     .section.is-visible .quote {
        opacity: 1;
        transform: translateX(0);
    }


    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .gallery-item { /* Добавлен класс для элемента галереи */
      position: relative; /* Необходимо для позиционирования изображения внутри */
      overflow: hidden;
      border-radius: 12px;
      box-shadow: var(--shadow);
      transition: transform var(--transition), box-shadow var(--transition);
      opacity: 0; /* Начальное состояние для анимации */
      transform: scale(0.9); /* Начальное состояние для анимации */
      display: block; /* Сделать ссылку блочным элементом */
    }

     .section.is-visible .gallery-item { /* Анимация для контейнера ссылки */
        opacity: 1;
        transform: scale(1);
        transition: transform 0.6s ease-out, opacity 0.6s ease-out;
     }

     /* Задержки для элементов галереи */
     .section.is-visible .gallery-item:nth-child(1) { transition-delay: 0.2s; }
     .section.is-visible .gallery-item:nth-child(2) { transition-delay: 0.3s; }
     .section.is-visible .gallery-item:nth-child(3) { transition-delay: 0.4s; }
     .section.is-visible .gallery-item:nth-child(4) { transition-delay: 0.5s; }
     .section.is-visible .gallery-item:nth-child(5) { transition-delay: 0.6s; }
     .section.is-visible .gallery-item:nth-child(6) { transition-delay: 0.7s; }
     .section.is-visible .gallery-item:nth-child(7) { transition-delay: 0.8s; }
     .section.is-visible .gallery-item:nth-child(8) { transition-delay: 0.9s; }
     .section.is-visible .gallery-item:nth-child(9) { transition-delay: 1.0s; }
     .section.is-visible .gallery-item:nth-child(10) { transition-delay: 1.1s; }


    .gallery-item img { /* Стили для изображения внутри ссылки */
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 12px;
      transition: transform var(--transition); /* Только transform для изображения */
      display: block; /* Изображение как блочный элемент */
    }

    .gallery-item:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .gallery-item:hover img { /* Анимация изображения при наведении на контейнер ссылки */
      transform: scale(1.1);
    }

    .events-grid, .news-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .card { /* Объединенный класс для карточек событий и новостей */
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(6px);
      border-radius: 12px;
      padding: 15px;
      box-shadow: var(--shadow);
      transition: transform var(--transition), box-shadow var(--transition);
      opacity: 0; /* Начальное состояние для анимации */
      transform: translateY(20px); /* Начальное состояние для анимации */
    }

    .section.is-visible .card {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

     /* Задержки для карточек событий и новостей */
     .section.is-visible .card:nth-child(1) { transition-delay: 0.2s; }
     .section.is-visible .card:nth-child(2) { transition-delay: 0.4s; }
     .section.is-visible .card:nth-child(3) { transition-delay: 0.6s; }


    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
    }

    .btn {
      display: inline-block;
      background: var(--custom-light-blue);
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
      text-decoration: none;
      transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
      margin-top: 10px;
    }

    .btn:hover {
      background: var(--custom-light-blue-dark);
      transform: translateY(-2px);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    footer {
      background: #000;
      color: #fff;
      text-align: center;
      padding: 40px 20px;
      opacity: 0; /* Начальное состояние для анимации */
      transform: translateY(20px); /* Начальное состояние для анимации */
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

     footer.is-visible {
        opacity: 1;
        transform: translateY(0);
    }


    .footer-social {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .footer-social a {
      color: #fff;
      transition: color var(--transition);
    }

    .footer-social a:hover {
      color: var(--custom-light-blue);
    }

    @media (max-width: 768px) {
      nav {
        flex-wrap: wrap;
        justify-content: center;
      }
      .banner-content h1 {
        font-size: 36px;
      }
    }
  </style>
</head>
<body>

<header>
  <div class="container">
    <div class="logo">Российский музей истории кино</div>
    <nav>
      <!-- Ссылки на маршруты для просмотра разделов сайта -->
      <a href="{{ route('events.index') }}">Все события</a>
      <a href="{{ route('gallery.index') }}">Галерея</a>
      <a href="{{ route('news.index.user') }}">Новости</a>
      <a href="{{ route('epochs.index') }}">Эпохи</a> <!-- Добавлена ссылка для эпох -->

      @auth
        <!-- Для авторизованных пользователей -->
        <span>Привет, {{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="btn">Выйти</button>
        </form>
      @else
        <!-- Для неавторизованных -->
        <a href="{{ route('login') }}">Войти</a>
        <a href="{{ route('register') }}">Зарегистрироваться</a>
      @endauth
    </nav>
  </div>
</header>
<!-- Баннер -->
<div class="swiper banner-swiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="{{ asset('img/image 1.png') }}" alt=""></div>
    <div class="swiper-slide"><img src="{{ asset('img/image 2.jpg') }}" alt=""></div>
    <div class="swiper-slide"><img src="{{ asset('img/image 3.jpg') }}" alt=""></div>
  </div>
  <div class="banner-overlay"></div>
  <div class="banner-content">
    <h1>Погрузитесь в мир кино</h1>
    <a href="#intro" class="btn">Узнать больше</a>
  </div>
  <div class="swiper-pagination"></div>
</div>

<main>
  <!-- Введение -->
  <div class="section" id="intro">
    <h2>Добро пожаловать в мир кино</h2>
    <blockquote class="quote">
      Государственный музей кино — уникальное пространство, где оживает история отечественного кинематографа. Наслаждайтесь выставками, фильмами и атмосферой творчества.
    </blockquote>
  </div>

  <!-- Галерея -->
  <div class="section" id="gallery">
    <h2>Галерея</h2>
    <div class="gallery">
      {{-- Предполагается, что у вас есть переменная $galleryItems, содержащая данные об экспонатах галереи --}}
      {{-- Каждый элемент должен содержать хотя бы путь к изображению и ID или slug для ссылки --}}
      @php
          // Фиктивные данные для примера. Замените на реальные данные из вашего контроллера.
          $dummyGalleryItems = [
              ['id' => 1, 'image' => 'image 1.png'],
              ['id' => 2, 'image' => 'image 2.jpg'],
              ['id' => 3, 'image' => 'image 3.jpg'],
              ['id' => 4, 'image' => 'image 4.jpg'],
              ['id' => 5, 'image' => 'image 5.jpg'],
              ['id' => 6, 'image' => 'image 1.png'],
              ['id' => 7, 'image' => 'image 2.jpg'],
              ['id' => 8, 'image' => 'image 3.jpg'],
              ['id' => 9, 'image' => 'image 4.jpg'],
              ['id' => 10, 'image' => 'image 5.jpg'],
          ];
      @endphp
      @foreach($dummyGalleryItems as $item)
          {{-- Оберните изображение в тег <a> и используйте route() --}}
          <a href="{{ route('gallery.show', ['id' => $item['id']]) }}" class="gallery-item">
              <img src="{{ asset('img/' . $item['image']) }}" alt="Экспонат галереи">
          </a>
      @endforeach
    </div>
    {{-- Ссылка на полную галерею --}}
    <p style="text-align: center; margin-top: 20px;"><a href="{{ route('gallery.index') }}" class="btn">Смотреть всю галерею</a></p>
  </div>

  <!-- События -->
  <div class="section" id="events">
    <h2>События</h2>
    <div class="events-grid">
       {{-- Предполагается, что у вас есть переменная $events, содержащая данные о событиях --}}
       {{-- Каждый элемент должен содержать хотя бы изображение, заголовок, описание и ID или slug для ссылки --}}
       @php
           // Фиктивные данные для примера. Замените на реальные данные из вашего контроллера.
           $dummyEvents = [
               ['id' => 1, 'image' => 'image 1.png', 'title' => 'Ночь немого кино', 'description' => 'Погрузитесь в магию первых фильмов.'],
               ['id' => 2, 'image' => 'image 2.jpg', 'title' => 'Праздничный вечер', 'description' => 'Сбор средств в поддержку музея.'],
               ['id' => 3, 'image' => 'image 3.jpg', 'title' => 'Фестиваль "Кино"', 'description' => 'Новое поколение режиссёров.'],
           ];
       @endphp
       @foreach($dummyEvents as $event)
           <div class="card"> {{-- Используем общий класс card --}}
               <img src="{{ asset('img/' . $event['image']) }}" alt="{{ $event['title'] }}">
               <h3>{{ $event['title'] }}</h3>
               <p>{{ $event['description'] }}</p>
               {{-- Используйте route() для ссылки на страницу события --}}
               <a href="{{ route('events.show', ['event' => $event['id']]) }}" class="btn">Подробнее</a>
           </div>
       @endforeach
    </div>
    {{-- Ссылка на все события --}}
    <p style="text-align: center; margin-top: 20px;"><a href="{{ route('events.index') }}" class="btn">Все события</a></p>
  </div>

  <!-- Новости -->
  <div class="section" id="news">
    <h2>Новости</h2>
    <div class="news-grid">
        {{-- Предполагается, что у вас есть переменная $newsItems, содержащая данные о новостях --}}
        {{-- Каждый элемент должен содержать хотя бы изображение, заголовок, описание и ID или slug для ссылки --}}
        @php
            // Фиктивные данные для примера. Замените на реальные данные из вашего контроллера.
            $dummyNews = [
                ['id' => 1, 'image' => 'news1.jpg', 'title' => 'Открытие новой выставки', 'description' => 'Выставка, посвящённая классическому кинематографа.'],
                ['id' => 2, 'image' => 'news2.jpg', 'title' => 'Кинопоказ под открытым небом', 'description' => 'Уникальная возможность посмотреть фильмы на свежем воздухе!'],
                ['id' => 3, 'image' => 'news3.jpg', 'title' => 'Новые экспонаты в музее', 'description' => 'Обновлённая коллекция артефактов.'],
            ];
        @endphp
        @foreach($dummyNews as $newsItem)
            <div class="card"> {{-- Используем общий класс card --}}
                
                <h3>{{ $newsItem['title'] }}</h3>
                <p>{{ $newsItem['description'] }}</p>
                {{-- Используйте route() для ссылки на страницу новости --}}
                <a href="{{ route('news.show', ['news' => $newsItem['id']]) }}" class="btn">Читать далее</a>
            </div>
        @endforeach
    </div>
     {{-- Ссылка на все новости --}}
    <p style="text-align: center; margin-top: 20px;"><a href="{{ route('news.index.user') }}" class="btn">Все новости</a></p>
  </div>
</main>

<footer>
  <p>© 2025 Российский музей истории кино</p>
  <div class="footer-social">
    <a href="#"><i class="fab fa-vk"></i></a>
    <a href="#"><i class="fab fa-telegram"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
  </div>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  // Инициализация Swiper для баннера
  new Swiper(".banner-swiper", {
    loop: true,
    autoplay: { delay: 4000, disableOnInteraction: false }, // Продолжать autoplay после взаимодействия
    pagination: { el: ".swiper-pagination", clickable: true },
    effect: 'fade', // Эффект плавного перехода между слайдами
    fadeEffect: { crossFade: true }
  });

  // Анимация при прокрутке
  document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('.section');
    const footer = document.querySelector('footer');

    const observerOptions = {
      root: null, // Область просмотра - весь viewport
      rootMargin: '0px',
      threshold: 0.1 // Элемент виден на 10%
    };

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target); // Перестать наблюдать после появления
        }
      });
    }, observerOptions);

    sections.forEach(section => {
      observer.observe(section);
    });

    // Отдельный наблюдатель для футера
    const footerObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { root: null, rootMargin: '0px', threshold: 0.1 });

    footerObserver.observe(footer);
  });

</script>

</body>
</html>