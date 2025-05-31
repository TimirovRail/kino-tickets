<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Отображение списка новостей для администраторов
    public function index()
    {
        $news = News::all(); // Получаем все записи новостей из базы данных
        return view('news.index', compact('news')); // Возвращаем представление с новостями для администраторов
    }

    // Отображение списка новостей для обычных пользователей
    public function indexForUsers()
    {
        $news = News::all(); // Получаем все записи новостей из базы данных
        return view('news.index_user', compact('news')); // Возвращаем представление с новостями для пользователей
    }

    // Показать форму для создания новой новости
    public function create()
    {
        return view('news.create'); // Возвращаем представление для создания новой новости
    }

    // Сохранение новой новости
    public function store(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string', // Валидация для описания
            'content' => 'required|string',
        ]);

        // Создать новую запись в таблице news
        News::create($request->all()); 
        return redirect()->route('news.index')->with('success', 'Новость успешно создана!'); // Перенаправление на страницу списка новостей
    }

    // Показать форму для редактирования существующей новости
    public function edit(News $news)
    {
        return view('news.edit', compact('news')); // Возвращаем представление для редактирования
    }

    // Обновление существующей новости
    public function update(Request $request, News $news)
    {
        // Валидация входящих данных
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string', // Валидация для описания
            'content' => 'required|string',
        ]);

        // Обновление существующей записи
        $news->update($request->all()); 
        return redirect()->route('news.index')->with('success', 'Новость успешно обновлена!'); // Перенаправление на страницу списка новостей
    }

    // Удаление существующей новости
    public function destroy(News $news)
    {
        $news->delete(); // Удаление записи
        return redirect()->route('news.index')->with('success', 'Новость успешно удалена!'); // Перенаправление на страницу списка новостей
    }

    // Показывает детальную информацию о новости
    public function show(News $news)
    {
        return view('news.show', compact('news')); // Возвращаем представление для показа новости
    }
}