<?php

namespace Boot\Foundation\Bootstrappers;

use App\Http\HttpKernel;
use Boot\Foundation\Kernel;
use App\Console\ConsoleKernel;

class LoadEnvironmentDetector extends Bootstrapper
{
    public function boot()
    {
        $this->app->bind(Kernel::class, fn () => $this->kernel);
    }
}
