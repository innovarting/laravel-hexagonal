<?php

namespace Innovarting\Hexagonal\Generators;

use Illuminate\Support\Facades\File;

class CommandBusGenerator
{
    use CopyFiles;

    static string $APPLICATION_FOLDER = 'Application';
    static string $APPLICATION_CONTRACT_FOLDER = 'Contracts';
    static string $APPLICATION_CONTRACT_BUS_FOLDER = 'Bus';
    static string $INFRASTRUCTURE_FOLDER = 'Infrastructure';

    public function __construct(private string $nameSpaceFolder, private string $nameSpace)
    {
        $contractFolder = $this->nameSpaceFolder . '/' . self::$APPLICATION_FOLDER
            . '/' . self::$APPLICATION_CONTRACT_FOLDER;

        $this->createEntitiesFolder($contractFolder);
        $this->copyFiles(destinationFolder: $contractFolder, stubFolder: '/../stubs/Contracts');

        $busFolder = $contractFolder . '/' . self::$APPLICATION_CONTRACT_BUS_FOLDER;

        $this->createEntitiesFolder($busFolder);
        $this->copyFiles(destinationFolder: $busFolder, stubFolder: '/../stubs/Contracts/Bus');

        $infrastructureBusFolder = $this->nameSpaceFolder . '/' . self::$INFRASTRUCTURE_FOLDER
            . '/' . self::$APPLICATION_CONTRACT_BUS_FOLDER;

        $this->createEntitiesFolder($infrastructureBusFolder);
        $this->crateContainerAndCommandBusFiles($infrastructureBusFolder);
        $this->registerBindingClasses();
    }

    private function createEntitiesFolder(string $folder): void
    {
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }
    }

    private function crateContainerAndCommandBusFiles(string $infrastructureBusFolder): void
    {
        $containerFile = $this->createFile(
            $infrastructureBusFolder
            . '/' . $this->nameSpace
            . 'Container.php'
        );

        $content = file_get_contents(__DIR__ . '/../stubs/Bus/Container.stub');
        $replace = $this->nameSpace;
        $content = preg_replace('/NAMESPACE/', $replace, $content);

        File::put($containerFile, $content);

        $commandBusFile = $this->createFile(
            $infrastructureBusFolder
            . '/SimpleCommandBus.php'
        );

        $content = file_get_contents(__DIR__ . '/../stubs/Bus/SimpleCommandBus.stub');
        $replace = $this->nameSpace;
        $content = preg_replace('/NAMESPACE/', $replace, $content);

        File::put($commandBusFile, $content);
    }

    private function registerBindingClasses(): void
    {
        $appServiceProviderFile = $this->nameSpaceFolder
            . '/'
            . self::$INFRASTRUCTURE_FOLDER
            . '/Providers/AppServiceProvider.php';

        $content = file_get_contents(__DIR__ . '/../stubs/AppServiceProvider.stub');
        $replace = $this->nameSpace;
        $content = preg_replace('/NAMESPACE/', $replace, $content);

        File::put($appServiceProviderFile, $content);
    }
}
