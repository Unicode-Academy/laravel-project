<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Middleware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-middleware {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Middleware Module';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');

        if (!File::exists(base_path('modules/' . $module))) {
            return $this->error('Module not exists!');
        }

        $srcFolder = base_path('modules/' . $module . '/src');

        if (File::exists($srcFolder)) {

            $httpFolder = base_path('modules/' . $module . '/src/Http');

            if (File::exists($httpFolder)) {
                $middlewareFolder = base_path('modules/' . $module . '/src/Http/Middlewares');
                if (!File::exists($middlewareFolder)) {
                    File::makeDirectory($middlewareFolder, 0755, true, true);
                }

                if (File::exists($middlewareFolder)) {
                    $middlewareFile = app_path('Console/Commands/Templates/Middleware.txt');
                    $middlewareContent = File::get($middlewareFile);
                    $middlewareContent = str_replace('{module}', $module, $middlewareContent);
                    $middlewareContent = str_replace('{name}', $name, $middlewareContent);

                    if (!File::exists($middlewareFolder . '/' . $name . '.php')) {
                        File::put($middlewareFolder . '/' . $name . '.php', $middlewareContent);

                        return $this->info('Middleware created successfully!');
                    } else {
                        return $this->error('Middleware already exists!');
                    }

                }
            }

            return $this->error('Base Folder Module not exists');
        }
    }
}
