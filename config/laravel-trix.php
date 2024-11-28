<?php

return [
    'storage_disk' => env('LARAVEL_TRIX_STORAGE_DISK', 'public'),

    'store_attachment_action' => App\Http\Controllers\Ajax\TrixAttachmentController::class . '@store',

    'destroy_attachment_action' => App\Http\Controllers\Ajax\TrixAttachmentController::class . '@destroy',
];
