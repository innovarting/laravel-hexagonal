<?php

namespace Innovarting\Hexagonal\Console\Commands;

class MakeUseCaseHandlerCommand extends BaseGeneratorCommand
{
    protected $signature = 'hexagonal:handler {name : Use case name.} {--d|domain= : Specify the name of the folder where the suso case will be created.}';
    protected $description = 'Create new command and handler files for the given use case.';

    protected $type = 'Handler';

    public function handle(): bool
    {
        if (!$this->option('domain')) {
            $this->error('Not enough options {missing: domain}');
            return false;
        }

        $className = $this->getNameInput() . 'Handler';
        $this->makeClass($className);

        return true;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        $domain = $this->option('domain');
        return $rootNamespace . "\Application\Services\\" . $domain;
    }

    protected function getStub(): string
    {
        return __DIR__ . '/../../stubs/UseCases/Handler.php.stub';
    }
}
