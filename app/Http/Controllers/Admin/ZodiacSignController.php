<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZodiacSign;
use Illuminate\Http\Request;

class ZodiacSignController extends Controller
{
    public function index()
    {
        $zodiacs = ZodiacSign::all();
        return view('admin.zodiac_signs.index', compact('zodiacs'));
    }

    public function create()
    {
        return view('admin.zodiac_signs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        ZodiacSign::create($request->all());

        return redirect()->route('admin.zodiac_signs.index')->with('success', 'Đã thêm cung hoàng đạo!');
    }

    public function edit(ZodiacSign $zodiacSign)
    {
        return view('admin.zodiac_signs.edit', compact('zodiacSign'));
    }

    public function update(Request $request, ZodiacSign $zodiacSign)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $zodiacSign->update($request->all());

        return redirect()->route('admin.zodiac_signs.index')->with('success', 'Đã cập nhật cung hoàng đạo!');
    }

    public function destroy(ZodiacSign $zodiacSign)
    {
        $zodiacSign->delete();
        return back()->with('success', 'Đã xóa cung hoàng đạo!');
    }
}
