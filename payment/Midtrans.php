<?php
/** 
 * Check PHP version.
 */
if (version_compare(PHP_VERSION, '5.4', '<')) {
    throw new Exception('PHP version >= 5.4 required');
}

// Check PHP Curl & json decode capabilities.
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
    throw new Exception('Midtrans needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Midtrans needs the JSON PHP extension.');
}

// Configurations
require_once __DIR__.'/Midtrans/Config.php';

// Midtrans API Resources
require_once __DIR__.'/Midtrans/Transaction.php';

// Plumbing
require_once __DIR__.'/Midtrans/ApiRequestor.php';
require_once __DIR__.'/Midtrans/Notification.php';
require_once __DIR__.'/Midtrans/CoreApi.php';
require_once __DIR__.'/Midtrans/Snap.php';

// Sanitization
require_once __DIR__.'/Midtrans/Sanitizer.php';
