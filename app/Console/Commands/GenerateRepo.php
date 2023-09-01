<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:create-repo {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Repo Class under Repository folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $className = $this->argument('name');

        $content = <<<EOD
        <?php

        namespace App\Repositories;

        class $className
        {
            public function __construct()
            {
                // 
            }

            public function myFunction()
            {
                //
            }
        }

        EOD;

        $folderName = 'Repositories';

        if(!file_exists($folderName)) {
            mkdir($folderName, 0755, true);
        }

        $fileName = app_path("Repositories/$className.php");
        $createFile = file_put_contents($fileName, $content);
        ($createFile) ? $this->info("Successfully Created $className") : $this->error("Failed to Create $className");
    }
}
