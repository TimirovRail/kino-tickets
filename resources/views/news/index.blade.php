@extends('layouts.app')

@section('content')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    button {
        background-color: #d9534f; /* Красный фон для кнопки */
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    button:hover {
        background-color: #c9302c; /* Цвет фона при наведении для кнопки */
    }
</style>

<h2>Список новостей</h2>

<table>
    <thead>
    <tr>
        <th>Заголовок</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($news as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>
                <a href="{{ route('news.edit', $item->id) }}">Редактировать</a>
                <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту новость?');">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection