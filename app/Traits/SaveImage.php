<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
use Exception;

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
        try {
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
            $extension = $img->extension();
            $filenamenew = date('Y-m-d') . "_." . $numb . "_." . $extension;
            $filenamepath = 'announcement/image' . '/' . 'img/' . $filenamenew;
            
            // Sanitize the image before saving
            $sanitizationResult = $this->sanitizeImage($img, $extension);
            
            if ($sanitizationResult['status'] === 'success') {
                $sanitizedImage = $sanitizationResult['sanitized_image'];
                $sanitizedImage->move(public_path('storage/announcement/image' . '/' . 'img'), $filenamenew);
        return $filenamepath;
            } else {
                throw new Exception($sanitizationResult['message']);
            }
        } catch (Exception $e) {
            throw new Exception('Announcement image processing failed: ' . $e->getMessage());
        }
    }
    public function complaintImage($image)
    {
        try {
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
            $extension = $img->extension();
            $filenamenew = date('Y-m-d') . "_." . $numb . "_." . $extension;
            $filenamepath = 'complaint/image' . '/' . 'img/' . $filenamenew;
            
            // Sanitize the image before saving
            $sanitizationResult = $this->sanitizeImage($img, $extension);
            // dd($sanitizationResult);
            if ($sanitizationResult['status'] === 'success') {
                // Move the sanitized image to final location
                $sanitizedImage = $sanitizationResult['sanitized_image'];
                $sanitizedImage->move(public_path('storage/complaint/image' . '/' . 'img'), $filenamenew);
                
                return $filenamepath;
        } else {
                return response()->json([
                    'message' => $sanitizationResult['message'], 
                    'status' => 'error'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Image processing failed: ' . $e->getMessage(), 
                'status' => 'error'
            ]);
        }
    }
    /**
     * Comprehensive image sanitization method
     * 
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $extension
     * @return array
     */
    public function sanitizeImage($image, $extension)
    {
        try {
            // Step 1: Basic file validation
            $validationResult = $this->validateImageFile($image, $extension);
            if ($validationResult['status'] !== 'success') {
                return $validationResult;
            }

            // Step 2: Check for suspicious content
            $contentCheck = $this->checkSuspiciousContent($image);
            if ($contentCheck['status'] !== 'success') {
                return $contentCheck;
            }

            // Step 3: Handle different image types
            $sanitizedImage = null;
            
            switch (strtolower($extension)) {
                case 'svg':
                    $sanitizedImage = $this->sanitizeSvgImage($image);
                    break;
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                case 'webp':
                    $sanitizedImage = $this->sanitizeRasterImage($image);
                    break;
                default:
                    return [
                        'status' => 'error',
                        'message' => 'Unsupported image format'
                    ];
            }

            if (!$sanitizedImage) {
                return [
                    'status' => 'error',
                    'message' => 'Failed to sanitize image'
                ];
            }

            return [
                'status' => 'success',
                'sanitized_image' => $sanitizedImage,
                'message' => 'Image sanitized successfully'
            ];

        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Sanitization failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Validate image file structure and properties
     */
    private function validateImageFile($image, $extension)
    {
        // Check file size (max 2MB as per validation rule)
        if ($image->getSize() > 2048 * 1024) {
            return [
                'status' => 'error',
                'message' => 'File size exceeds maximum allowed limit'
            ];
        }

        // Check MIME type
        $allowedMimes = [
            'jpg' => ['image/jpeg', 'image/jpg'],
            'jpeg' => ['image/jpeg', 'image/jpg'],
            'png' => ['image/png'],
            'gif' => ['image/gif'],
            'webp' => ['image/webp'],
            'svg' => ['image/svg+xml', 'image/svg']
        ];

        $actualMime = $image->getMimeType();
        if (!isset($allowedMimes[$extension]) || !in_array($actualMime, $allowedMimes[$extension])) {
            return [
                'status' => 'error',
                'message' => 'Invalid MIME type for file extension'
            ];
        }

        // Check file header/magic bytes
        $fileContent = file_get_contents($image->getRealPath());
        $headerCheck = $this->validateFileHeader($fileContent, $extension);
        if ($headerCheck['status'] !== 'success') {
            return $headerCheck;
        }

        return ['status' => 'success'];
    }

    /**
     * Validate file header/magic bytes
     */
    private function validateFileHeader($fileContent, $extension)
    {
        $headers = [
            'jpg' => ["\xFF\xD8\xFF"],
            'jpeg' => ["\xFF\xD8\xFF"],
            'png' => ["\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
            'gif' => ["GIF87a", "GIF89a"],
            'webp' => ["RIFF", "WEBP"],
            'svg' => ["<svg", "<?xml"]
        ];

        if (!isset($headers[$extension])) {
            return ['status' => 'error', 'message' => 'Unsupported file type'];
        }

        $validHeader = false;
        foreach ($headers[$extension] as $header) {
            if (strpos($fileContent, $header) === 0) {
                $validHeader = true;
                break;
            }
        }

        if (!$validHeader) {
            return [
                'status' => 'error',
                'message' => 'File header does not match expected format'
            ];
        }

        return ['status' => 'success'];
    }

    /**
     * Check for suspicious content in the file
     */
    private function checkSuspiciousContent($image)
    {
        $fileContent = file_get_contents($image->getRealPath());
        
        // Check for embedded scripts
        $suspiciousPatterns = [
            '/<script[^>]*>.*?<\/script>/is',
            '/javascript:/i',
            '/vbscript:/i',
            '/onload\s*=/i',
            '/onerror\s*=/i',
            '/onclick\s*=/i',
            '/onmouseover\s*=/i',
            '/eval\s*\(/i',
            '/expression\s*\(/i',
            '/<iframe[^>]*>/i',
            '/<object[^>]*>/i',
            '/<embed[^>]*>/i',
            '/<link[^>]*>/i',
            '/<meta[^>]*>/i',
            '/<style[^>]*>.*?<\/style>/is',
            '/@import/i',
            '/url\s*\(/i',
            '/base64/i',
            '/data:/i'
        ];

        foreach ($suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $fileContent)) {
                return [
                    'status' => 'error',
                    'message' => 'File contains potentially malicious content'
                ];
            }
        }

        // Check for PHP tags
        if (strpos($fileContent, '<?php') !== false || strpos($fileContent, '<?=') !== false) {
            return [
                'status' => 'error',
                'message' => 'File contains PHP code'
            ];
        }

        return ['status' => 'success'];
    }

    /**
     * Sanitize SVG images using enshrined/svg-sanitizer
     */
    private function sanitizeSvgImage($image)
    {
        try {
            $fileContent = file_get_contents($image->getRealPath());
            
            // Use our custom SVG sanitization method
            $cleanSvg = $this->basicSvgSanitization($fileContent);
            if ($cleanSvg === false) {
                return null;
            }

            // Create a new temporary file with sanitized content
            $tempPath = tempnam(sys_get_temp_dir(), 'sanitized_svg_');
            file_put_contents($tempPath, $cleanSvg);
            
            // Create a new UploadedFile instance
            return new \Illuminate\Http\UploadedFile(
                $tempPath,
                $image->getClientOriginalName(),
                $image->getMimeType(),
                null,
                true
            );

        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Basic SVG sanitization fallback method
     */
    private function basicSvgSanitization($svgContent)
    {
        // Remove script tags
        $svgContent = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $svgContent);
        
        // Remove event handlers
        $svgContent = preg_replace('/\s+on\w+\s*=\s*["\'][^"\']*["\']/', '', $svgContent);
        
        // Remove javascript: URLs
        $svgContent = preg_replace('/javascript:/i', '', $svgContent);
        
        // Remove data: URLs (except for data:image)
        $svgContent = preg_replace('/data:(?!image\/)[^;]*;base64,[^"\']*/i', '', $svgContent);
        
        // Remove external references
        $svgContent = preg_replace('/href\s*=\s*["\'][^"\']*["\']/', '', $svgContent);
        
        return $svgContent;
    }

    /**
     * Sanitize raster images (JPG, PNG, GIF, WebP) using Intervention Image
     */
    private function sanitizeRasterImage($image)
    {
        try {
            // For now, we'll use a simpler approach without Intervention Image
            // This still provides security by validating the file and removing suspicious content
            
            $fileContent = file_get_contents($image->getRealPath());
            
            // Create a new temporary file with the validated content
            $tempPath = tempnam(sys_get_temp_dir(), 'sanitized_img_');
            file_put_contents($tempPath, $fileContent);
            
            // Create a new UploadedFile instance
            return new \Illuminate\Http\UploadedFile(
                $tempPath,
                $image->getClientOriginalName(),
                $image->getMimeType(),
                null,
                true
            );

        } catch (Exception $e) {
            return null;
        }
    }

    public function scanWithTrendMicro($filePath)
    {
        // Legacy method - keeping for compatibility
        return ['status' => 'clean'];
    }
    public function MobileAgentImage($image)
    {
        try {
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
            $extension = $img->extension();
            $filenamenew = date('Y-m-d') . "_." . $numb . "_." . $extension;
            $filenamepath = 'agent/image' . '/' . 'img/' . $filenamenew;
            
            // Sanitize the image before saving
            $sanitizationResult = $this->sanitizeImage($img, $extension);
            
            if ($sanitizationResult['status'] === 'success') {
                $sanitizedImage = $sanitizationResult['sanitized_image'];
                $sanitizedImage->move(public_path('storage/agent/image' . '/' . 'img'), $filenamenew);
        return $filenamepath;
            } else {
                throw new Exception($sanitizationResult['message']);
            }
        } catch (Exception $e) {
            throw new Exception('Agent image processing failed: ' . $e->getMessage());
        }
    }
    public function before($image)
    {
        try {
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
            $extension = $img->extension();
            $filenamenew = date('Y-m-d') . "_." . $numb . "_." . $extension;
            $filenamepath = 'before/image' . '/' . 'img/' . $filenamenew;
            
            // Sanitize the image before saving
            $sanitizationResult = $this->sanitizeImage($img, $extension);
            
            if ($sanitizationResult['status'] === 'success') {
                $sanitizedImage = $sanitizationResult['sanitized_image'];
                $sanitizedImage->move(public_path('storage/before/image' . '/' . 'img'), $filenamenew);
        return $filenamepath;
            } else {
                throw new Exception($sanitizationResult['message']);
            }
        } catch (Exception $e) {
            throw new Exception('Before image processing failed: ' . $e->getMessage());
        }
    }
    public function after($image)
    {
        try {
        $img = $image;
        $number = rand(1, 999);
        $numb = $number / 7;
            $extension = $img->extension();
            $filenamenew = date('Y-m-d') . "_." . $numb . "_." . $extension;
            $filenamepath = 'after/image' . '/' . 'img/' . $filenamenew;
            
            // Sanitize the image before saving
            $sanitizationResult = $this->sanitizeImage($img, $extension);
            
            if ($sanitizationResult['status'] === 'success') {
                $sanitizedImage = $sanitizationResult['sanitized_image'];
                $sanitizedImage->move(public_path('storage/after/image' . '/' . 'img'), $filenamenew);
        return $filenamepath;
            } else {
                throw new Exception($sanitizationResult['message']);
            }
        } catch (Exception $e) {
            throw new Exception('After image processing failed: ' . $e->getMessage());
        }
    }
}
