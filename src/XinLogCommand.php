<?php

namespace Petehouston\Xin;

use Symfony\Component\Process\Process;
use Illuminate\Console\Command;

class XinLogCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'xin:log
                            {--name= : Name of log file.}
                            {--clean : Clean log file.}
                            {--remove-all : Remove all log.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Work with log files.';

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
        $shouldClearAll = $this->option('remove-all');
        $shouldCleanLogFile = $this->option('clean');
        $filename = $this->option('name') ?: $this->getDefaultLogFileName();

        if($shouldClearAll) {
            $this->removeAllLogFiles();
        } else if($shouldCleanLogFile) {
            $this->cleanLogFile($filename);
        } else {
            $this->readLogFile($filename);
        }
    }

    /**
     * Remove all log files
     *
     * @return void
     */
    protected function removeAllLogFiles()
    {
        $logPath = $this->getLogPath();
        array_map('unlink', glob($logPath."/*"));
        $this->info('Removed all logs!');
    }

    /**
     * Clean a log file
     *
     * @param  string $filename
     *
     * @return void
     */
    protected function cleanLogFile($filename)
    {
        $path = $this->getLogPath().'/'.$filename;
        if(file_exists($path)) {
            file_put_contents($path, '');
            $this->info('Log file cleaned at: '.$path);
        } else {
            $this->comment('File does not exist: '.$path);
        }
    }

    /**
     * Read a log file
     *
     * @param  string $filename
     *
     * @return void
     */
    protected function readLogFile($filename)
    {
        $path = $this->getLogPath().'/'.$filename;
        if(file_exists($path)) {
            $this->line(file_get_contents($path));
        } else {
            $this->comment('File does not exist: '.$path);
        }
    }

    /**
     * Get logs path
     *
     * @return string
     */
    protected function getLogPath()
    {
        return storage_path('logs');
    }

    /**
     * Get default Laravel log file name
     *
     * @return string
     */
    protected function getDefaultLogFileName()
    {
        return 'laravel.log';
    }

}