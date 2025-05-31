<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Показывает список всех купленных билетов.
     */
    public function showAllTickets()
    {
        // Получаем все билеты с информацией о событии
        $tickets = Ticket::with('event')->get();
        
        // Передаем данные в представление
        return view('admin.tickets.index', compact('tickets'));
    }
    
    /**
     * Показывает подробную информацию о конкретном билете.
     */
    public function show(Ticket $ticket)
{
    $ticket->load('event'); // добавьте эту строку
    return view('tickets.show', compact('ticket'));
}

public function showUserTickets()
{
    $user = auth()->user();
    // Предположим, у вас есть связь: user -> tickets
    $tickets = $user->tickets()->with('event')->get();

    return view('tickets.user_tickets', compact('tickets'));
}
}