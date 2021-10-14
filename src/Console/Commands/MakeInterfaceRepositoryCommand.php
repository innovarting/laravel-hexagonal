<?php

namespace Innovarting\Hexagonal\Console\Commands;

class MakeInterfaceRepositoryCommand extends BaseGeneratorCommand
{
    protected $signature = 'hexagonal:i-repository {name : Name of Interface repository}';
    protected $description = 'Create a new interface repository file for the entity.';

    protected $type = 'Interface Repository';

    public function handle()
    {
        $className = 'I' . $this->getNameInput() . 'Repository';
        $this->makeClass($className);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        $domain = $this->getNameInput();
        return $rootNamespace . "\Domain\Repositories";
    }

    protected function getStub(): string
    {
        return __DIR__ . '/../../stubs/Domain/Repositories/IRepository.php.stub';
    }
}
