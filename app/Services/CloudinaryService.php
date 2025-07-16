<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    public function uploadImage(UploadedFile $file, array $options = [])
    {
        try {
            // Default options untuk v3.0
            $defaultOptions = [
                'folder' => 'uploads',
                'use_filename' => true,
                'unique_filename' => true,
                'overwrite' => false,
                'resource_type' => 'image',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            ];

            $options = array_merge($defaultOptions, $options);

            Log::info('Cloudinary Upload Starting', [
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'options' => $options
            ]);

            // Upload file ke Cloudinary - v3.0 syntax
            $uploadResult = Cloudinary::upload($file->getRealPath(), $options);

            Log::info('Cloudinary Upload Success', [
                'secure_url' => $uploadResult->getSecurePath(),
                'public_id' => $uploadResult->getPublicId(),
                'format' => $uploadResult->getExtension()
            ]);

            return [
                'secure_url' => $uploadResult->getSecurePath(),
                'public_id' => $uploadResult->getPublicId(),
                'url' => $uploadResult->getPath(),
                'format' => $uploadResult->getExtension(),
                'width' => $uploadResult->getWidth(),
                'height' => $uploadResult->getHeight(),
                'bytes' => $uploadResult->getSize(),
                'created_at' => $uploadResult->getTimeUploaded()
            ];

        } catch (\Exception $e) {
            Log::error('Cloudinary Upload Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            throw new \Exception('Gagal upload gambar ke Cloudinary: ' . $e->getMessage());
        }
    }

    public function deleteImage(string $publicId)
    {
        try {
            // v3.0 syntax untuk destroy
            $result = Cloudinary::destroy($publicId);
            
            Log::info('Cloudinary Delete Result', [
                'public_id' => $publicId,
                'result' => $result
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('Cloudinary Delete Error', [
                'public_id' => $publicId,
                'error' => $e->getMessage()
            ]);
            
            throw new \Exception('Gagal menghapus gambar dari Cloudinary: ' . $e->getMessage());
        }
    }

    public function getConfigStatus()
    {
        // v3.0 way to check config
        try {
            $config = config('cloudinary');
            
            $cloudName = $config['cloud_name'] ?? env('CLOUDINARY_CLOUD_NAME');
            $apiKey = $config['api_key'] ?? env('CLOUDINARY_API_KEY');
            $apiSecret = $config['api_secret'] ?? env('CLOUDINARY_API_SECRET');

            return [
                'configured' => !empty($cloudName) && !empty($apiKey) && !empty($apiSecret),
                'cloud_name' => !empty($cloudName),
                'api_key' => !empty($apiKey),
                'api_secret' => !empty($apiSecret),
                'package_version' => '3.0',
                'values' => [
                    'cloud_name' => $cloudName,
                    'api_key' => $apiKey,
                    'api_secret' => $apiSecret ? '***' : null
                ]
            ];
        } catch (\Exception $e) {
            Log::error('Cloudinary Config Check Error', [
                'error' => $e->getMessage()
            ]);

            return [
                'configured' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function generateTransformationUrl(string $publicId, array $transformations = [])
    {
        try {
            // v3.0 syntax untuk generate URL dengan transformasi
            return Cloudinary::getUrl($publicId, $transformations);
        } catch (\Exception $e) {
            Log::error('Cloudinary Transformation Error', [
                'public_id' => $publicId,
                'transformations' => $transformations,
                'error' => $e->getMessage()
            ]);
            
            return null;
        }
    }

    public function uploadBase64(string $base64Data, array $options = [])
    {
        try {
            $defaultOptions = [
                'folder' => 'uploads',
                'unique_filename' => true,
                'overwrite' => false,
                'resource_type' => 'image'
            ];

            $options = array_merge($defaultOptions, $options);

            $uploadResult = Cloudinary::upload($base64Data, $options);

            return [
                'secure_url' => $uploadResult->getSecurePath(),
                'public_id' => $uploadResult->getPublicId(),
                'url' => $uploadResult->getPath(),
                'format' => $uploadResult->getExtension(),
                'width' => $uploadResult->getWidth(),
                'height' => $uploadResult->getHeight(),
                'bytes' => $uploadResult->getSize()
            ];

        } catch (\Exception $e) {
            Log::error('Cloudinary Base64 Upload Error', [
                'error' => $e->getMessage()
            ]);

            throw new \Exception('Gagal upload base64 ke Cloudinary: ' . $e->getMessage());
        }
    }
}