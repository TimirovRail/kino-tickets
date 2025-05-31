@extends('layouts.app')

@section('content')
<style>
/* Встраиваем CSS прямо в blade-шаблон */
body {
    font-family: Arial, sans-serif;
    background-color: #FFF6EA; /*  Замените на ваш цвет фона  */
    color: #333; /*  Замените на ваш цвет текста  */
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h2 {
    color: #007bff; /* Замените на ваш цвет заголовков */
    margin-bottom: 20px;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
input[type="datetime-local"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

button[type="submit"],
a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover,
a:hover {
    background-color: #0056b3;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    color: white;
}

.alert-success {
    background-color: #28a745;
}

.alert-danger {
    background-color: #dc3545;
}
</style>

<div class="container">
    <h2>Создание события</h2>

    <x-alert />

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Название:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>

        <label for="description">Описание:</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>

        <label for="start_time">Дата и время начала:</label>
        <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time') }}" required>

        <label for="end_time">Дата и время окончания:</label>
        <input type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time') }}" required>

        <label for="total_tickets">Количество билетов:</label>
        <input type="number" id="total_tickets" name="total_tickets" value="{{ old('total_tickets') }}" required>

        <label for="price">Цена:</label>
        <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" required>

        <label for="image">Изображение (необязательно):</label>
        <input type="file" id="image" name="image">

        <button type="submit">Создать событие</button>
        <a href="{{ route('events.index') }}">Отмена</a>
    </form>
</div>
@endsection