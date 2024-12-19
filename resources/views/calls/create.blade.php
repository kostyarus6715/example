@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="display: flex; align-items: center;">
                <form method="GET" action="{{ URL::previous() }}">
                    <button type="submit" class="btn btn-primary" style="margin-right: 10px;">
                        <i class="fas fa-arrow-left"></i> <-
                    </button>
                </form>
                <h1 style="margin-bottom: 0;">Добавить новый телефонный разговор</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('calls.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="caller">Звонящий</label>
                        <input type="text" class="form-control" id="caller" name="caller" required>
                    </div>
                    <div class="form-group">
                        <label for="receiver">Получатель</label>
                        <input type="text" class="form-control" id="receiver" name="receiver" required>
                    </div>
                    <div class="form-group">
                        <label for="duration">Длительность (в минутах)</label>
                        <input type="number" class="form-control" id="duration" name="duration" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Дата</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="audio_file">Выберите файл записи</label>
                        <input type="file" name="audio_file" class="form-control-file" required>
                    </div>
                    <div class="form-group" style="display: flex; justify-content: center;">
                        <form method="POST" action="{{ route('calls.store') }}" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" style="margin-right: 10px;">Добавить</button>
                        </form>
                        <form method="GET" action="{{ URL::previous() }}">
                            <button type="submit">Назад</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
