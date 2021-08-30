<?php

namespace Boot\Foundation;

use Boot\Foundation\Bootstrapers\Bootstraper;
use Slim\App;

abstract class Kernel
{
    protected App $app;

    protected array $bootstrap = [];

    public function __construct(App &$app)
    {
        $this->app = $app;

        $this->app->getContainer()->set(self::class, $this);

        Bootstraper::setup($this->app, $this->bootstrap);
    }

    public function getApplication(): App
    {
        return $this->app;
    }

    public static function bootstrap(App &$app): Kernel
    {
        return new static($app);
    }
}