@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="create-news-container">
            <h1 class="create-news-title">Создать новость</h1>

            <form action="{{ route('news.store') }}" method="POST" class="create-news-form">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label"><i class="fas fa-heading"></i> Заголовок</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="content" class="form-label"><i class="fas fa-file-alt"></i> Содержание</label>
                    <textarea id="content" name="content" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label"><i class="fas fa-info-circle"></i> Описание</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Создать</button>
                <a href="{{ route('news.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Назад к новостям</a>
            </form>
        </div>
    </div>
@endsection

<style>
    .create-news-container {
        width: 80%;
        margin: 30px auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .create-news-container:hover {
        transform: translateY(-5px);
    }

    .create-news-title {
        font-size: 2.2em;
        color: #6ec8e5;
        text-align: center;
        margin-bottom: 25px;
        animation: fadeInDown 1s ease-out;
    }

    .create-news-form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #555;
    }

    .form-label i {
        margin-right: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #6ec8e5;
        outline: none;
        box-shadow: 0 0 5px rgba(110, 200, 229, 0.3);
    }

    .form-control[type="text"] {
        height: auto;
    }

    .form-control[type="textarea"] {
        height: 150px;
        resize: vertical;
    }

    .btn {
        padding: 14px 24px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        transition: background-color 0.3s ease;
        text-decoration: none;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn i {
        margin-right: 8px;
    }

    .btn-primary {
        background-color: #6ec8e5; /* Light Blue */
    }

    .btn-primary:hover {
        background-color: #4fb1c3; /* Darker Light Blue */
    }

    .btn-secondary {
        background-color: #95a5a6; /* Gray */
    }

    .btn-secondary:hover {
        background-color: #7f8c8d; /* Darker Gray */
    }

    /* Анимации */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>