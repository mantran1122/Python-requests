<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatHistory; // Import model ChatHistory
use Illuminate\Http\Request;

class ChatHistoryController extends Controller
{
    public function index()
    {
        $chats = ChatHistory::latest()->paginate(20); // Load 20 bản ghi mới nhất
        return view('admin.chat_histories.index', compact('chats'));
    }
}

