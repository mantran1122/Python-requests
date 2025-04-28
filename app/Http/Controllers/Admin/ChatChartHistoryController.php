<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatChartHistory;

class ChatChartHistoryController extends Controller
{
    public function index()
    {
        $histories = ChatChartHistory::with('user')->latest()->paginate(20);
        $totalMessages = ChatChartHistory::count();

        return view('admin.chat_chart_histories.index', compact('histories', 'totalMessages'));

    }
}
