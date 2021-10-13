<?php

namespace Innovarting\Hexagonal\Console\Commands;

use Illuminate\Console\Command;

class MakeEntityCommand extends Command
{
    protected $signature = 'make:entity {name : Name of entity}';
    protected $description = 'Create a new file for the entity, the entity factory, the repository interface and the repository file.';

    public function handle()
    {

    }
}
