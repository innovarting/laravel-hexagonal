<?php

namespace Innovarting\Hexagonal\Console\Commands;

use Symfony\Component\Console\Input\InputOption;

class MakeEntityCommand extends BaseGeneratorCommand
{
    protected $name = 'hexagonal:entity';
    protected $description = 'Create a new file for the entity, the entity factory, the repository interface and the repository file.';

    protected $type = 'Entity';

    public function handle()
    {
        $className = $this->getNameInput() . 'Entity';
        $this->makeClass($className);

        if ($this->option('all')) {
            $this->input->setOption('factory', true);
            $this->input->setOption('interface', true);
            $this->input->setOption('repository', true);
            $this->input->setOption('model', true);
        }

        if ($this->option('factory')) {
            $this->call('hexagonal:factory', [
                'name' => $this->getNameInput(),
            ]);
        }

        if ($this->option('interface')) {
            $this->call('hexagonal:i-repository', [
                'name' => $this->getNameInput(),
            ]);
        }

        if ($this->option('repository')) {
            $this->call('hexagonal:repository', [
                'name' => $this->getNameInput(),
            ]);
        }

        if ($this->option('model')) {
            $this->call('make:model', [
                'name' => $this->getNameInput(),
            ]);
        }
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        $domain = $this->getNameInput();
        return $rootNamespace . "\Domain\Entities\\" . $domain;
    }

    protected function getStub(): string
    {
        return __DIR__ . '/../../stubs/Domain/Entities/Entity.php.stub';
    }

    protected function getOptions(): array
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a factory, interface repository and repository for the entity'],
            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the entity'],
            ['interface', 'i', InputOption::VALUE_NONE, 'Create a new interface repository for the entity'],
            ['repository', 'r', InputOption::VALUE_NONE, 'Create a new repository for the entity'],
            ['model', 'm', InputOption::VALUE_NONE, 'Create a new model for entity'],
        ];
    }
}
