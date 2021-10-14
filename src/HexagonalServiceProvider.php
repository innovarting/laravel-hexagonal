<?php

namespace Innovarting\Hexagonal;

use Illuminate\Support\ServiceProvider;
use Innovarting\Hexagonal\Console\Commands\HexagonalInstallCommand;
use Innovarting\Hexagonal\Console\Commands\MakeEntityCommand;
use Innovarting\Hexagonal\Console\Commands\MakeEntityFactoryCommand;
use Innovarting\Hexagonal\Console\Commands\MakeFactoryCommand;
use Innovarting\Hexagonal\Console\Commands\MakeInterfaceRepositoryCommand;
use Innovarting\Hexagonal\Console\Commands\MakeRepositoryCommand;
use Innovarting\Hexagonal\Console\Commands\MakeUseCaseCommand;
use Innovarting\Hexagonal\Console\Commands\MakeUseCaseHandlerCommand;

class HexagonalServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->commands([
            HexagonalInstallCommand::class,
            MakeUseCaseCommand::class,
            MakeUseCaseHandlerCommand::class,
            MakeEntityCommand::class,
            MakeFactoryCommand::class,
            MakeInterfaceRepositoryCommand::class,
            MakeRepositoryCommand::class,
        ]);
    }

    public function register(): void
    {
    }
}
