<?php

namespace Petehouston\Xin;

use File;
use Illuminate\Console\Command;

class XinMakeViewCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'xin:view {blade : the Blade file path. Example: admin.auth.login}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create empty Blade view file.';

    /**
     * Create a new command instance.
     *
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
        $blade = $this->argument('blade');
        if(!$blade) {
            $this->error('Please specify Blade view to create.');
        } else {
            $this->makeView($blade);
        }
    }

    /**
     * Create view file
     *
     * @param  string $path
     * @return void
     */
    protected function makeView($path)
    {
        // convert from blade path to file path
        $finalPath = $this->normalizePath($path);

        // if file already existed
        if(File::exists($finalPath)) {
            $this->error("File {$finalPath} is already existed.");
            return;
        }

        // create directory if not existed
        $directory = dirname($finalPath);
        if(! file_exists($directory)) {
            $result = File::makeDirectory($directory, 0777, true);
            if(! $result) {
                $this->error("Cannot create directory {$finalPath}");
                return;
            }
        }

        // create file
        File::put($finalPath, '');
        $this->info("File created: {$finalPath}");
    }

    /**
     * Normalize the Blade path,
     * which replaces the '.' extension with slash,
     * and prepend the based view directory, "resources/views/"
     *
     * @param  string $blade
     * @return string
     */
    protected function normalizePath($blade)
    {
        return "resources/views/" . str_replace('.', '/', $blade) . '.blade.php';
    }

}