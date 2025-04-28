@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-900 to-indigo-900 py-12 px-4 text-white flex flex-col items-center">

    <h2 class="text-3xl font-bold text-center mb-8">💬 Trò chuyện với AI Chiêm Tinh</h2>

    {{-- Hiển thị ảnh biểu đồ sao nếu có --}}
    <div id="chartImage" class="text-center mb-6">
        <!-- Chỗ để hiển thị ảnh biểu đồ -->
    </div>

    {{-- Các gợi ý câu hỏi --}}
    <div id="suggestions" class="flex flex-wrap justify-center gap-3 mb-8">
        <button onclick="suggest('🌟 Tính cách nổi bật của hai chúng tôi là gì?')" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full text-sm">
            🌟 Tính cách
        </button>
        <button onclick="suggest('💖 Tôi và người đó có hợp nhau trong tình yêu?')" class="px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-full text-sm">
            💖 Tình yêu
        </button>
        <button onclick="suggest('🚀 Tình yêu của chúng tôi sẽ thế nào trong tương lai?')" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full text-sm">
            🚀 Tương lai
        </button>
    </div>

    {{-- Khung chat + nhập câu hỏi --}}
    <div class="flex flex-col w-full max-w-4xl space-y-4">
        <div id="chatBox" class="flex-1 min-h-[300px] max-h-[500px] overflow-y-auto bg-[#1E1E2F] rounded-xl p-6 text-sm space-y-4">
            <div class="text-gray-400 italic">🪐 Hãy hỏi bất kỳ điều gì liên quan đến tình duyên...</div>
        </div>

        <div class="flex gap-2">
            <input type="text" id="message" placeholder="Gõ câu hỏi..."
                class="flex-1 px-4 py-2 rounded-lg bg-white text-black placeholder:text-gray-500" />
            <button onclick="sendMessage()"
                class="bg-pink-500 hover:bg-pink-600 px-6 py-2 rounded-lg text-white font-semibold transition-all">Gửi</button>
        </div>
    </div>

</div>

{{-- CSS --}}
<style>
    body {
        background: linear-gradient(to bottom right, #5b21b6, #3b0764);
        font-family: 'Inter', sans-serif;
        color: white;
    }

    .chat-bubble {
        max-width: 80%;
        padding: 12px 16px;
        border-radius: 16px;
        line-height: 1.6;
        white-space: pre-wrap;
        word-wrap: break-word;
        font-family: 'Segoe UI', sans-serif;
    }

    .chat-user {
        align-self: flex-end;
        background-color: #ec4899;
        color: white;
        border-top-right-radius: 0;
        margin-left: auto;
    }

    .chat-ai {
        align-self: flex-start;
        background-color: #4ade80;
        color: #111827;
        border-top-left-radius: 0;
        margin-right: auto;
    }

    .chat-message {
        display: flex;
        flex-direction: column;
    }

    .suggest-button {
        background: #6d28d9;
        border-radius: 16px;
        color: white;
        font-weight: bold;
        transition: 0.3s;
    }

    .suggest-button:hover {
        background-color: #4338ca;
    }

    /* Sửa giao diện cho input và button */
    input[type="text"] {
        background-color: #f7fafc;
        border: 1px solid #cbd5e0;
    }

    button {
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #D55F76;
    }

    .text-gray-400 {
        color: #e5e7eb;
    }

    .text-gray-800 {
        color: #2d3748;
    }

    .bg-[#1E1E2F] {
        background-color: #1e1e2f;
    }

    .bg-gray-100 {
        background-color: #f7fafc;
    }
</style>

{{-- Javascript --}}
<script>
    function sendMessage() {
        const msg = document.getElementById("message").value;
        if (!msg.trim()) return;

        const chatBox = document.getElementById("chatBox");

        const userMsg = document.createElement('div');
        userMsg.className = 'chat-message';
        userMsg.innerHTML = `<div class="chat-bubble chat-user"><strong>Bạn:</strong> ${msg}</div>`;
        chatBox.appendChild(userMsg);

        document.getElementById("message").value = '';
        chatBox.scrollTop = chatBox.scrollHeight;

        fetch("{{ url('/chatbot') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message: msg })
        })
        .then(async res => {
            const text = await res.text();
            try {
                const data = JSON.parse(text);
                const cleanReply = data.reply.replace(/\*/g, ''); // Xóa dấu *
                const aiMsg = document.createElement('div');
                aiMsg.className = 'chat-message';
                aiMsg.innerHTML = `<div class="chat-bubble chat-ai"><strong>AI:</strong> ${cleanReply}</div>`;
                chatBox.appendChild(aiMsg);
                chatBox.scrollTop = chatBox.scrollHeight;
            } catch (e) {
                const errMsg = document.createElement('div');
                errMsg.className = 'text-red-400 text-sm whitespace-pre-wrap';
                errMsg.innerHTML = `❌ Server trả về lỗi hoặc HTML không hợp lệ:<br><pre>${text}</pre>`;
                chatBox.appendChild(errMsg);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        })
        .catch(err => {
            const errMsg = document.createElement('div');
            errMsg.className = 'text-red-400';
            errMsg.textContent = `❌ Lỗi kết nối: ${err}`;
            chatBox.appendChild(errMsg);
        });
    }

    function suggest(text) {
        const input = document.getElementById('message');
        input.value = text;
        document.getElementById('chat-form').dispatchEvent(new Event('submit')); // Gửi luôn câu hỏi gợi ý
    }
</script>
@endsection
