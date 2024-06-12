@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0">Список телефонных разговоров</h1>
            </div>
            <div class="card-body">
                <button id="toggleFilters" class="btn btn-primary mb-3">Показать фильтры</button> <!-- Добавляем кнопку "Показать фильтры" -->
                <form action="{{ route('calls.index') }}" method="GET" class="form-inline" id="filtersPanel" style="display: none;"> <!-- Добавляем атрибут id="filtersPanel" и стиль display: none; для панели с фильтрами -->
                    <div class="form-group mr-2">
                        <label for="caller" class="mr-2">Звонящий:</label>
                        <input type="text" id="caller" name="caller" class="form-control form-control-sm" value="{{ request('caller') }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="receiver" class="mr-2">Получатель:</label>
                        <input type="text" id="receiver" name="receiver" class="form-control form-control-sm" value="{{ request('receiver') }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="duration" class="mr-2">Длительность (мин):</label>
                        <input type="number" id="duration" name="duration" class="form-control form-control-sm" value="{{ request('duration') }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="date" class="mr-2">Дата:</label>
                        <input type="date" id="date" name="date" class="form-control form-control-sm" value="{{ request('date') }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Применить фильтр</button>
                    <a href="{{ route('calls.index') }}" class="btn btn-secondary btn-sm ml-2">Сбросить фильтр</a>
                </form>
            </div>
            <a href="{{ route('calls.create') }}" class="btn btn-primary mt-3">Добавить новый разговор</a>
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>
                        <a href="{{ route('calls.index', ['sort' => 'caller', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                            Звонящий
                            @if (request('sort') === 'caller')
                                @if (request('direction') === 'asc')
                                    <i class="fas fa-sort-alpha-up"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down"></i>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('calls.index', ['sort' => 'receiver', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                            Получатель
                            @if (request('sort') === 'receiver')
                                @if (request('direction') === 'asc')
                                    <i class="fas fa-sort-alpha-up"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down"></i>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('calls.index', ['sort' => 'duration', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                            Длительность
                            @if (request('sort') === 'duration')
                                @if (request('direction') === 'asc')
                                    <i class="fas fa-sort-amount-up"></i>
                                @else
                                    <i class="fas fa-sort-amount-down"></i>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('calls.index', ['sort' => 'date', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                            Дата
                            @if (request('sort') === 'date')
                                @if (request('direction') === 'asc')
                                    <i class="fas fa-sort-numeric-up"></i>
                                @else
                                    <i class="fas fa-sort-numeric-down"></i>
                                @endif
                            @endif
                        </a>
                    </th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($calls as $call)
                    <tr>
                        <td>{{ $call->caller }}</td>
                        <td>{{ $call->receiver }}</td>
                        <td>{{ $call->duration }} минут</td>
                        <td>{{ $call->date }}</td>
                        <td>
                            <a href="{{ route('calls.show', $call->id) }}" class="btn btn-info">Просмотр</a>
                            <a href="{{ route('calls.edit', $call->id) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('calls.destroy', $call->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toggleFiltersBtn = document.getElementById('toggleFilters');
            var filtersPanel = document.getElementById('filtersPanel');

            toggleFiltersBtn.addEventListener('click', function() {
                if (filtersPanel.style.display === 'none' || filtersPanel.style.display === '') {
                    filtersPanel.style.display = 'block';
                    this.textContent = 'Скрыть фильтры';
                } else {
                    filtersPanel.style.display = 'none';
                    this.textContent = 'Показать фильтры';
                }
            });
        });
    </script>
@endsection
