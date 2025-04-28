<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RechargeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RechargeApprovalController extends Controller
{
    // Hiển thị danh sách yêu cầu nạp
    public function index()
    {
        $requests = RechargeRequest::with('user')->latest()->get();
        return view('admin.recharge.index', compact('requests'));
    }

    // Duyệt nạp tiền
    public function approve($id)
    {
        $req = RechargeRequest::findOrFail($id);
        if ($req->status !== 'pending') {
            return back()->with('error', 'Yêu cầu đã xử lý.');
        }

        $req->approve(Auth::id()); // gọi hàm approve đã viết trong model
        return back()->with('success', '✅ Đã duyệt và cộng coin!');
    }

    // Từ chối
    public function reject($id)
    {
        $req = RechargeRequest::findOrFail($id);
        if ($req->status !== 'pending') {
            return back()->with('error', 'Yêu cầu đã xử lý.');
        }

        $req->update(['status' => 'rejected', 'admin_id' => Auth::id()]);
        return back()->with('warning', '🚫 Đã từ chối yêu cầu.');
    }
}
