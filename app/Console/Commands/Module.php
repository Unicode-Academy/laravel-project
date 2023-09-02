<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        if (File::exists(base_path('modules/' . $name))) {
            $this->error('Module already exists!');
        } else {
            File::makeDirectory(base_path('modules/' . $name), 0755, true, true);

            //config
            $configFolder = base_path('modules/' . $name . '/configs');

            if (!File::exists($configFolder)) {
                File::makeDirectory($configFolder, 0755, true, true);
            }

            //helper
            $helperFolder = base_path('modules/' . $name . '/helpers');

            if (!File::exists($helperFolder)) {
                File::makeDirectory($helperFolder, 0755, true, true);
            }

            //migrations
            $migrationFolder = base_path('modules/' . $name . '/migrations');

            if (!File::exists($migrationFolder)) {
                File::makeDirectory($migrationFolder, 0755, true, true);
            }

            //resources
            $resourcesFolder = base_path('modules/' . $name . '/resources');

            if (!File::exists($resourcesFolder)) {
                File::makeDirectory($resourcesFolder, 0755, true, true);

                //language
                $languageFolder = base_path('modules/' . $name . '/resources/lang');

                if (!File::exists($languageFolder)) {
                    File::makeDirectory($languageFolder, 0755, true, true);
                }

                //views
                $viewsFolder = base_path('modules/' . $name . '/resources/views');

                if (!File::exists($viewsFolder)) {
                    File::makeDirectory($viewsFolder, 0755, true, true);
                }
            }

            //routes
            $routesFolder = base_path('modules/' . $name . '/routes');

            if (!File::exists($routesFolder)) {
                File::makeDirectory($routesFolder, 0755, true, true);

                //Tạo file web.php
                $routesWebFile = base_path('modules/' . $name . '/routes/web.php');

                //Tạo file api.php
                $routesApiFile = base_path('modules/' . $name . '/routes/api.php');

                $routeContent = File::get(app_path('Console/Commands/Templates/Route.txt'));
                $routeContent = str_replace('{module}', strtolower($name), $routeContent);

                if (!File::exists($routesWebFile)) {
                    File::put($routesWebFile, $routeContent);
                }

                if (!File::exists($routesApiFile)) {
                    File::put($routesApiFile, $routeContent);
                }
            }

            //src
            $srcFolder = base_path('modules/' . $name . '/src');

            if (!File::exists($srcFolder)) {
                File::makeDirectory($srcFolder, 0755, true, true);

                //Commands
                $commandsFolder = base_path('modules/' . $name . '/src/Commands');

                if (!File::exists($commandsFolder)) {
                    File::makeDirectory($commandsFolder, 0755, true, true);
                }

                //Http
                $httpFolder = base_path('modules/' . $name . '/src/Http');

                if (!File::exists($httpFolder)) {
                    File::makeDirectory($httpFolder, 0755, true, true);

                    //Controllers
                    $controllersFolder = base_path('modules/' . $name . '/src/Http/Controllers');

                    if (!File::exists($controllersFolder)) {
                        File::makeDirectory($controllersFolder, 0755, true, true);
                    }

                    //Middlewares
                    $middlewaresFolder = base_path('modules/' . $name . '/src/Http/Middlewares');

                    if (!File::exists($middlewaresFolder)) {
                        File::makeDirectory($middlewaresFolder, 0755, true, true);
                    }
                }

                //Models
                $modelsFolder = base_path('modules/' . $name . '/src/Models');

                if (!File::exists($modelsFolder)) {
                    File::makeDirectory($modelsFolder, 0755, true, true);
                }

                //Repositories
                $repositoriesFolder = base_path('modules/' . $name . '/src/Repositories');

                if (!File::exists($repositoriesFolder)) {
                    File::makeDirectory($repositoriesFolder, 0755, true, true);

                    //Module Repository
                    $moduleRepositoryFile = base_path('modules/' . $name . '/src/Repositories/' . $name . 'Repository.php');

                    if (!File::exists($moduleRepositoryFile)) {
                        $moduleRepositoryFileContent = file_get_contents(app_path('Console/Commands/Templates/ModuleRepository.txt'));

                        $moduleRepositoryFileContent = str_replace('{module}', $name, $moduleRepositoryFileContent);

                        File::put($moduleRepositoryFile, $moduleRepositoryFileContent);
                    }

                    //Module Repository Interface
                    $moduleRepositoryInterfaceFile = base_path('modules/' . $name . '/src/Repositories/' . $name . 'RepositoryInterface.php');

                    if (!File::exists($moduleRepositoryInterfaceFile)) {
                        $moduleRepositoryInterfaceFileContent = file_get_contents(app_path('Console/Commands/Templates/ModuleRepositoryInterface.txt'));

                        $moduleRepositoryInterfaceFileContent = str_replace('{module}', $name, $moduleRepositoryInterfaceFileContent);

                        File::put($moduleRepositoryInterfaceFile, $moduleRepositoryInterfaceFileContent);
                    }
                }
            }

            $this->info('Module created successfully!');
        }
    }
}
