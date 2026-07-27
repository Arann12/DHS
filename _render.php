<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/', 'GET');
$response = $kernel->handle($request);
$html = $response->getContent();

// Find vision section
$start = strpos($html, 'Visionary Standards');
if ($start === false) $start = strpos($html, 'Standar Visioner');
$section = substr($html, max(0, $start - 100), 1000);
echo $section . "\n\n---\n";

// Check for "undefined"
if (strpos($html, 'undefined') !== false) {
    echo "FOUND 'undefined' in response!\n";
    // find context
    $pos = strpos($html, 'undefined');
    echo substr($html, max(0, $pos - 200), 500) . "\n";
} else {
    echo "No 'undefined' found in response.\n";
}
