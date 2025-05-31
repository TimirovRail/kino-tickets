@extends('layouts.app')

@section('content')
<style>
    .event-list-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-in-out;
    }

    .event-list-container h2 {
        font-size: 2.8em;
        margin-bottom: 25px;
        text-align: center;
        color: #333;
        position: relative;
    }

    .event-list-container h2::after {
        content: "";
        display: block;
        width: 80px;
        height: 4px;
        background-color: #6ec8e5; /* Новый нежно-голубой */
        margin: 12px auto 0;
        border-radius: 2px;
    }

    /* Стиль для кнопки "Мои билеты" */
    .my-tickets-button {
        display: inline-block;
        padding: 14px 24px;
        font-size: 1.2em;
        border-radius: 8px;
        background-color: #6ec8e5; /* Синий цвет */
        color: #fff;
        text-decoration: none;
        margin-bottom: 25px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
    }

    

    .event-item {
        margin-bottom: 30px;
        padding: 20px;
        border: 1px solid #eee;
        border-radius: 12px;
        display: flex;
        background-color: #fafafa;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(20px);
        animation: slideUp 0.6s ease forwards;
    }

    .event-item:nth-child(even) {
        animation-delay: 0.1s;
    }

    .event-item:nth-child(odd) {
        animation-delay: 0.2s;
    }

    .event-item:hover {
        background-color: #eaf7fb; /* Очень нежный голубой */
        box-shadow: 0 4px 12px rgba(110, 200, 229, 0.5);
        transform: scale(1.02);
    }

    .event-item .event-image {
        width: 220px;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 20px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .event-item:hover .event-image {
        transform: scale(1.05);
    }

    .event-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .event-item h3 {
        font-size: 1.9em;
        margin-bottom: 10px;
        color: #333;
    }

    .event-item h3 a {
        text-decoration: none;
        color: #6ec8e5; /* Нежно-голубой */
        transition: color 0.3s ease;
    }

    .event-item h3 a:hover {
        color: #56b4d0; /* Темнее голубого */
    }

    .event-item p {
        font-size: 1.1em;
        line-height: 1.6;
        color: #555;
    }

    .event-item a.read-more-button {
        align-self: start;
        padding: 10px 18px;
        font-size: 1em;
        border-radius: 6px;
        background-color: #6ec8e5; /* Нежно-голубой */
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 3px 6px rgba(110, 200, 229, 0.5);
        margin-top: 10px;
    }

    .event-item a.read-more-button:hover {
        background-color: #56b4d0;
        transform: translateY(-2px);
    }

    .event-list-container p.no-events {
        font-size: 1.3em;
        color: #777;
        text-align: center;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .pagination a,
    .pagination span {
        padding: 10px 15px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #333;
        margin: 0 5px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background-color: #f5f5f5;
        transform: scale(1.1);
    }

    .pagination .active span {
        background-color: #6ec8e5;
        color: #fff;
        border-color: #6ec8e5;
    }

    .pagination .disabled a {
        color: #999;
        pointer-events: none;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="event-list-container">
    <h2>Предстоящие мероприятия</h2>

    <x-alert />

    <!-- Кнопка "Мои билеты" -->
   <div style="text-align: center; margin-bottom: 20px;">
    <a href="/my-tickets" class="my-tickets-button">Мои билеты</a>
</div>

    <div class="event-list">
        @forelse ($events as $event)
            <div class="event-item">
                @if($event->image)
                    {{-- Если изображение в public или storage --}}
                    {{-- Например, так: --}}
                    {{-- <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="event-image"> --}}
                @else
                    <img src="{{ asset('img/image 2.png') }}" alt="Placeholder" class="event-image">
                @endif
                <div class="event-details">
                    <h3><a href="{{ route('events.show', $event) }}">{{ $event->title }}</a></h3>
                    <p>{{ $event->start_time->format('d.m.Y H:i') }} - {{ $event->end_time->format('H:i') }}</p>
                    <p>{{ Str::limit($event->description, 100) }}</p>
                    <a href="{{ route('events.show', $event) }}" class="read-more-button">Подробнее</a>
                </div>
            </div>
        @empty
            <p class="no-events">Нет предстоящих мероприятий.</p>
        @endforelse
    </div>

    <div class="pagination">
        {{ $events->links() }}
    </div>
</div>
@endsection