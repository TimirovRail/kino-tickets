<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Seat; // Импортирум модель Seat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Показывает форму создания события.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Сохраняет новое событие в базе данных.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'total_tickets' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        // Создаем событие
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_tickets' => $request->total_tickets,
            'available_tickets' => $request->total_tickets,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        // Создаем места для события
        foreach (range(1, $request->total_tickets) as $number) {
            Seat::create([
                'event_id' => $event->id,
                'seat_number' => (string)$number, // Указываем номер места
                'booked' => false,
            ]);
        }

        return redirect()->route('admin.events.edit', $event)->with('success', 'Событие успешно создано!');
    }

    /**
     * Показывает форму редактирования события.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function dashboard()
    {
        return view('admin.dashboard'); // Создайте этот файл представления
    }

    /**
     * Обновляет событие в базе данных.
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'total_tickets' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $imagePath = $event->image; // Сохраняем текущий путь к изображению
        if ($request->hasFile('image')) {
            // Удаляем старое изображение (если есть)
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_tickets' => $request->total_tickets,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.events.edit', $event)->with('success', 'Событие успешно обновлено!');
    }

    /**
     * Удаляет событие из базы данных.
     */
    public function destroy(Event $event)
    {
        // Удаляем изображение (если есть)
        if ($event->image) {
            Storage::delete('public/' . $event->image);
        }

        // Удаляем связанные места
        $event->seats()->delete();

        $event->delete();

        return redirect()->route('admin.events.create')->with('success', 'Событие успешно удалено!');
    }

    /**
     * Показывает список всех купленных билетов.
     */
    public function showAllTickets()
    {
        $tickets = Ticket::with('event')->get(); // Получаем все билеты с информацией о событии
        return view('admin.tickets.index', compact('tickets'));
    }
}