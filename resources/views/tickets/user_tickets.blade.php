@extends('layouts.app')

@section('content')
<style>
/* Общий контейнер */
.ticket-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border: 2px dashed #6ec8e5; /* пунктирная обводка */
    animation: fadeInUp 0.8s ease forwards;
    opacity: 0;
}

/* Заголовок */
h2 {
    text-align: center;
    font-size: 2.5em;
    color: #333;
    margin-bottom: 20px;
    position: relative;
}
h2::after {
    content: "";
    display: block;
    width: 80px;
    height: 4px;
    background-color: #6ec8e5;
    margin: 12px auto 0;
    border-radius: 2px;
}

/* Стиль для каждого билета */
.ticket {
    border: 1px dashed #6ec8e5; /* пунктирная граница */
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    background-color: #f9f9f9;
    transition: transform 0.3s, box-shadow 0.3s;
}
.ticket:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(110, 200, 229, 0.3);
}

/* Заголовки внутри билета */
.ticket p {
    margin: 8px 0;
    font-size: 1em;
}
.ticket strong {
    color: #6ec8e5;
}

/* Кнопки */
.btn {
    display: inline-block;
    padding: 12px 20px;
    margin-top: 15px;
    margin-right: 10px;
    font-size: 1em;
    color: #fff;
    background-color: #6ec8e5;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    text-decoration: none;
}
.btn:hover {
    background-color: #5bb8d5;
    transform: scale(1.05);
}

/* Анимация появления */
@keyframes fadeInUp {
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

<div class="ticket-container">
    <h2>Мои купленные билеты</h2>
    
    @if($tickets->isEmpty())
        <p style="text-align: center; font-size: 1.2em;">У вас пока нет купленных билетов.</p>
    @else
        @foreach($tickets as $ticket)
            <div class="ticket">
                <p><strong>Мероприятие:</strong> {{ $ticket->event->title ?? 'Не указано' }}</p>
                <p><strong>Дата:</strong>
                    @if($ticket->event && $ticket->event->start_time)
                        {{ $ticket->event->start_time->format('d.m.Y') }}
                    @else
                        Не указана
                    @endif
                </p>
                <p><strong>Место:</strong> {{ $ticket->seat_number }}</p>
                <p><strong>Имя покупателя:</strong> {{ $ticket->customer_name }}</p>
                <p><strong>Email:</strong> {{ $ticket->customer_email }}</p>
                <!-- Можно оставить кнопку для печати -->
                <button class="btn" onclick="printTicket()">Печать</button>
            </div>
        @endforeach
    @endif
</div>

<script>
function printTicket() {
    window.print();
}
</script>
@endsection