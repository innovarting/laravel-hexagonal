<?php

namespace Innovarting\Hexagonal\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Innovarting\Hexagonal\Generators\EntitiesGenerator;

class HexagonalInstallCommand extends Command
{
    static $APPLICATION_FOLDER = 'Application';
    static $DOMAIN_FOLDER = 'Domain';
    static $INFRASTRUCTURE_FOLDER = 'Infrastructure';


    protected $signature = 'hexagonal:install';

    protected $description = 'Install all folders architecture and move app content to new namespace';
    private $nameSpaceFolder;

    public function __construct()
    {
        parent::__construct();
        $this->nameSpaceFolder = config('hexagonal.namespace_folder');
    }

    public function handle()
    {
        $nameSpace = config('hexagonal.namespace');

        $appOriginalPath = base_path('config/app.php');
        $content = file_get_contents($appOriginalPath);
        $search = '/\bApp\b\\\\/';
        $replace = config('hexagonal.namespace') . '\\' . self::$INFRASTRUCTURE_FOLDER . '\\';
        $content = preg_replace($search, $replace, $content);

        File::put($appOriginalPath, $content);

        if ($this->nameSpaceFolder) {
            if (!file_exists(base_path($this->nameSpaceFolder))) {
                $this->info('Create Namespace folder into: ' . base_path());
                File::makeDirectory(base_path($this->nameSpaceFolder));
            }

            $this->info("Creating Application folder structure");
            $this->createFolder(self::$APPLICATION_FOLDER);
            $this->info("Finished");

            $this->info("Creating Domain folder structure");
            $this->createFolder(self::$DOMAIN_FOLDER);
            $this->info("Finished");

            $this->info("Creating Infrastructure folder structure");
            $this->createFolder(self::$INFRASTRUCTURE_FOLDER);
            $this->info("Finished");

            $this->info("Creating Application files structure");
            $this->crateApplicationFile();
            $this->info("Finished");

            $this->info("Coping App Folders to new NameSpace files structure");
            $this->copyAppFolderToNameSpace();
            $this->info("Finished");

            $this->info("Copy Commands for artisan laravel commands");
            $this->copyApplicationCommands();
            $this->info("Finished");

            $this->info("Copy app stub file");
            $this->editAppFile();
            $this->editComposerFile($nameSpace);
            $this->info("Finished");

            $this->info('Create domain entities structure...');
            new EntitiesGenerator($this->nameSpaceFolder);
            $this->info("Finished");

            exec('composer dump-autoload', $output);
        }
    }

    private function copyAppFolderToNameSpace()
    {
        if (!Str::contains(app_path(), $this->nameSpaceFolder)) {
            File::copyDirectory(app_path(), $this->nameSpaceFolder . '/' . self::$INFRASTRUCTURE_FOLDER);

            $allFiles = File::allFiles($this->nameSpaceFolder . '/' . self::$INFRASTRUCTURE_FOLDER);
            $files = count($allFiles);

            $bar = $this->output->createProgressBar($files);
            $bar->setFormat("<fg=yellow>%message%</>\n %current%/%max% [%bar%] %percent%%");
            $bar->setMessage('Start Copy Folders into namespace');
            $bar->start();

            foreach ($allFiles as $file) {
                $bar->setMessage("Editing: " . $file->getFilename());
                // File::copyDirectory($directory, $this->nameSpaceFolder . '/' . self::$INFRASTRUCTURE_FOLDER);
                $content = $file->getContents();

                $replace = config('hexagonal.namespace') . '\\' . self::$INFRASTRUCTURE_FOLDER;
                $content = preg_replace('/\bApp\b/', $replace, $content);
                File::put($file, $content);
                $bar->advance();
            }

            $bar->finish();
        }
    }

    private function createFolder($folder): void
    {
        $newFolder = base_path($this->nameSpaceFolder . '/' . $folder);
        if (!file_exists($newFolder)) {
            File::makeDirectory($newFolder);
        }
    }

    private function crateApplicationFile(): void
    {
        $applicationFile = base_path('/' . $this->nameSpaceFolder . '/' . '/Application.php');
        $stubApplicationFile = __DIR__ . '/../../stubs/Application.stub';

        if (!file_exists($applicationFile)) {
            $content = file_get_contents($stubApplicationFile);
            $search = " /\{NAMESPACE\}.*/";
            $replace = config('hexagonal.namespace') . ';';
            $content = preg_replace($search, $replace, $content);
            File::put($applicationFile, $content);
        }
    }

    private function editAppFile(): void
    {
        $appOriginalPath = base_path('bootstrap/app.php');
        $stubAppFile = __DIR__ . '/../../stubs/app.stub';
        $content = file_get_contents($stubAppFile);
        $search = "/NAMESPACE/";
        $replace = config('hexagonal.namespace');
        $content = preg_replace($search, $replace, $content);

        File::put($appOriginalPath, $content);
    }

    private function editComposerFile($nameSpace): void
    {
        $file = base_path('composer.json');
        $data = json_decode(file_get_contents($file), true);
        if (!isset($data["autoload"]["psr-4"]["$nameSpace\\"])) {
            $data["autoload"]["psr-4"]["$nameSpace\\"] = $this->nameSpaceFolder . '/';
            unset($data["autoload"]["psr-4"]["App\\"]);

            file_put_contents($file, json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }

        File::deleteDirectory(base_path('app'));
    }

    private function copyApplicationCommands(): void
    {
        $destination = $this->nameSpaceFolder . '/' . self::$INFRASTRUCTURE_FOLDER . '/Console';
        $allCommandFiles = File::allFiles(__DIR__ . '/../../stubs/ApplicationCommands');

        if (!file_exists($destination . '/Commands/')) {
            File::makeDirectory($destination . '/Commands/');
        }

        if (!file_exists($destination . '/Commands/ApplicationCommands')) {
            File::makeDirectory($destination . '/Commands/ApplicationCommands');
        }


        foreach ($allCommandFiles as $commandFile) {
            $newFile = $destination . '/Commands/ApplicationCommands/' . $commandFile->getFilenameWithoutExtension() . '.php';
            if (!file_exists($newFile)) {
                touch($newFile);
            }

            $content = $commandFile->getContents();
            $replace = config('hexagonal.namespace');
            $content = preg_replace('/\bNAMESPACE\b/', $replace, $content);
            File::put($newFile, $content);
        }
    }
}
