<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Model extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-model {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Model Module';

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

            $modelFolder = base_path('modules/' . $module . '/src/Models');
            if (!File::exists($modelFolder)) {
                File::makeDirectory($modelFolder, 0755, true, true);
            }

            if (File::exists($modelFolder)) {
                $modelFile = app_path('Console/Commands/Templates/Model.txt');
                $modelContent = File::get($modelFile);
                $modelContent = str_replace('{module}', $module, $modelContent);
                $modelContent = str_replace('{name}', $name, $modelContent);

                if (!File::exists($modelFolder . '/' . $name . '.php')) {
                    File::put($modelFolder . '/' . $name . '.php', $modelContent);

                    return $this->info('Model created successfully!');
                } else {
                    return $this->error('Model already exists!');
                }

            }
        }
        return $this->error('Base Folder Module not exists');
    }
}
