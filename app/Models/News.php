<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    // Указываем, какие поля разрешены для массового назначения
    protected $fillable = [
        'title',       // Заголовок новости
        'content',     // Содержание новости
        // '_token',    // Обычно _token не нужно добавлять
    ];

    // Или, если вы хотите запретить массовое назначение для некоторых полей:
    // protected $guarded = ['id', 'created_at', 'updated_at']; // Другие поля будут разрешены
}