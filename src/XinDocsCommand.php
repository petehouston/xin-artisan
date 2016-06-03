<?php

namespace Petehouston\Xin;

use App;
use Symfony\Component\Process\Process;
use Illuminate\Console\Command;

class XinDocsCommand extends Command
{
    protected $ListSections = [
        'releases'      => 'Release Notes',
        'upgrade'       => 'Upgrade Guide',
        'contributions' => 'Contribution Guide',

        'installation'  => 'Installation',
        'configuration' => 'Configuration',
        'homestead'     => 'Homestead',
        'valet'         => 'Valet',

        'quickstart'              => 'Basic Task List',
        'quickstart-intermediate' => 'Intermediate Task List',

        'routing'     => 'Routing',
        'middleware'  => 'Middleware',
        'controllers' => 'Controllers',
        'requests'    => 'Requests',
        'responses'   => 'Responses',
        'views'       => 'Views',
        'blade'       => 'Blade Templates',

        'lifecycle' => 'Request Lifecycle',
        'structure' => 'Application Structure',
        'providers' => 'Service Providers',
        'container' => 'Service Container',
        'contracts' => 'Contracts',
        'facades'   => 'Facades',

        'authentication' => 'Authentication',
        'authorization'  => 'Authorization',
        'artisan'        => 'Artisan Console',
        'billing'        => 'Billing',
        'cache'          => 'Cache',
        'collections'    => 'Collections',
        'elixir'         => 'Elixir',
        'encryption'     => 'Encryption',
        'errors'         => 'Errors & Loggin',
        'events'         => 'Events',
        'filesystem'     => 'Filesystem & Cloud Storage',
        'hashing'        => 'Hashing',
        'helpers'        => 'Helpers',
        'localization'   => 'Localization',
        'mail'           => 'Mail',
        'packages'       => 'Package Development',
        'pagination'     => 'Pagination',
        'queues'         => 'Queues',
        'redis'          => 'Redis',
        'session'        => 'Session',
        'envoy'          => 'SSH Tasks',
        'scheduling'     => 'Task Scheduling',
        'testing'        => 'Testing',
        'validation'     => 'Validation',

        'database'   => 'Database - Getting Started',
        'queries'    => 'Query Builder',
        'migrations' => 'Migrations',
        'seeding'    => 'seeding',

        'eloquent'               => 'Eloquent - Getting Started',
        'eloquent-relationships' => 'Relationships',
        'eloquent-collections'   => 'Eloquent Collections',
        'eloquent-mutators'      => 'Mutators',
        'eloquent-serialization' => 'Eloquent Serialization'
    ];

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'xin:docs
        {action : Action. Available: "list", "read".}
        {--locale= : Select language. Available: "vn", (default) "en".}
        {--key= : The key of section, use "list" to see all available keys.}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open Laravel official documentation.';

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
        $type = $this->argument('action');
        if($type === 'list') {
            $this->executeListCommand();
        } else if($type === 'read') {
            $this->executeReadCommand();
        } else {
            $this->error('Unknown argument: '.$type);
        }
    }

    /**
     * Print all Laravel documentation section
     *
     * @return void
     */
    protected function executeListCommand()
    {
        $headers = ['Section', 'Key'];
        $this->line('All of Laravel documentation sections are listed below: ');
        $this->table($headers, $this->makeFlattenArray($this->ListSections));
    }

    /**
     * Open documentation URL based on section key from user input
     *
     * @return void
     */
    protected function executeReadCommand()
    {
        $key = $this->getSectionKey();
        if(!in_array($key, array_keys($this->ListSections))) {
            $this->error('Key not found: '.$key);
        } else {
            $url = $this->makeFullUrl($this->getLocale(), $this->getCurrentVersion(), $key);
            $this->runSystemCommand($this->getOsBrowserCommand().' '.$url);
        }
    }

    /**
     * Get section key
     *
     * @return string
     */
    protected function getSectionKey()
    {
        $key = $this->option('key');
        if(!in_array($key, array_keys($this->ListSections))) {
            foreach(array_keys($this->ListSections) as $data) {
                if(substr($data, 0, strlen($key)) === $key) {
                    return $data;
                }
            }
        }

        return $key;
    }

    /**
     * Get app locale
     *
     * @return string
     */
    protected function getLocale()
    {
        $locale = $this->option('locale');
        if($locale == null) {
            $locale = config('app.locale');
        }
        return $locale;
    }

    /**
     * Flatten associative array
     *
     * @param  array $input
     *
     * @return array
     */
    protected function makeFlattenArray($input)
    {
        $result = [];
        foreach($input as $key => $value) {
            $result[] = [$value, $key];
        }

        return $result;
    }

    /**
     * Get the full URL to the docs
     *
     * @param  string $locale
     * @param  string $version
     * @param  string $section
     *
     * @return string
     */
    protected function makeFullUrl($locale, $version, $section)
    {
        if($locale === 'vn') {
            return 'https://github.com/petehouston/laravel-docs-vn/blob/master/'.$section.'.md';
        } else {
            return 'https://laravel.com/docs/'.$version.'/'.$section;
        }
    }

    /**
     * Get project version
     *
     * @return string
     */
    protected function getCurrentVersion() {
        $version = explode(".", App::VERSION());
        return $version[0].'.'.$version[1];
    }

    /**
     * Get browser opening command
     *
     * @return string
     */
    protected function getOsBrowserCommand()
    {
        $browser = config('xin.browser.bin');
        if(!$browser || empty($browser)) {
            $Windows = ['WIN32', 'Win32', 'WINNT', 'WinNT', 'Windows'];
            $Mac = ['Darwin'];

            if(in_array(PHP_OS, $Windows)) {
                return 'start';
            } else if(in_array(PHP_OS, $Mac)) {
                return 'open';
            } else {
                return 'firefox';
            }
        }

        return $browser;
    }

    /**
     * Run system command
     *
     * @param  string $cmd
     *
     * @return void
     */
    protected function runSystemCommand($cmd)
    {
        $process = new Process($cmd);
        $process->run();
    }
}