<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BirthInfo;
use Illuminate\Http\Request;
use App\Models\User;

class BirthInfoController extends Controller
{
    public function index()
    {
        $birthinfos = BirthInfo::latest()->paginate(10);
        return view('admin.birthinfos.index', compact('birthinfos'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.birthinfos.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'birth_time' => 'required',
            'birth_place' => 'required|string',
            'gender' => 'required|in:male,female',
            'user_id' => 'nullable|exists:users,id'
        ]);

        BirthInfo::create($request->all());

        return redirect()->route('admin.birthinfos.index')->with('success', 'Đã thêm thông tin sinh thành công!');
    }

    public function edit(BirthInfo $birthinfo)
    {
        $users = User::all();
        return view('admin.birthinfos.edit', compact('birthinfo', 'users'));
    }

    public function update(Request $request, BirthInfo $birthinfo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'birth_time' => 'required',
            'birth_place' => 'required|string',
            'gender' => 'required|in:male,female',
            'user_id' => 'nullable|exists:users,id'
        ]);

        $birthinfo->update($request->all());

        return redirect()->route('admin.birthinfos.index')->with('success', 'Đã cập nhật thông tin sinh!');
    }

    public function destroy(BirthInfo $birthinfo)
    {
        $birthinfo->delete();
        return redirect()->route('admin.birthinfos.index')->with('success', 'Đã xoá thông tin sinh!');
    }
}
