<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Migration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-migration {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Migration Module';

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

        $migrationPath = base_path('modules/' . $module . '/migrations');

        if (!File::exists($migrationPath)) {
            File::makeDirectory($migrationPath, 0755, true, true);
        }

        $migrationFile = app_path('Console/Commands/Templates/Migration.txt');
        $migrationContent = File::get($migrationFile);
        $migrationContent = str_replace('{table}', strtolower($module), $migrationContent);

        $name = Carbon::now()->format('Y_m_d_His_') . $name;

        if (!File::exists($migrationPath . '/' . $name . '.php')) {
            File::put($migrationPath . '/' . $name . '.php', $migrationContent);

            return $this->info('Migration created successfully!');
        }

      
    }
}