<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Seeding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:db-seed {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database Seeding Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');
        $namespace = "Modules\\{$module}\\seeders\\{$name}";
        $this->call("db:seed", [
            'class' => $namespace,
        ]);
    }
}