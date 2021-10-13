<?php

namespace Innovarting\Hexagonal\Console\Commands;

use Illuminate\Console\Command;

class MakeUseCaseCommand extends Command
{
    protected $signature = 'hexagonal:make:use-case {name : Use case name.}';
    protected $description = 'Create new command and handler files for the given use case.';

    public function handle()
    {
    }
}
