<?php
namespace App\Services;

use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\ImageOptimizer\Optimizers\Optipng;
use Spatie\ImageOptimizer\Optimizers\Pngquant;
use Spatie\ImageOptimizer\Optimizers\Gifsicle;
use Spatie\ImageOptimizer\Optimizers\Cwebp;
use Spatie\ImageOptimizer\Optimizers\Svgo;

class ImageOptimizerService
{
    public static function optimize(string $absolutePath): void
    {
        // اگر حجم فایل بیشتر از 1 مگابایت بود
        if (filesize($absolutePath) > 1024 * 1024) {

            $chain = OptimizerChainFactory::create();

            $chain->addOptimizer(new Jpegoptim([
                '--strip-all',         // حذف متادیتا
                '--all-progressive',   // progressive JPEG
                '--max=80',            // کیفیت 80%
            ], 'jpegoptim'));

            $chain->addOptimizer(new Pngquant([
                '--quality=65-80',     // کیفیت بین 65 تا 80
                '--speed=1'            // بهترین کیفیت فشرده‌سازی
            ], 'pngquant'));

            $chain->addOptimizer(new Optipng([
                '-i0',
                '-o2',
                '-strip', 'all'
            ], 'optipng'));

            $chain->addOptimizer(new Gifsicle([
                '-O3'                  // بیشترین سطح بهینه‌سازی
            ], 'gifsicle'));

            $chain->addOptimizer(new Cwebp([
                '-m', '6',
                '-pass', '10',
                '-q', '80'             // کیفیت 80%
            ], 'cwebp'));

            $chain->addOptimizer(new Svgo([], 'svgo'));

            // اجرای بهینه‌سازی
            $chain->optimize($absolutePath);
        }
    }
}
