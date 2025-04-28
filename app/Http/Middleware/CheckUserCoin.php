<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCoin;

class CheckUserCoin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // ✅ Kiểm tra đủ xu chưa
        if ($user && $user->coinBalance() <= 0) {
            return redirect()->route('recharge.form')
                ->with('error', '❌ Bạn không đủ coins để sử dụng tính năng này. Vui lòng nạp thêm.');
        }

        // ✅ Trừ 1 coin
        UserCoin::create([
            'user_id' => $user->id,
            'coins_change' => -1,
            'reason' => 'Sử dụng tính năng chiêm tinh',
        ]);

        return $next($request);
    }
}
