<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Models\ChatChartHistory; // thêm dòng này

class ChartChatController extends Controller
{
    public function reply(Request $request)
    {
        $question = $request->input('message');

        // 🔒 Kiểm tra rỗng
        if (!$question || trim($question) === '') {
            return response()->json([
                'reply' => '❗ Vui lòng nhập câu hỏi để bắt đầu trò chuyện với AI chiêm tinh.'
            ]);
        }

        // ▶️ Gọi Python
        $process = new Process([
            '/usr/bin/python3',
            base_path('app/python/bangdosao/chatbotchart.py'),
            $question
        ]);

        $process->setTimeout(180);
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json([
                'reply' => "❌ Lỗi khi chạy chatbot Python:\n" . $process->getErrorOutput()
            ], 500);
        }

        // ✅ Kết quả GPT
        $reply = trim($process->getOutput());

        // ✅ Dữ liệu bản đồ sao từ session (nếu có)
        $astroData = session('astro_data') ?? null;

        // 💾 Lưu lịch sử vào DB
        ChatChartHistory::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'user_message' => $question,
            'ai_response' => $reply,
            'astro_data' => is_array($astroData) ? $astroData : json_decode($astroData, true),
            'chart_type' => 'western' // hoặc 'vedic' nếu có phân loại
        ]);

        return response()->json([
            'reply' => $reply
        ]);
    }

    public function form()
    {
        return view('chart.chat');
    }
}
