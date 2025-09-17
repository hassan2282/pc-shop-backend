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
    public static function optimize(string $absolutePath)
    {
        $chain = OptimizerChainFactory::create();

        $chain->addOptimizer(new Jpegoptim(['--strip-all','--all-progressive'], 'jpegoptim'));
        $chain->addOptimizer(new Pngquant(['--quality=65-80','--speed=1'], 'pngquant'));
        $chain->addOptimizer(new Optipng(['-i0','-o2','-strip','all'], 'optipng'));
        $chain->addOptimizer(new Gifsicle(['-O3'], 'gifsicle'));
        $chain->addOptimizer(new Cwebp(['-m 6','-pass 10','-q 80'], 'cwebp'));
        $chain->addOptimizer(new Svgo([], 'svgo'));

        $chain->optimize($absolutePath);
    }
}
