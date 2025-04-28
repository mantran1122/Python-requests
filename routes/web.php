<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BirthInfoController;
use App\Http\Controllers\Admin\AstrologyResultController;
use App\Http\Controllers\Admin\ZodiacSignController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LoveController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ChartChatController;
use App\Http\Controllers\Admin\RechargeApprovalController;
use App\Http\Controllers\Admin\RechargeAdminController;
use App\Http\Controllers\RechargeController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\LlmConfigurationController;
use \App\Http\Controllers\Admin\ChatHistoryController;
use \App\Http\Controllers\Admin\ChatChartHistoryController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth', 'is_admin'])->prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('birthinfos', BirthInfoController::class);
    Route::resource('astrology_results', AstrologyResultController::class);
    Route::resource('zodiac_signs', ZodiacSignController::class);
    Route::get('/recharge', [RechargeAdminController::class, 'index'])->name('recharge.index');
    Route::post('/recharge/{id}/approve', [RechargeAdminController::class, 'approve'])->name('recharge.approve');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');

    Route::resource('llm-configurations', LlmConfigurationController::class);
    Route::post('llm-configurations/{llmConfiguration}/toggle-active', [LlmConfigurationController::class, 'toggleActive'])->name('llm-configurations.toggle-active');

    Route::resource('chat-histories', ChatHistoryController::class)->only(['index']);
    Route::get('/chat-chart-histories', [ChatChartHistoryController::class, 'index'])->name('chat-chart-histories.index');

});
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword'])->name('password.update');
    Route::get('/nap-tien', [RechargeController::class, 'form'])->name('recharge.form');
    Route::post('/nap-tien', [RechargeController::class, 'submit'])->name('recharge.submit');

Route::middleware(['auth', 'check.coin'])->group(function () {
        Route::post('/chart/analyze', [ChartController::class, 'analyze'])->name('chart.analyze'); 
        Route::post('/chart/chat', [ChartChatController::class, 'reply']);
        Route::post('/love/analyze', [LoveController::class, 'handleLoveAnalysis'])->name('love.analyze');
});
Route::get('/chart', [ChartController::class, 'form'])->name('chart');   
Route::get('/chart/chat', [ChartChatController::class, 'form'])->name('chat.chart');
Route::get('/love', [LoveController::class, 'form'])->name('love.form');


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/admin/export/pdf', [DashboardController::class, 'exportPdf'])->name('admin.export.pdf');
Route::view('/dream', 'dream')->name('dream');
Route::post('/chatbot', [ChatbotController::class, 'handle']);

Route::prefix('admin/recharge')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [RechargeApprovalController::class, 'index'])->name('admin.recharge.index');
    Route::post('/{id}/approve', [RechargeApprovalController::class, 'approve'])->name('admin.recharge.approve');
    Route::post('/{id}/reject', [RechargeApprovalController::class, 'reject'])->name('admin.recharge.reject');
});

Route::get('/api/user/coins', function () {
    return response()->json([
        'coins' => auth()->check() ? auth()->user()->coinBalance() : 0
    ]);
})->middleware('auth')->name('api.getCoins');


require __DIR__.'/auth.php';
