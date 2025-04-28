<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\UserCoin;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('status', 'pending')->with('user')->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function approve($id)
    {
        $tx = Transaction::findOrFail($id);
        if ($tx->status !== 'pending') {
            return back()->with('error', 'Giao dịch đã được xử lý!');
        }

        // ✅ Cập nhật trạng thái
        $tx->status = 'approved';
        $tx->save();

        // ✅ Ghi vào bảng user_coins
        UserCoin::create([
            'user_id' => $tx->user_id,
            'coins_change' => $tx->amount / 1000, // 10k = 10 coins
            'reason' => 'Nạp tiền qua chuyển khoản',
        ]);

        return back()->with('success', '✅ Đã duyệt và cộng coins cho user!');
    }
}
