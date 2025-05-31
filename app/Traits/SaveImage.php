<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait SaveImage
{
    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function announcementImage($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d') . "_." . $numb . "_." . $extension;
        $filenamepath   = 'announcement/image' . '/' . 'img/' . $filenamenew;
        $filename       = $img->move(public_path('storage/announcement/image' . '/' . 'img'), $filenamenew);
        return $filenamepath;
    }
    public function complaintImage($image)
    {
        // $this->attributes['slug'] = Str::slug($image, config('roles.separator'));
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d') . "_." . $numb . "_." . $extension;
        $filenamepath   = 'complaint/image' . '/' . 'img/' . $filenamenew;
        $fullPath = public_path('storage/' . $filenamepath);
        $scanResult = $this->scanWithTrendMicro($img);

        if ($scanResult['status'] == 'clean') {
            $filename = $img->move(public_path('storage/complaint/image' . '/' . 'img'), $filenamenew);
            // Save or move file permanently
            return response()->json(['status' => 'success', 'file' => $filenamepath]);
        } else {
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            // Delete the file and notify user
            // Storage::delete($filenamepath);
            return response()->json(['message' => 'The uploaded file contains malware!', 'status' => 'error']);
        }
    }
    public function scanWithTrendMicro($filePath)
    {
        $apiUrl = 'https://api.xdr.trendmicro.com/v3.0/sandbox/file/analyze';
        $apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJjaWQiOiIzMWYxMTdlYS05ZTU4LTRjMTEtYjUwOS0wNmIzYzk0NDg5MmMiLCJjcGlkIjoic3ZwIiwicHBpZCI6ImN1cyIsIml0IjoxNzQ4Njk0MDI2LCJldCI6MTc4MDIzMDAyNSwiaWQiOiI5MTYzZDk4Yi0yYzI4LTQwNmUtYTRkOS0zNDVkMjI5N2FmMmIiLCJ0b2tlblVzZSI6ImN1c3RvbWVyIn0.XAPXstdp97ErD2XCjJiYk2mMt5aus4mt-r65Nws-cJprHSl5xvbP1KG45tdgHUWcFDqTC85RpDAIFV38jjszkw1WAv5EO2DNL5R0sk8BMmiQMgqqCh5-12dHNfpjMs-wQOKMO8tzZyYh-RPmSIPLppeePUhHqPTaSC__zp4lVb-wuVE_lzqOoCBksoCLwEfTquNxCcZkk86EbCIqlZclbQKyUZVGgn8RlmD8KSHsH0QM2WrllRRed1AC0jiTrw9PJyJ2oPhUFnI1HoiQVm7wV9UqCwij1mAO2MA-f3Coz69vVioZVgUI8r5IM--KxI_790oRaisgVqwExI5bZLCa17kh6tOLLapZM8MFCCnKqQvpFsyMiR-5Gi8HxtP7Yu9Ft3LGUIZeAIw3P6Jg-4PQbBIRbEyEpbovsFcAbKQhZFjrYzrLxJTNK9g5DK4YiJtT9AA13VQ4uLfYnnhFn6dkBcS01kILc4f8Es70n--ja8lfjS4CVbIBU7Rhn7lpTeUh2RrrqPeR2YI5VE8J5nxBR_GjZa20WQ_A28VHyNOSrrXukMSEx0Lfo8GHeYy4aEzFtBNKjOwneBZq_YSv-iszQC8b9E1DQLBiX8Cwitu4zyPdoNhQPYDw6kBq4uFzvLx6ju6S5AzLqre_yskwdA1TuWW_AP9be5roqh90D2jOasI';

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$apiKey}",
            'Content-Type' => 'multipart/form-data',
        ])->attach(
            'file',
            file_get_contents($filePath->getRealPath()),
            basename($filePath)
        )->post($apiUrl);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('File scanning failed: ' . $response->body());
    }
    public function MobileAgentImage($image)
    {
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d') . "_." . $numb . "_." . $extension;
        $filenamepath   = 'agent/image' . '/' . 'img/' . $filenamenew;
        $filename       = $img->move(public_path('storage/agent/image' . '/' . 'img'), $filenamenew);
        return $filenamepath;
    }
    public function before($image)
    {
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d') . "_." . $numb . "_." . $extension;
        $filenamepath   = 'before/image' . '/' . 'img/' . $filenamenew;
        $filename       = $img->move(public_path('storage/before/image' . '/' . 'img'), $filenamenew);
        return $filenamepath;
    }
    public function after($image)
    {
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
        $extension      = $img->extension();
        $filenamenew    = date('Y-m-d') . "_." . $numb . "_." . $extension;
        $filenamepath   = 'after/image' . '/' . 'img/' . $filenamenew;
        $filename       = $img->move(public_path('storage/after/image' . '/' . 'img'), $filenamenew);
        return $filenamepath;
    }
}
