<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AstrologyResult;
use App\Models\BirthInfo;
use Illuminate\Http\Request;

class AstrologyResultController extends Controller
{
    public function index()
    {
        $results = AstrologyResult::with('birthInfo')->latest()->paginate(10);
        return view('admin.astrology_results.index', compact('results'));
    }

    public function create()
    {
        $birthInfos = BirthInfo::all();
        return view('admin.astrology_results.create', compact('birthInfos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'birth_info_id' => 'required|exists:birth_infos,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        AstrologyResult::create($request->only('birth_info_id', 'title', 'content'));

        return redirect()->route('admin.astrology_results.index')->with('success', 'Đã lưu kết quả chiêm tinh!');
    }

    public function edit(AstrologyResult $astrology_result)
    {
        $birthInfos = BirthInfo::all();
        return view('admin.astrology_results.edit', compact('astrology_result', 'birthInfos'));
    }

    public function update(Request $request, AstrologyResult $astrology_result)
    {
        $request->validate([
            'birth_info_id' => 'required|exists:birth_infos,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $astrology_result->update($request->only('birth_info_id', 'title', 'content'));

        return redirect()->route('admin.astrology_results.index')->with('success', 'Đã cập nhật kết quả chiêm tinh!');
    }

    public function destroy(AstrologyResult $astrology_result)
    {
        $astrology_result->delete();
        return redirect()->route('admin.astrology_results.index')->with('success', 'Đã xoá kết quả chiêm tinh!');
    }
}
