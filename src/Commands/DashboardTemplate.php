<?php

namespace Yasser\LaravelDashboard\Commands;

use Illuminate\Console\Command;
use  \Illuminate\Support\Facades\File;

class DashboardTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'LaravelDash:resource {name} ';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Generate a new resource';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        //

        try {
            $resource = resource_path('views/' . $this->argument('name') . '.blade.php');

            $stub = dirname(__DIR__) . '/resources/views/stubs/template.blade.php';

            if (!file_exists($resource)) {
                $content = str_replace('Template', ucfirst($this->argument('name')), file_get_contents($stub));

                File::put($resource, $content);

                $this->info("The file is created successfully");
            } else {
                $this->error('The file already exists');
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
