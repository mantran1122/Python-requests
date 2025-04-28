<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BirthInfo;
use Illuminate\Support\Facades\DB;
use App\Models\AstrologyResult;
use App\Models\ZodiacSign;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\LlmConfiguration; 

class DashboardController extends Controller
{
    public function index()
    {
        $llmConfigs = LlmConfiguration::count();
        // Tra cứu mỗi ngày (7 ngày gần nhất)
        $traCuuTheoNgay = BirthInfo::select(DB::raw("DATE(created_at) as date"), DB::raw("COUNT(*) as count"))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->pluck('count', 'date');

        // ✅ Sửa chỗ này cho MySQL
        $userTheoThang = User::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw("COUNT(*) as count"))
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(6)
            ->pluck('count', 'month')
            ->reverse();

        return view('admin.dashboard', [
            'traCuuTheoNgay' => $traCuuTheoNgay,
            'userTheoThang' => $userTheoThang,
            'llmConfigs' => $llmConfigs,
        ]);
    }

    public function exportPdf()
    {
        $birthInfos = BirthInfo::all();
        $astrologyResults = AstrologyResult::with('birthInfo')->get();
        $zodiacs = ZodiacSign::all();

        $pdf = Pdf::loadView('admin.pdf.full_report_pdf', compact('birthInfos', 'astrologyResults', 'zodiacs'));
        return $pdf->download('bao_cao_chiem_tinh.pdf');
    }
}
