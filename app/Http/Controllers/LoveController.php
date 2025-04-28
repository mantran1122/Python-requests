<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Models\LoveInput;
use App\Models\LoveResult;

class LoveController extends Controller
{
    public function form()
    {
        return view('love.form');
    }
    public function handleLoveAnalysis(Request $request)
    {
        $validated = $request->validate([
            'person_a.name' => 'required|string',
            'person_a.location' => 'required|string',
            'person_a.time' => 'required|string',
            'person_a.date' => 'required|string',
            'person_b.name' => 'required|string',
            'person_b.location' => 'required|string',
            'person_b.time' => 'required|string',
            'person_b.date' => 'required|string',
        ]);

        // 📝 Lưu vào DB
        $input = LoveInput::create([
            'person_a_name' => $validated['person_a']['name'],
            'person_a_birthplace' => $validated['person_a']['location'],
            'person_a_birthdate' => $validated['person_a']['date'],
            'person_a_birthtime' => $validated['person_a']['time'],
            'person_b_name' => $validated['person_b']['name'],
            'person_b_birthplace' => $validated['person_b']['location'],
            'person_b_birthdate' => $validated['person_b']['date'],
            'person_b_birthtime' => $validated['person_b']['time'],
        ]);

        session(['current_love_input_id' => $input->id]);

        // 📁 Đường dẫn tới input và output
        $basePythonPath = base_path('app/python/tinhduyen');
        $inputPath = $basePythonPath . '/input.json';
        $outputPath = $basePythonPath . '/love_analysis_data.json';

        File::ensureDirectoryExists(dirname($inputPath));
        file_put_contents($inputPath, json_encode($validated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // ✅ Chạy Python
        $pythonPath = '/usr/bin/python3';
        $process = new Process([
            $pythonPath,
            $basePythonPath . '/tinhduyen.py',
            $inputPath,
            $outputPath
        ]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // 📤 Lưu kết quả vào DB
        if (file_exists($outputPath)) {
            LoveResult::create([
                'love_input_id' => $input->id,
                'full_data' => file_get_contents($outputPath),
            ]);
        }

        $result = json_decode(file_get_contents($outputPath), true);

        return view('love.result', compact('result'));
    }
}
