@extends('layouts.app')

@section('content')
    <style>
        .edit-event-container {
            max-width: 700px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .edit-event-container h2 {
            font-size: 2.2em;
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 1.1em;
            color: #555;
            margin-bottom: 10px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s ease;
            box-sizing: border-box; /* Важно для правильной ширины */
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        .btn {
            padding: 12px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin-right: 15px; /* Отступ между кнопками */
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        .event-image {
            max-width: 200px;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="edit-event-container">
        <h2>Редактировать событие</h2>

        <x-alert/>

        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Название:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea id="description" name="description" rows="5" class="form-control" required>{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="start_time">Дата и время начала:</label>
                <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="end_time">Дата и время окончания:</label>
                <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time', $event->end_time->format('Y-m-d\TH:i')) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="total_tickets">Всего билетов:</label>
                <input type="number" id="total_tickets" name="total_tickets" value="{{ old('total_tickets', $event->total_tickets) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Цена:</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $event->price) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image">Изображение:</label>
                <input type="file" id="image" name="image" class="form-control">
                @if($event->image)
                    <img src="" alt="Изображение события" class="event-image">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Обновить</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Назад к списку</a>
        </form>
    </div>
@endsection