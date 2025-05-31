<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Seat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // Для получения текущего пользователя

class EventController extends Controller
{
    // Обеспечиваем, что все методы, связанные с покупкой, требуют авторизации
    public function __construct()
    {
        $this->middleware('auth')->only(['processPurchase']);
    }

    // Отображение списка будущих событий
    public function index()
    {
        $events = Event::withCount('tickets')
            ->where('start_time', '>', now())
            ->orderBy('start_time')
            ->paginate(5);

        return view('events.index', compact('events'));
    }

    // Просмотр конкретного события
    public function show(Event $event)
    {
        $event->load('tickets');
        return view('events.show', compact('event'));
    }

    // Страница покупки билета
    public function purchase(Event $event)
    {
        $availableSeats = Seat::where('event_id', $event->id)
            ->where('is_reserved', false)
            ->orderBy('seat_number')
            ->get();

        return view('events.purchase', compact('event', 'availableSeats'));
    }

    // Обработка покупки билета
    public function processPurchase(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'seat_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $result = DB::transaction(function () use ($request, $event) {
                // Блокировка выбранного места
                $seat = Seat::lockForUpdate()
                    ->where('event_id', $event->id)
                    ->where('seat_number', $request->seat_number)
                    ->where('is_reserved', false)
                    ->first();

                if (!$seat) {
                    return ['success' => false, 'message' => 'Выбранное место недоступно.'];
                }

                // Обновляем статус места
                $seat->is_reserved = true;
                $seat->save();

                // Создаем билет и связываем его с текущим пользователем
                $ticket = Ticket::create([
                    'event_id' => $event->id,
                    'user_id' => Auth::id(), // присваиваем текущего пользователя
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'seat_number' => $request->seat_number,
                ]);

                return ['success' => true, 'ticket_id' => $ticket->id];
            }, 5);

            if ($result['success']) {
                return redirect()->route('tickets.show', ['ticket' => $result['ticket_id']]);
            } else {
                return back()->withErrors(['message' => $result['message']])->withInput();
            }
        } catch (\Exception $e) {
            Log::error("Ошибка при покупке билета: " . $e->getMessage());
            return back()->withErrors(['message' => 'Произошла ошибка при покупке билета. Попробуйте еще раз.']);
        }
    }

    // Просмотр билета
    public function showTicket(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    // Страница создания события
    public function create()
    {
        return view('events.create');
    }

    // Сохранение нового события
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
            'available_tickets' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'available_tickets' => $request->available_tickets,
        ]);

        return redirect()->route('events.index')->with('success', 'Событие успешно создано!');
    }

    // Редактирование события
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Обновление события
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
            'available_tickets' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'available_tickets' => $request->available_tickets,
        ]);

        return redirect()->route('events.index')->with('success', 'Событие успешно обновлено!');
    }

    // Удаление события
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Событие успешно удалено!');
    }
}