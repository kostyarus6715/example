@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Отчет по телефонным разговорам</h1>
        <a href="{{ route('calls.report.download', request()->all()) }}" class="btn btn-primary mb-3">Скачать отчет</a>

        <div class="mb-3" style="width: 400px; height: 200px;">
            <canvas id="callsChart"></canvas>
        </div>

        <table class="table mt-3">
            <thead>
            <tr>
                <th>Звонящий</th>
                <th>Получатель</th>
                <th>Длительность</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            @foreach($calls as $call)
                <tr>
                    <td>{{ $call->caller }}</td>
                    <td>{{ $call->receiver }}</td>
                    <td>{{ $call->duration }} минут</td>
                    <td>{{ $call->date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('callsChart').getContext('2d');
        const callsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($calls->pluck('date')),
                datasets: [{
                    label: 'Длительность звонков (мин)',
                    data: @json($calls->pluck('duration')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
