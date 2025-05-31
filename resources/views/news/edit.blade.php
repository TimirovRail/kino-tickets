@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Изменить новость</h1>

    <form action="{{ route('news.update', $news) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $news->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Содержание</label>
            <textarea name="content" class="form-control" id="content" rows="5" required>{{ $news->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection