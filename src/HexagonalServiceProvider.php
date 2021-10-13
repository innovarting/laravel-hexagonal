<?php

namespace Innovarting\Hexagonal;

use Illuminate\Support\ServiceProvider;
use Innovarting\Hexagonal\Console\Commands\HexagonalInstallCommand;
use Innovarting\Hexagonal\Console\Commands\MakeEntityCommand;
use Innovarting\Hexagonal\Console\Commands\MakeUseCaseCommand;
use Innovarting\Hexagonal\Console\Commands\MakeUseCaseTestCommand;

class HexagonalServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            HexagonalInstallCommand::class,
            MakeUseCaseCommand::class,
            MakeUseCaseTestCommand::class,
            MakeEntityCommand::class,
        ]);
    }

    public function register(): void
    {
    }
}
