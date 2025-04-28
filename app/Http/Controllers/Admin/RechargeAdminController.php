<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\UserCoin;

class RechargeAdminController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('admin.recharge.index', compact('transactions'));
    }

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Giao dịch đã được xử lý.');
        }

        $transaction->status = 'approved';
        $transaction->save();

        // Cộng coins
        UserCoin::create([
            'user_id' => $transaction->user_id,
            'coins_change' => $transaction->amount / 1000, // 10.000 VND = 10 coins
            'reason' => 'Nạp tiền chuyển khoản',
        ]);

        return back()->with('success', '✔️ Duyệt giao dịch thành công.');
    }
}
