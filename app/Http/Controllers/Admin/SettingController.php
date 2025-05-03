<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        // Đọc từ database, truyền qua view
        return view('admin.settings.edit', [
            'siteName' => Setting::get('site_name'),
            'siteLogo' => Setting::get('site_logo'),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:100',
            'site_logo' => 'nullable|image|max:2048',
        ]);

        // Cập nhật tên
        Setting::set('site_name', $data['site_name']);

        // Nếu upload logo mới
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('public/logo');
            $url  = Storage::url($path);
            Setting::set('site_logo', $url);
        }

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Cập nhật cài đặt thành công.');
    }
}
