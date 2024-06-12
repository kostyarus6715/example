<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Call;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CallController extends Controller
{
    protected $fillable = ['caller', 'receiver', 'duration', 'date', 'audio_file'];

    public function index(Request $request)
    {
        $sortField = $request->query('sort', 'caller');
        $sortDirection = $request->query('direction', 'asc');

        $sortableFields = ['caller', 'receiver', 'duration', 'date'];
        $calls = Call::query();

        // Применяем сортировку
        if (in_array($sortField, $sortableFields)) {
            $direction = in_array(strtolower($sortDirection), ['asc', 'desc']) ? strtolower($sortDirection) : 'asc';
            $calls->orderBy($sortField, $direction);
        }

        // Применяем фильтры, если они есть
        if ($request->filled('caller')) {
            $calls->where('caller', $request->caller);
        }

        if ($request->filled('receiver')) {
            $calls->where('receiver', $request->receiver);
        }

        if ($request->filled('duration')) {
            $calls->where('duration', $request->duration);
        }

        if ($request->filled('date')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->date)->toDateString();
            $calls->whereDate('date', $date);
        }

        // Получаем данные из базы данных
        $calls = $calls->get();

        return view('calls.index', [
            'calls' => $calls,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
        ]);
    }

    public function create(Request $request)
    {
        $audioFile = $request->session()->get('audio_file');
        return view('calls.create', compact('audioFile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'caller' => 'required',
            'receiver' => 'required',
            'duration' => 'required|integer',
            'date' => 'required|date',
            'audio_file' => 'nullable|file|mimes:mp3,wav',
        ]);

        $call = Call::create($request->except('audio_file'));

        if ($request->hasFile('audio_file')) {
            $audioFile = $request->file('audio_file');
            $filePath = $audioFile->store('public/audio_files');
            $call->audio_file = str_replace('public/', '', $filePath);
            $call->save();
        }

        return redirect()->route('calls.index');
    }

    public function show(Call $call)
    {
        return view('calls.show', compact('call'));
    }

    public function edit(Call $call)
    {
        return view('calls.edit', compact('call'));
    }

    public function update(Request $request, Call $call)
    {
        $request->validate([
            'caller' => 'required',
            'receiver' => 'required',
            'duration' => 'required|integer',
            'date' => 'required|date',
            'new_audio_file' => 'nullable|file|mimes:mp3,wav',
        ]);

        $call->update($request->only(['caller', 'receiver', 'duration', 'date']));

        if ($request->hasFile('new_audio_file')) {
            if ($call->audio_file) {
                Storage::delete($call->audio_file);
            }

            $audioFile = $request->file('new_audio_file');
            $fileName = time() . '_' . $audioFile->getClientOriginalName();
            $filePath = $audioFile->storeAs('public/call_recordings', $fileName);
            $call->audio_file = $filePath;
            $call->save();
        }

        return redirect()->route('calls.index')->with('success', 'Телефонный разговор успешно обновлен');
    }

    public function destroy(Call $call)
    {
        if ($call->audio_file) {
            Storage::delete($call->audio_file);
        }
        $call->delete();
        return redirect()->route('calls.index');
    }

    public function report(Request $request)
    {
        $calls = Call::query();

        if ($request->filled('caller')) {
            $calls->where('caller', $request->caller);
        }

        if ($request->filled('receiver')) {
            $calls->where('receiver', $request->receiver);
        }

        if ($request->filled('duration')) {
            $calls->where('duration', $request->duration);
        }

        if ($request->filled('date')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->date)->toDateString();
            $calls->whereDate('date', $date);
        }

        $calls = $calls->get();

        return view('calls.report', compact('calls'));
    }

    public function downloadReport(Request $request)
    {
        $calls = Call::query();

        if ($request->filled('caller')) {
            $calls->where('caller', $request->caller);
        }

        if ($request->filled('receiver')) {
            $calls->where('receiver', $request->receiver);
        }

        if ($request->filled('duration')) {
            $calls->where('duration', $request->duration);
        }

        if ($request->filled('date')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->date)->toDateString();
            $calls->whereDate('date', $date);
        }

        $calls = $calls->get();

        $reportContent = "Отчет по телефонным разговорам\n";
        $reportContent .= "Звонящий,Получатель,Длительность,Дата\n";

        foreach ($calls as $call) {
            $reportContent .= "{$call->caller},{$call->receiver},{$call->duration} минут,{$call->date}\n";
        }

        $filename = "report_" . Carbon::now()->format('Y-m-d_H-i-s') . ".txt";
        $headers = [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        return response($reportContent, 200, $headers);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'caller' => 'required',
            'receiver' => 'required',
            'duration' => 'required|integer',
            'date' => 'required|date',
            'new_audio_file' => 'required|file|mimes:mp3,wav',
        ]);

        $call = Call::create($request->only(['caller', 'receiver', 'duration', 'date']));

        if ($request->hasFile('new_audio_file')) {
            $audioFile = $request->file('new_audio_file');
            $fileName = time() . '_' . $audioFile->getClientOriginalName();
            $filePath = $audioFile->storePublicly('public/call_recordings');
            $call->update(['audio_file' => $filePath]);

            Log::info('Новый файл записи сохранен: ' . $filePath);
        } else {
            Log::info('Новый файл записи не был загружен.');
        }

        return redirect()->route('calls.index')->with('success', 'Запись успешно загружена');
    }
}
