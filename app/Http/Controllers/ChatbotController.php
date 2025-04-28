<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Models\ChatHistory;

class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        $message = $request->input('message');

        // Lấy love_input_id từ session
        $inputId = session('current_love_input_id');

        // Truyền message vào Python
        $process = new Process([
            '/usr/bin/python3',
            base_path('app/python/tinhduyen/chatbottinhduyen.py'),
            $message
        ], null, [
            'OPENAI_API_KEY' => env('OPENAI_API_KEY')
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json([
                'reply' => "❌ Lỗi khi chạy Python:\n" . $process->getErrorOutput(),
            ], 500);
        }

        $reply = $process->getOutput();

        // ✅ Lưu lịch sử chat nếu có love_input_id
        if ($inputId) {
            ChatHistory::create([
                'love_input_id' => $inputId,
                'question' => $message,
                'reply' => $reply,
            ]);
        }

        return response()->json([
            'reply' => $reply,
        ]);
    }
}
