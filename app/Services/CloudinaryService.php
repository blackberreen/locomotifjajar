<?php

namespace App\Services;

class CloudinaryService
{
    private $cloudName;
    private $apiKey;
    private $apiSecret;
    private $baseUrl;

    public function __construct()
    {
        $this->cloudName = env('CLOUDINARY_CLOUD_NAME');
        $this->apiKey = env('CLOUDINARY_API_KEY');
        $this->apiSecret = env('CLOUDINARY_API_SECRET');
        $this->baseUrl = "https://api.cloudinary.com/v1_1/{$this->cloudName}";
    }

    /**
     * Upload image to Cloudinary
     */
    public function uploadImage($file, $options = [])
    {
        if (!$this->isConfigured()) {
            throw new \Exception('Cloudinary configuration is incomplete');
        }

        $url = $this->baseUrl . '/image/upload';
        
        // Default options
        $defaultOptions = [
            'folder' => 'bukti_transfer',
            'use_filename' => true,
            'unique_filename' => true,
            'overwrite' => false,
            'resource_type' => 'image'
        ];

        $options = array_merge($defaultOptions, $options);
        
        // Generate timestamp
        $timestamp = time();
        
        // Prepare parameters for signature
        $params = array_merge($options, [
            'timestamp' => $timestamp
        ]);

        // Generate signature
        $signature = $this->generateSignature($params);

        // Prepare upload data
        $uploadData = [
            'file' => new \CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName()),
            'api_key' => $this->apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature
        ];

        // Add options to upload data
        foreach ($options as $key => $value) {
            $uploadData[$key] = $value;
        }

        return $this->makeRequest($url, $uploadData);
    }

    /**
     * Delete image from Cloudinary
     */
    public function deleteImage($publicId)
    {
        if (!$this->isConfigured()) {
            throw new \Exception('Cloudinary configuration is incomplete');
        }

        $url = $this->baseUrl . '/image/destroy';
        
        $timestamp = time();
        $params = [
            'public_id' => $publicId,
            'timestamp' => $timestamp
        ];

        $signature = $this->generateSignature($params);

        $uploadData = [
            'public_id' => $publicId,
            'api_key' => $this->apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature
        ];

        return $this->makeRequest($url, $uploadData);
    }

    /**
     * Generate Cloudinary signature
     */
    private function generateSignature($params)
    {
        // Remove empty values
        $params = array_filter($params, function($value) {
            return $value !== '' && $value !== null;
        });

        // Sort parameters
        ksort($params);

        // Build query string
        $queryString = '';
        foreach ($params as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $queryString .= $key . '=' . $value . '&';
        }

        // Remove trailing &
        $queryString = rtrim($queryString, '&');

        // Generate signature
        return sha1($queryString . $this->apiSecret);
    }

    /**
     * Make cURL request to Cloudinary
     */
    private function makeRequest($url, $data)
    {
        $ch = curl_init();
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);

        if ($error) {
            throw new \Exception("cURL Error: " . $error);
        }

        if ($httpCode >= 400) {
            throw new \Exception("HTTP Error {$httpCode}: " . $response);
        }

        $result = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("JSON Parse Error: " . json_last_error_msg());
        }

        if (isset($result['error'])) {
            throw new \Exception("Cloudinary Error: " . $result['error']['message']);
        }

        return $result;
    }

    /**
     * Check if Cloudinary is properly configured
     */
    private function isConfigured()
    {
        return !empty($this->cloudName) && 
               !empty($this->apiKey) && 
               !empty($this->apiSecret);
    }

    /**
     * Get configuration status
     */
    public function getConfigStatus()
    {
        return [
            'cloud_name' => !empty($this->cloudName) ? $this->cloudName : 'NOT_SET',
            'api_key' => !empty($this->apiKey) ? $this->apiKey : 'NOT_SET',
            'api_secret' => !empty($this->apiSecret) ? 'SET' : 'NOT_SET',
            'configured' => $this->isConfigured()
        ];
    }
}