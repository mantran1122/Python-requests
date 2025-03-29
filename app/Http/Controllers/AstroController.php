<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AstroController extends Controller
{
    public function showForm()
    {
        return view('astrology.form');
    }

    public function handleForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'birth_time' => 'nullable',
            'gender' => 'required|in:male,female,other',
            'birth_place' => 'required|string|max:255',
        ]);

        // Chuyển dữ liệu thành JSON để truyền sang Python
        $json = json_encode($data);

        // Gọi container python_service chạy file astro_bot.py
        $process = new Process([
            'docker', 'exec', '-i', 'python_service', 'python', '/app/astro_bot.py'
        ]);
        $process->setInput($json);
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json([
                'error' => 'Lỗi khi chạy Python',
                'stderr' => $process->getErrorOutput(),
                'stdout' => $process->getOutput(),
            ], 500);
        }
        

        $output = $process->getOutput();

        return view('astrology.result', ['output' => $output]);
    }
}
