<?php

return [
    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    'api_key' => env('CLOUDINARY_API_KEY'),
    'api_secret' => env('CLOUDINARY_API_SECRET'),
    'secure' => true,
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),
    'folder' => env('CLOUDINARY_FOLDER'),
    'overwrite' => false,
    'resource_type' => 'image',
    'responsive_breakpoints' => [
        'create_derived' => true,
        'bytes_step' => 20000,
        'min_width' => 200,
        'max_width' => 1000
    ]
];