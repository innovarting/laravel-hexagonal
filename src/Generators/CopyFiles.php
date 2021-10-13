<?php

namespace Innovarting\Hexagonal\Generators;

use Illuminate\Support\Facades\File;

trait CopyFiles
{
    private function copyFiles(string $destinationFolder, string $stubFolder)
    {
        $allEntitiesFiles = File::files(__DIR__ . $stubFolder);

        foreach ($allEntitiesFiles as $entitiesFile) {
            $newFile = $this->createFile($destinationFolder . '/' . $entitiesFile->getFilenameWithoutExtension() . '.php');
            $this->replaceFileContent($entitiesFile, $newFile);
        }
    }

    private function createFile($newFile)
    {
        if (!file_exists($newFile)) {
            touch($newFile);
        }

        return $newFile;
    }

    private function replaceFileContent($entitiesFile, $newFile)
    {
        $content = $entitiesFile->getContents();
        $replace = $this->nameSpace;
        $content = preg_replace('/\bNAMESPACE\b/', $replace, $content);

        File::put($newFile, $content);
    }
}
