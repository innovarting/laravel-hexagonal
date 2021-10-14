<?php

namespace Innovarting\Hexagonal\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class BaseGeneratorCommand extends GeneratorCommand
{
    /**
     * @throws FileNotFoundException
     */
    protected function makeClass(string $className)
    {
        if ($this->isReservedName($className)) {
            $this->error('The name "' . $className . '" is reserved by PHP.');

            return false;
        }

        $name = $this->qualifyClass($className);

        $path = $this->getPath($name);
        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($className)) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->sortImports($this->buildClass($name)));
        $this->info($this->type . ' created successfully.');
    }

    protected function getStub()
    {
    }

    protected function replaceNamespace(&$stub, $name): MakeFactoryCommand|static
    {
        $searches = [
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            ['{{ namespace }}', '{{ rootNamespace }}', '{{ namespacedUserModel }}', '{{ name }}'],
            ['{{namespace}}', '{{rootNamespace}}', '{{namespacedUserModel}}', '{{name}}'],
        ];

        foreach ($searches as $search) {
            $stub = str_replace(
                $search,
                [
                    $this->getNamespace($name),
                    $this->rootNamespace(),
                    $this->userProviderModel(),
                    $this->getNameInput(),
                ],
                $stub
            );
        }

        return $this;
    }
}
