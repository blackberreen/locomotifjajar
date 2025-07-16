<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for Cloudinary API.
    | You can find your credentials at https://cloudinary.com/console
    |
    */

    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key' => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
        'secure' => env('CLOUDINARY_SECURE_URL', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Upload Configuration
    |--------------------------------------------------------------------------
    |
    | Configure default settings for uploads
    |
    */

    'upload' => [
        'folder' => env('CLOUDINARY_UPLOAD_FOLDER', 'uploads'),
        'use_filename' => true,
        'unique_filename' => true,
        'overwrite' => false,
        'resource_type' => 'auto',
        'quality' => 'auto',
        'format' => 'auto',
    ],

    /*
    |--------------------------------------------------------------------------
    | URL Configuration
    |--------------------------------------------------------------------------
    |
    | Configure URL generation settings
    |
    */

    'url' => [
        'secure' => env('CLOUDINARY_SECURE_URL', true),
        'sign_url' => false,
        'private_cdn' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Transformation Configuration
    |--------------------------------------------------------------------------
    |
    | Configure default transformation settings
    |
    */

    'transformation' => [
        'quality' => 'auto',
        'fetch_format' => 'auto',
    ],

    /*
    |--------------------------------------------------------------------------
    | Legacy Configuration (Backward Compatibility)
    |--------------------------------------------------------------------------
    |
    | These settings are for backward compatibility with older versions
    |
    */

    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    'api_key' => env('CLOUDINARY_API_KEY'),
    'api_secret' => env('CLOUDINARY_API_SECRET'),
    'secure_url' => env('CLOUDINARY_SECURE_URL', true),
    'upload_folder' => env('CLOUDINARY_UPLOAD_FOLDER', 'uploads'),

];