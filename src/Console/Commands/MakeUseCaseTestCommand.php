<?php

namespace Innovarting\Hexagonal\Console\Commands;

use Illuminate\Console\Command;

class MakeUseCaseTestCommand extends Command
{
    protected $signature = 'hexagonal:make:test-command  {name : Use case name.}';
    protected $description = 'Create a new test files for the given use case.';

    public function handle()
    {

    }
}
