<?php
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// --- VERCEL SPECIFIC OVERRIDES ---
// Vercel serverless functions only allow writing to /tmp
$app->useStoragePath('/tmp/storage');

// Create required directories inside /tmp
$directories = [
    'app',
    'framework/views',
    'framework/cache',
    'framework/cache/data',
    'framework/sessions',
    'logs'
];
foreach ($directories as $dir) {
    if (!is_dir('/tmp/storage/' . $dir)) {
        mkdir('/tmp/storage/' . $dir, 0777, true);
    }
}
// ---------------------------------

$app->handleRequest(Request::capture());
