@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-200 to-indigo-900 py-12 px-4 text-black flex flex-col items-center">

    <h2 class="text-3xl font-bold text-center mb-8">💬 Trò chuyện với AI Chiêm Tinh</h2>

    {{-- Hiển thị ảnh biểu đồ sao nếu có --}}
    <div id="chartImage" class="text-center mb-6"></div>

    <script>
        const imageName = localStorage.getItem('chart_image');
        if (imageName) {
            document.getElementById('chartImage').innerHTML = `
                <img src="/images/charts/${imageName}" class="mx-auto rounded shadow-md max-h-[350px]" alt="Biểu đồ sao">
            `;
        }
    </script>

    {{-- Các gợi ý câu hỏi --}}
    <div id="suggestions" class="flex flex-wrap justify-center gap-3 mb-8">
        <button onclick="suggest('🌟 Tính cách nổi bật của tôi là gì?')" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full text-sm">
            🌟 Tính cách
        </button>
        <button onclick="suggest('💖 Tôi hợp cung nào trong tình yêu?')" class="px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white rounded-full text-sm">
            💖 Tình yêu
        </button>
        <button onclick="suggest('🚀 Sự nghiệp tương lai của tôi thế nào?')" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full text-sm">
            🚀 Sự nghiệp
        </button>
        <button onclick="suggest('🔮 Những thử thách lớn nhất tôi phải vượt qua?')"class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full text-sm">
            🔮 Thử thách
        </button>
        <button onclick="suggest('🌌 Điểm mạnh tiềm ẩn trong bản đồ sao của tôi?')" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-full text-sm">
            🌌 Điểm mạnh
        </button>
    </div>

    {{-- Khung chat + nhập câu hỏi --}}
    <div class="flex flex-col w-full max-w-4xl space-y-4">
        <div id="chatBox" class="flex-1 min-h-[300px] max-h-[500px] overflow-y-auto bg-[#1E1E2F] rounded-xl p-6 text-sm space-y-4">
            <div class="text-white italic">🪐 Hãy hỏi bất kỳ điều gì liên quan đến bản đồ sao của bạn...</div>
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

    /* Loader dots */
    @keyframes typing {
        0% { content: ''; }
        33% { content: '.'; }
        66% { content: '..'; }
        100% { content: '...'; }
    }

    .chat-loader .chat-bubble::after {
        content: '';
        display: inline-block;
        width: 1.5em;
        animation: typing 1s infinite steps(3,end);
    }
</style>

{{-- Javascript --}}
<script>
    function sendMessage() {
        const msg = document.getElementById("message").value;
        if (!msg.trim()) return;

        const chatBox = document.getElementById("chatBox");

        // 1) User message
        const userMsg = document.createElement('div');
        userMsg.className = 'chat-message';
        userMsg.innerHTML = `<div class="chat-bubble chat-user"><strong>Bạn:</strong> ${msg}</div>`;
        chatBox.appendChild(userMsg);

        document.getElementById("message").value = '';
        chatBox.scrollTop = chatBox.scrollHeight;

        // 2) Loader
        const loader = document.createElement('div');
        loader.className = 'chat-message chat-loader';
        loader.innerHTML = `<div class="chat-bubble chat-ai"><strong>AI:</strong> </div>`;
        chatBox.appendChild(loader);
        chatBox.scrollTop = chatBox.scrollHeight;

        // 3) Fetch
        fetch("{{ url('/chart/chat') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message: msg })
        })
        .then(async res => {
            const text = await res.text();
            // remove loader
            loader.remove();

            try {
                const data = JSON.parse(text);
                const cleanReply = data.reply.replace(/\*\*/g, '');
                const aiMsg = document.createElement('div');
                aiMsg.className = 'chat-message';
                aiMsg.innerHTML = `<div class="chat-bubble chat-ai"><strong>AI:</strong> ${cleanReply}</div>`;
                chatBox.appendChild(aiMsg);
            } catch (e) {
                const errMsg = document.createElement('div');
                errMsg.className = 'chat-message';
                errMsg.innerHTML = `<div class="chat-bubble chat-ai text-red-500 whitespace-pre-wrap">❌ Phản hồi không hợp lệ:<br><pre>${text}</pre></div>`;
                chatBox.appendChild(errMsg);
            }
            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(err => {
            loader.remove();
            const errMsg = document.createElement('div');
            errMsg.className = 'chat-message';
            errMsg.innerHTML = `<div class="chat-bubble chat-ai text-red-500">❌ Kết nối thất bại: ${err.message}</div>`;
            chatBox.appendChild(errMsg);
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    }

    function suggest(text) {
        const input = document.getElementById('message');
        input.value = text;
        sendMessage();
    }
</script>

@endsection
