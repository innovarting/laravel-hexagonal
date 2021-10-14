<?php

namespace Innovarting\Hexagonal\Console\Commands;

class MakeFactoryCommand extends BaseGeneratorCommand
{
    protected $signature = 'hexagonal:factory {name : Name of factory}';
    protected $description = 'Create a new file factory for the entity.';

    protected $type = 'Factory';

    public function handle()
    {
        $className = $this->getNameInput() . 'Factory';
        $this->makeClass($className);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        $domain = $this->getNameInput();
        return $rootNamespace . "\Domain\Entities\\" . $domain;
    }

    protected function getStub(): string
    {
        return __DIR__ . '/../../stubs/Domain/Entities/EntityFactory.php.stub';
    }
}
