@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="display: flex; align-items: center;">
                <h1 style="margin-bottom: 0;">Телефонный разговор</h1>
            </div>
            <div class="card-body">
                <div class="call-info" style="display: flex; flex-direction: row;">
                    <div class="form-group" style="margin-right: 20px;">
                        <label for="caller">Звонящий:</label>
                        <p>{{ $call->caller }}</p>
                    </div>
                    <div class="form-group" style="margin-right: 20px;">
                        <label for="receiver">Получатель:</label>
                        <p>{{ $call->receiver }}</p>
                    </div>
                    <div class="form-group" style="margin-right: 20px;">
                        <label for="duration">Длительность (в минутах):</label>
                        <p>{{ $call->duration }}</p>
                    </div>
                    <div class="form-group">
                        <label for="date">Дата:</label>
                        <p>{{ $call->date }}</p>
                    </div>
                </div>
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
                <form method="GET" action="{{ URL::previous() }}">
                    <div class="form-group text-center">
                        <button type="submit">Назад</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
