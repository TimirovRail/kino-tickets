@extends('layouts.app')

@section('content')
    <style>
        .purchase-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .purchase-container h2 {
            font-size: 2.2em;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-danger {
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

        label {
            display: block;
            font-size: 1.1em;
            color: #555;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Добавлен box-shadow для анимации тени */
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #6ec8e5;
            outline: none;
            box-shadow: 0 0 8px rgba(110, 200, 229, 0.5); /* Увеличена тень при фокусе */
        }

        .seat-selection {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        input[type="radio"] {
            display: none;
        }

        .seat-label {
            display: inline-block;
            padding: 10px 15px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.4s ease, color 0.4s ease, transform 0.4s ease, box-shadow 0.4s ease; /* Увеличен transition duration */
            color: #555;
            position: relative; /* Для псевдоэлементов */
            overflow: hidden; /* Для обрезки анимации */
            animation: fade-in-up 0.5s ease-out forwards; /* Анимация появления */
            opacity: 0; /* Начальное состояние для fade-in */
            transform: translateY(20px); /* Начальное состояние для slide-up */
        }

        /* Анимация появления */
        @keyframes fade-in-up {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Эффект волны при наведении */
        .seat-label:hover::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(110, 200, 229, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: wave 0.6s ease-out;
        }

        @keyframes wave {
            to {
                width: 200%;
                height: 200%;
                opacity: 0;
            }
        }

        input[type="radio"]:checked + .seat-label {
            background-color: #6ec8e5;
            color: #fff;
            border-color: #6ec8e5;
            transform: scale(1.08); /* Немного большее увеличение */
            box-shadow: 0 0 15px rgba(110, 200, 229, 0.7); /* Более выраженная тень */
            animation: bounce-in 0.6s ease-out; /* Более выраженная анимация при выборе */
        }

        /* Анимация при выборе (более выраженная) */
        @keyframes bounce-in {
            0% {
                transform: scale(1);
                box-shadow: 0 0 5px rgba(110, 200, 229, 0.2);
            }
            40% {
                transform: scale(1.15);
                box-shadow: 0 0 20px rgba(110, 200, 229, 0.9);
            }
            60% {
                transform: scale(1.03);
                box-shadow: 0 0 10px rgba(110, 200, 229, 0.6);
            }
            80% {
                transform: scale(1.09);
                box-shadow: 0 0 18px rgba(110, 200, 229, 0.8);
            }
            100% {
                transform: scale(1.08);
                box-shadow: 0 0 15px rgba(110, 200, 229, 0.7);
            }
        }


        button[type="submit"] {
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease; /* Добавлен transform для анимации кнопки */
            background-color: #6ec8e5;
            color: #fff;
            box-shadow: 0 4px 8px rgba(110, 200, 229, 0.3); /* Тень для кнопки */
        }

        button[type="submit"]:hover {
            background-color: #5bb0d0;
            transform: translateY(-2px); /* Сдвиг вверх при наведении */
            box-shadow: 0 6px 12px rgba(110, 200, 229, 0.5); /* Увеличенная тень при наведении */
        }

        button[type="submit"]:active {
            transform: translateY(0); /* Возврат на место при нажатии */
            box-shadow: 0 2px 4px rgba(110, 200, 229, 0.2); /* Уменьшенная тень при нажатии */
        }


        p.no-seats {
            font-size: 1.1em;
            color: #777;
            text-align: center;
        }
    </style>

    <div class="purchase-container">
        <h2>Покупка билета на "{{ $event->title }}"</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.processPurchase', $event) }}" method="POST">
            @csrf

            <label for="customer_name">Имя:</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required><br>

            <label for="customer_email">Email:</label>
            <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" required><br>

            <label for="seat_number">Выберите место:</label><br>

            @if (isset($availableSeats) && count($availableSeats) > 0)
                <div class="seat-selection">
                    @foreach ($availableSeats as $seat)
                        <input type="radio"
                               id="seat_{{ $seat->seat_number }}"
                               name="seat_number"
                               value="{{ $seat->seat_number }}"
                               required>
                        <label for="seat_{{ $seat->seat_number }}" class="seat-label">
                            Место {{ $seat->seat_number }}
                        </label>
                    @endforeach
                </div>
            @else
                <p class="no-seats">Нет доступных мест для этого мероприятия.</p>
            @endif

            <button type="submit">Купить билет</button>
        </form>
    </div>
@endsection