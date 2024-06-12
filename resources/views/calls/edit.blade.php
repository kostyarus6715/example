@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="display: flex; align-items: center;">
                <h1 style="margin-bottom: 0;">Редактировать телефонный разговор</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('calls.update', $call->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="caller">Звонящий</label>
                        <input type="text" id="caller" name="caller" class="form-control" value="{{ $call->caller }}" required>
                    </div>
                    <div class="form-group">
                        <label for="receiver">Получатель</label>
                        <input type="text" id="receiver" name="receiver" class="form-control" value="{{ $call->receiver }}" required>
                    </div>
                    <div class="form-group">
                        <label for="duration">Длительность (в минутах)</label>
                        <input type="number" id="duration" name="duration" class="form-control" value="{{ $call->duration }}" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Дата</label>
                        <input type="date" id="date" name="date" class="form-control" value="{{ $call->date }}" required>
                    </div>

                    <!-- Вывод текущего файла записи -->
                    <div class="form-group">
                        <label for="current_audio_file">Текущий файл записи</label><br>
                        @if($call->audio_file)
                            <audio controls>
                                <source src="{{ Storage::url($call->audio_file) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @else
                            <p>Файл записи отсутствует</p>
                        @endif
                    </div>
                    <!-- Загрузка нового файла записи -->
                    <div class="form-group">
                        <label for="new_audio_file">Выберите новый файл записи</label>
                        <input type="file" name="new_audio_file" class="form-control">
                    </div>
                    <div class="form-group" style="display: flex; justify-content: center;">
                        <button type="submit" style="margin-right: 10px;">Обновить</button>
                        <form method="GET" action="{{ URL::previous() }}">
                            <button type="submit">Назад</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
