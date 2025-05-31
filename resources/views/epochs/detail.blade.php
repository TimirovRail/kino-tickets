@extends('layouts.app')

@section('title', $epoch->title)

@section('content')

<style>
    /* CSS Variables for consistent styling */
    :root {
        --primary-gentle-blue: #aed6f1; /* Нежный голубой */
        --primary-gentle-blue-dark: #85c1e9; /* Чуть темнее для ховера */
        --bg-light-blue: #ebf5fb; /* Очень светлый голубой фон */
        --text-dark: #333; /* Темный текст */
        --text-gentle: #555; /* Нежный темный текст */
        --shadow-gentle: 0 4px 15px rgba(174, 214, 241, 0.5); /* Нежная тень */
        --shadow-gentle-hover: 0 0 25px rgba(133, 193, 233, 0.7); /* Нежная тень при наведении */
        --transition: all 0.4s ease; /* Плавный переход для эффектов */
        --section-padding-y: 80px; /* Вертикальный отступ для секций */
        --section-padding-x: 20px; /* Горизонтальный отступ для секций */
        --border-radius-medium: 10px; /* Чуть больше скругление */
        --spacing-small: 15px;
        --spacing-medium: 25px; /* Увеличены отступы */
        --spacing-large: 40px;
    }

    body {
        font-family: 'Roboto', sans-serif;
        line-height: 1.7;
        color: var(--text-gentle);
       
    }

    /* Styles for the main content wrapper specific to this page */
    .epoch-details {
        padding: var(--spacing-large);
        background-color: white; /* Белый фон для карточки */
        border-radius: var(--border-radius-medium);
        box-shadow: var(--shadow-gentle);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInContent 1s ease-out forwards 0.2s;
        max-width: 1000px;
        margin: var(--spacing-large) auto;
        box-sizing: border-box;
    }

    @keyframes fadeInContent {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Styles for the main heading */
    .epoch-details h1 {
        text-align: center;
        color: var(--text-dark);
        margin-bottom: var(--spacing-medium);
        font-size: 3em;
        font-weight: 700;
        line-height: 1.2;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 1s ease-out forwards 0.4s;
    }

    /* Styles for the image */
    .epoch-details img {
        display: block;
        max-width: 100%;
        height: auto;
        margin: var(--spacing-medium) auto var(--spacing-large) auto;
        border-radius: var(--border-radius-medium);
        box-shadow: var(--shadow-gentle);
        object-fit: cover;
        max-height: 450px;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 1s ease-out forwards 0.6s;
    }

    /* Styles for the description paragraph */
    .epoch-details p {
        font-size: 1.2em;
        line-height: 1.8;
        color: var(--text-gentle);
        text-align: left;
        margin-bottom: var(--spacing-large);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 1s ease-out forwards 0.8s;
    }

    /* Keyframes for fade-in animation */
    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Styles for the back button */
    .button-container {
        text-align: center;
        margin-top: var(--spacing-large);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 1s ease-out forwards 1s;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 25px;
        background-color: var(--primary-gentle-blue);
        color: var(--text-dark);
        text-decoration: none;
        border-radius: 30px;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        font-size: 1.1em;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(174, 214, 241, 0.4);
        border: none;
        cursor: pointer;
        animation: scaleUpButton 0.8s ease-out forwards 1.2s;
    }

    @keyframes scaleUpButton {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .back-button svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    .back-button:hover {
        background-color: var(--primary-gentle-blue-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(133, 193, 233, 0.5);
    }

    .back-button:active {
        transform: translateY(0);
        box-shadow: 0 3px 8px rgba(174, 214, 241, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .epoch-details {
            padding: var(--spacing-large) var(--spacing-medium);
        }

        .epoch-details h1 {
            font-size: 2.5em;
        }

        .epoch-details p {
        font-size: 1.2em;
        line-height: 1.8;
        color: var(--text-gentle);
        text-align: center; /* Выровнять текст по центру */
        margin-bottom: var(--spacing-large);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 1s ease-out forwards 0.8s;
    }
    }

    @media (max-width: 768px) {
        .epoch-details {
            padding: var(--spacing-medium);
            margin: var(--spacing-medium) auto;
        }

        .epoch-details h1 {
            font-size: 2em;
            margin-bottom: var(--spacing-medium);
        }

        .epoch-details img {
            margin: var(--spacing-medium) auto;
            max-height: 350px;
        }

        .epoch-details p {
            font-size: 1.05em;
            line-height: 1.6;
            margin-bottom: var(--spacing-medium);
        }

        .back-button {
            font-size: 1em;
            padding: 10px 20px;
        }

        .button-container {
            margin-top: var(--spacing-medium);
        }
    }

    @media (max-width: 480px) {
        .epoch-details {
            padding: var(--spacing-small);
            margin: var(--spacing-small) auto;
        }

        .epoch-details h1 {
            font-size: 1.7em;
            margin-bottom: var(--spacing-small);
        }

        .epoch-details img {
            max-height: 280px;
            margin: var(--spacing-small) auto;
        }

        .epoch-details p {
            font-size: 1em;
            text-align: left;
            margin-bottom: var(--spacing-medium);
        }

        .back-button {
            font-size: 0.9em;
            padding: 8px 15px;
            gap: 5px;
        }

        .back-button svg {
            width: 16px;
            height: 16px;
        }

        .button-container {
            margin-top: var(--spacing-medium);
        }
    }
</style>

<div class="epoch-details">
    <h1>{{ $epoch->title }}</h1>

    @if($epoch->image && file_exists(public_path($epoch->image)))
        <img src="{{ asset($epoch->image) }}" alt="{{ $epoch->title }}">
    @else
        {{-- Optional: Display a placeholder or message if the image is missing --}}
        {{-- <p>Изображение недоступно</p> --}}
    @endif

    <p>{{ $epoch->description }}</p>

    <div class="button-container">
        <a href="{{ route('epochs.index') }}" class="back-button">
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Назад к эпохам
        </a>
    </div>

</div> {{-- Close .epoch-details --}}

@endsection
