<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Seeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-seeder {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controller Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');

        if (!File::exists(base_path('modules/' . $module))) {
            return $this->error('Module not exists!');
        }

        $seederPath = base_path('modules/' . $module . '/seeders');

        if (!File::exists($seederPath)) {
            File::makeDirectory($seederPath, 0755, true, true);
        }

        $seederFile = app_path('Console/Commands/Templates/Seeder.txt');
        $seederContent = File::get($seederFile);
        $seederContent = str_replace('{name}', $name, $seederContent);
        $seederContent = str_replace('{module}', $module, $seederContent);

        if (!File::exists($seederPath . '/' . $name . '.php')) {
            File::put($seederPath . '/' . $name . '.php', $seederContent);

            return $this->info('Seeder created successfully!');
        }
    }
}
