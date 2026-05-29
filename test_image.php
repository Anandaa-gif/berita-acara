<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

$manager = new ImageManager(new Driver());
$image = $manager->create(1200, 400)->fill('ff0000'); // red image 1200x400

try {
    $image->pad(800, 600, 'ffffff');
    echo "pad works!\n";
} catch (\Exception $e) {
    echo "pad failed: " . $e->getMessage() . "\n";
}

try {
    $image2 = $manager->create(1200, 400)->fill('ff0000');
    $image2->contain(800, 600, 'ffffff');
    echo "contain works!\n";
} catch (\Exception $e) {
    echo "contain failed: " . $e->getMessage() . "\n";
}

