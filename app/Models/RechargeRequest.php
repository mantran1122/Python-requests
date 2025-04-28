<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RechargeRequest extends Model
{
    protected $fillable = [
        'user_id', 'amount_vnd', 'coins', 'transfer_content', 'status', 'admin_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Duyệt nạp: cộng xu + cập nhật trạng thái
    public function approve($adminId) {
        UserCoin::create([
            'user_id' => $this->user_id,
            'coins_change' => $this->coins,
            'reason' => 'Nạp tiền được duyệt'
        ]);
        $this->update(['status' => 'approved', 'admin_id' => $adminId]);
    }
}