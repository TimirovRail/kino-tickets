<?php

namespace App\Http\Controllers;

use App\Models\Exhibit;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Получаем все экспонаты
        $exhibits = Exhibit::all();
        return view('gallery.index', compact('exhibits'));
    }

    public function show($id)
    {
        // Получаем один экспонат по ID
        $exhibit = Exhibit::findOrFail($id);
        return view('gallery.show', compact('exhibit'));
    }
}