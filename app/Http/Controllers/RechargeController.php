<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class RechargeController extends Controller
{
    // Hiển thị form nạp tiền
    public function form()
    {
        return view('recharge.form');
    }

    // Xử lý gửi yêu cầu nạp
    public function submit(Request $request)
    {
        $request->validate([
            'amount_vnd' => 'required|numeric|min:1000'
        ]);

        $user = Auth::user();
        $amount = $request->input('amount_vnd');

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 'pending',
            'momo_transaction_id' => null // hoặc bạn có thể thêm nếu có xử lý Momo sau
        ]);

        return redirect()->route('home')->with('success', '🕐 Đã gửi yêu cầu nạp tiền. Vui lòng chờ admin duyệt trong vài phút. Nếu cần hỗ trợ nhanh, liên hệ hotline: 0909 999 999.');
    }
}
