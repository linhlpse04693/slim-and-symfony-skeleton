<?php

namespace Boot\Foundation\Bootstrapers;

class LoadAliases extends Bootstraper
{
    public function boot()
    {
        $aliases = config('app.aliases');

        array_walk($aliases, function ($class, $alias) {
            class_alias($class, $alias, true);
        });
    }
}