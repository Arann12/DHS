<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$row = DB::table('homepage_sections')->where('section_key', 'vision')->first();
if ($row) {
    echo "section_content raw: " . $row->section_content . "\n\n";
    echo "decoded: ";
    print_r(json_decode($row->section_content, true));
} else {
    echo "No vision section found\n";
}

// Also list all section_keys
echo "\n\nAll sections:\n";
$all = DB::table('homepage_sections')->select('section_key', 'section_title')->get();
foreach ($all as $s) {
    echo "  - {$s->section_key}: {$s->section_title}\n";
}
