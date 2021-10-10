<?php

namespace Innovarting\Hexagonal;

use Illuminate\Support\ServiceProvider;
use Innovarting\Hexagonal\Console\Commands\HexagonalInstallCommand;

class HexagonalServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            HexagonalInstallCommand::class,
        ]);
    }

    public function register(): void
    {

    }
}
