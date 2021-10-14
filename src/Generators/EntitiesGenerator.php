<?php

namespace Innovarting\Hexagonal\Generators;

use Illuminate\Support\Facades\File;

class EntitiesGenerator
{
    use CopyFiles;

    public static string $DOMAIN_FOLDER = 'Domain';
    public static string $DOMAIN_ENTITIES_FOLDER = 'Entities';
    public static string $DOMAIN_ENTITIES_TRAITS_FOLDER = 'Traits';
    public static string $DOMAIN_ENTITIES_CONTRACTS = 'Contracts';

    public function __construct(private string $nameSpaceFolder, private string $nameSpace)
    {

        $this->createEntitiesFolder(
            $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_FOLDER
        );

        $this->createEntitiesFolder(
            $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_FOLDER . '/'
            . self::$DOMAIN_ENTITIES_TRAITS_FOLDER
        );

        $this->createEntitiesFolder(
            $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_CONTRACTS
        );

        $this->copyFiles(
            destinationFolder: $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_FOLDER . '/' . self::$DOMAIN_ENTITIES_TRAITS_FOLDER,
            stubFolder: '/../stubs/Entities/Traits');

        $this->copyFiles(
            destinationFolder: $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_FOLDER,
            stubFolder: '/../stubs/Entities');

        $this->copyFiles(
            destinationFolder: $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_CONTRACTS,
            stubFolder: '/../stubs/EntityContracts');

    }

    private function createEntitiesFolder(string $folder): void
    {
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }
    }
}
