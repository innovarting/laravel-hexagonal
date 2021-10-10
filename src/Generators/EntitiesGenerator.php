<?php

namespace Innovarting\Hexagonal\Generators;

use Illuminate\Support\Facades\File;

class EntitiesGenerator
{
    public static string $DOMAIN_FOLDER = 'Domain';
    public static string $DOMAIN_ENTITIES_FOLDER = 'Entities';
    public static string $DOMAIN_ENTITIES_TRAITS_FOLDER = 'Traits';

    public function __construct(private string $nameSpaceFolder)
    {

        $this->createEntitiesFolder(
            $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_FOLDER
        );

        $this->createEntitiesFolder(
            $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_FOLDER . '/'
            . self::$DOMAIN_ENTITIES_TRAITS_FOLDER
        );

        $this->copyEntityFiles(
            destinationFolder: $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_FOLDER . '/' . self::$DOMAIN_ENTITIES_TRAITS_FOLDER,
            stubFolder: '/../stubs/Entities/Traits');

        $this->copyEntityFiles(
            destinationFolder: $this->nameSpaceFolder . '/' . self::$DOMAIN_FOLDER . '/' . self::$DOMAIN_ENTITIES_FOLDER,
            stubFolder: '/../stubs/Entities');

    }

    private function copyEntityFiles(string $destinationFolder, string $stubFolder)
    {

        $allEntitiesFiles = File::files(__DIR__ . $stubFolder);

        foreach ($allEntitiesFiles as $entitiesFile) {
            $newFile = $destinationFolder . '/' . $entitiesFile->getFilenameWithoutExtension() . '.php';
            if (!file_exists($newFile)) {
                touch($newFile);
            }

            $content = $entitiesFile->getContents();
            $replace = config('hexagonal.namespace');
            $content = preg_replace('/\bNAMESPACE\b/', $replace, $content);
            File::put($newFile, $content);
        }
    }

    private function createEntitiesFolder(string $folder): void
    {
        if (!file_exists($folder)) {
            File::makeDirectory($folder);
        }
    }
}
