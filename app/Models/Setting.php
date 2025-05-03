<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key','value'];

    /**
     * Lấy giá trị setting theo key, trả về $default nếu không tìm thấy.
     */
    public static function get($key, $default = null)
    {
        $record = static::where('key', $key)->first();
        return $record ? $record->value : $default;
    }

    /**
     * Gán (tạo mới hoặc cập nhật) setting.
     */
    public static function set($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
