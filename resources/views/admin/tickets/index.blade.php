@extends('layouts.app')

@section('content')
    <style>
        .tickets-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .tickets-container h2 {
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .tickets-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tickets-container th, .tickets-container td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .tickets-container th {
            background-color: #f5f5f5;
            color: #555;
            font-weight: bold;
        }

        .tickets-container tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .tickets-container tbody tr:hover {
            background-color: #eee;
        }

        .tickets-container p {
            font-size: 1.1em;
            text-align: center;
            color: #777;
            margin-top: 20px;
        }
    </style>

    <div class="tickets-container">
        <h2>Все купленные билеты</h2>

        <x-alert/>

        @if ($tickets->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Событие</th>
                        <th>Имя покупателя</th>
                        <th>Email покупателя</th>
                        <th>Дата покупки</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->event->title }}</td>
                            <td>{{ $ticket->customer_name }}</td>
                            <td>{{ $ticket->customer_email }}</td>
                            <td>{{ $ticket->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Нет купленных билетов.</p>
        @endif
    </div>
@endsection