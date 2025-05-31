<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Отображает главную страницу.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('welcome'); //  Отображаем представление welcome.blade.php
    }
}