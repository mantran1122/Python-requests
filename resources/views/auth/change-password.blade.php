@extends('layouts.app')

@section('content')

    <div class="py-12 max-w-xl mx-auto">
        <div class="mb-4 font-medium text-sm text-green-600">
            <!-- Hiển thị thông báo trạng thái ở đây nếu cần -->
        </div>

        <form method="POST" action="đường_dẫn_cập_nhật_mật_khẩu_của_bạn">
            <!-- Thêm CSRF token thủ công nếu cần -->
            <input type="hidden" name="_token" value="token_csrf_của_bạn">

            <!-- Mật khẩu hiện tại -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">
                    Mật khẩu hiện tại
                </label>
                <input id="current_password" type="password" name="current_password" required autofocus
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                <!-- Hiển thị thông báo lỗi cho trường current_password ở đây -->
                <p class="mt-2 text-sm text-red-600"></p>
            </div>

            <!-- Mật khẩu mới -->
            <div class="mt-4">
                <label for="new_password" class="block text-sm font-medium text-gray-700">
                    Mật khẩu mới
                </label>
                <input id="new_password" type="password" name="new_password" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                <!-- Hiển thị thông báo lỗi cho trường new_password ở đây -->
                <p class="mt-2 text-sm text-red-600"></p>
            </div>

            <!-- Xác nhận mật khẩu mới -->
            <div class="mt-4">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                    Xác nhận mật khẩu mới
                </label>
                <input id="new_password_confirmation" type="password" name="new_password_confirmation" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" />
                <!-- Hiển thị thông báo lỗi cho trường new_password_confirmation ở đây -->
                <p class="mt-2 text-sm text-red-600"></p>
            </div>

            <!-- Nút submit -->
            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                    Đổi mật khẩu
                </button>
            </div>
        </form>
    </div>
@endsection