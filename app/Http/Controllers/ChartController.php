<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ChartController extends Controller
{
    public function analyze(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'birth_place' => 'required|string',
            'birth_day' => 'required|string',
            'birth_month' => 'required|string',
            'birth_year' => 'required|string',
            'birth_time' => 'required|string',
            'chart_type' => 'required|string|in:vedas,western',
        ]);

        // 👉 Gộp ngày thành chuỗi
        $fullDate = "{$validated['birth_day']}/{$validated['birth_month']}/{$validated['birth_year']}";
        $input = [
            'name' => $validated['name'],
            'birth_place' => $validated['birth_place'],
            'birth_time' => $validated['birth_time'],
            'birth_date' => $fullDate,
            'chart_type' => $validated['chart_type'],
        ];

        // 👉 Đường dẫn thư mục code Python
        $chartPath = base_path('app/python/bangdosao');

        // 👉 Ghi file input.json vào đúng thư mục input/
        $inputDir = $chartPath . '/input';
        File::ensureDirectoryExists($inputDir);
        $inputPath = $inputDir . '/input.json';
        file_put_contents($inputPath, json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // 👉 Tạo tên slug từ tên người dùng
        $name = $validated['name'];
        $safeName = Str::slug($name); // Trần Văn C → tran-van-c

        // 👉 Thư mục lưu ảnh public
        $destinationDir = public_path("images/charts");
        if (!File::exists($destinationDir)) {
            File::makeDirectory($destinationDir, 0755, true);
        }

        if ($validated['chart_type'] === 'vedas') {
            // ▶️ Gọi script tạo JSON + ảnh Vedas (.gif)
            $process = new Process([
                '/usr/bin/python3',
                $chartPath . '/bangdosaoVedas.py'
            ]);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // 📂 Copy ảnh gif từ bangdosao/charts về public/
            $source = $chartPath . "/charts/sky_chart_{$safeName}.gif";
            $destination = "{$destinationDir}/sky_chart_{$safeName}.gif";
            if (File::exists($source)) {
                File::copy($source, $destination);
                $image = "sky_chart_{$safeName}.gif";
            } else {
                $image = null;
            }

        } else {
            // ▶️ B1: Gọi Vedastro để tạo JSON
            $step1 = new Process([
                '/usr/bin/python3',
                $chartPath . '/bangdosaoVedas.py'
            ]);
            $step1->run();
            if (!$step1->isSuccessful()) {
                throw new ProcessFailedException($step1);
            }

            // ▶️ B2: Gọi script vẽ biểu đồ phương Tây (.png)
            $step2 = new Process([
                '/usr/bin/python3',
                $chartPath . '/bangdosaophuongtay.py'
            ]);
            $step2->run();
            if (!$step2->isSuccessful()) {
                throw new ProcessFailedException($step2);
            }

            // 📂 Copy ảnh .png từ bangdosao/charts về public/
            $source = $chartPath . "/charts/birth_chart_{$safeName}.png";
            $destination = "{$destinationDir}/birth_chart_{$safeName}.png";
            if (File::exists($source)) {
                File::copy($source, $destination);
                $image = "birth_chart_{$safeName}.png";
            } else {
                $image = null;
            }
        }

        // 👉 Trả view
        return view('chart.result', [
            'chartType' => $validated['chart_type'],
            'name' => $validated['name'],
            'image' => $image,
        ]);
    }

    public function form()
    {
        return view('chart.form');
    }
}
