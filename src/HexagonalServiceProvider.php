<?php

namespace Innovarting\Hexagonal;

use Illuminate\Support\ServiceProvider;
use Innovarting\Hexagonal\Console\Commands\HexagonalInstallCommand;

class HexagonalServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/hexagonal.php' => config_path('hexagonal.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/config/hexagonal.php', 'hexagonal'
        );

        $this->commands([
            HexagonalInstallCommand::class,
        ]);
    }

    public function register(): void
    {

    }
}
