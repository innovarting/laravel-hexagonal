<?php

namespace Innovarting\Hexagonal\Console\Commands;

class MakeRepositoryCommand extends BaseGeneratorCommand
{
    protected $signature = 'hexagonal:repository {name : Name of Interface repository}';
    protected $description = 'Create a new repository file for the entity.';

    protected $type = 'Repository';

    public function handle()
    {
        $className = $this->getNameInput() . 'Repository';
        $this->makeClass($className);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . "\Infrastructure\Eloquent\Repositories";
    }

    protected function getStub(): string
    {
        return __DIR__ . '/../../stubs/Domain/Repositories/Repository.php.stub';
    }
}
