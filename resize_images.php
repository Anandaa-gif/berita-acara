<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

echo "Memulai kompresi gambar lama...\n";
$manager = new ImageManager(new Driver());
$files = \Illuminate\Support\Facades\Storage::disk('public')->files('dokumentasi');

$count = 0;
foreach ($files as $file) {
    if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png'])) {
        $path = storage_path('app/public/' . $file);
        try {
            $image = $manager->read($path);
            if ($image->width() > 800) {
                $image->scaleDown(width: 800);
                $image->save($path);
                $count++;
                echo "Resized: $file\n";
            }
        } catch (\Exception $e) {
            echo "Error resizing $file: " . $e->getMessage() . "\n";
        }
    }
}
echo "Total resized: $count\n";
