<!-- resources/views/tickets/show.blade.php -->
@extends('layouts.app')

@section('content')
<style>
    /* Общие стили для страницы билета */
    .ticket-container {
        max-width: 850px;
        margin: 30px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        font-family: 'Arial', sans-serif;
        position: relative;
    }

    /* Название музея */
    .museum-title {
        text-align: center;
        font-size: 2.2em;
        font-weight: bold;
        color: #6ec8e5; /* основной цвет */
        margin-bottom: 20px;
    }

    /* Основной блок билета */
    .ticket {
        border: 2px dashed #6ec8e5; /* пунктирная линия основного цвета */
        border-radius: 12px;
        padding: 30px;
        position: relative;
        background-color: #f9f9f9;
    }

    /* Название мероприятия */
    .event-title {
        text-align: center;
        font-size: 2em;
        font-weight: bold;
        margin-bottom: 20px;
        color: #6ec8e5; /* основной цвет */
    }

    /* Информация о билете */
    .ticket-info p {
        font-size: 1.2em;
        margin-bottom: 15px;
        line-height: 1.5;
        color: #333;
    }

    .ticket-info p strong {
        color: #6ec8e5; /* основной цвет */
    }

    /* Пунктирная линия для вырезания */
    .dashed-line {
        border-top: 2px dashed #6ec8e5; /* пунктирная линия основного цвета */
        margin: 30px 0;
    }

    /* Стиль для текста под линией */
    .ticket-info p.subtext {
        text-align: center;
        font-size: 1em;
        color: #777;
        margin-top: 10px;
    }

    /* Кнопки для печати и скачивания PDF */
    .actions {
        margin-top: 30px;
        text-align: center;
    }

    .actions button {
        padding: 12px 25px;
        margin: 10px;
        font-size: 1.1em;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        background-color: #6ec8e5; /* основной цвет */
        color: #fff;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .actions button:hover {
        background-color: #5ab0d6; /* чуть темнее при hover */
        transform: translateY(-2px);
    }

    /* Стиль для печати */
    @media print {
        body {
            margin: 0;
            padding: 0;
        }
        .ticket-container {
            box-shadow: none;
            border: none;
            margin: 0;
            padding: 20px;
        }
        .actions {
            display: none;
        }
        /* Убираем пунктирную линию при печати, если нужно */
        .dashed-line {
            border-top: none;
        }
    }
</style>

<div class="ticket-container" id="ticket">
    <div class="museum-title">Музей истории кино</div>
    <div class="ticket">
        <div class="event-title">Билет на мероприятие</div>
        <div class="ticket-info">
            <p><strong>Мероприятие:</strong> {{ $ticket->event->title ?? 'Не указано' }}</p>
            <p><strong>Дата мероприятия:</strong>
                @if($ticket->event && $ticket->event->start_time)
                    {{ $ticket->event->start_time->format('d.m.Y') }}
                @else
                    Не указана
                @endif
            </p>
            <p><strong>Место:</strong> {{ $ticket->seat_number }}</p>
            <p><strong>Имя покупателя:</strong> {{ $ticket->customer_name }}</p>
            <p><strong>Email:</strong> {{ $ticket->customer_email }}</p>
        </div>
        <div class="dashed-line"></div>
        <p class="subtext">Вырежьте билет по пунктирной линии</p>
    </div>
</div>

<!-- Кнопки для печати и скачивания PDF -->
<div class="actions">
    <button onclick="window.print()">Распечатать билет</button>
    <button onclick="downloadPDF()">Скачать PDF</button>
</div>

<!-- Скрипты для генерации PDF -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script>
    function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const element = document.getElementById('ticket');
        html2canvas(element, { scale: 2 }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');
            const imgProps= pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save('ticket.pdf');
        });
    }
</script>
@endsection