<?php

namespace Petehouston\Xin;

use Illuminate\Console\Command;

class XinIpCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'xin:ip
                            {--public : Get public IP address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find your IP address.';

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
        if($this->option('public') != null) {
            $this->getPublicIpAddress();
        } else {
            $this->getLocalIpAddress();
        }
    }

    /**
     * Get Public IP Address
     *
     * @return void
     */
    protected function getPublicIpAddress() {
        $ip = file_get_contents("http://myexternalip.com/raw");
        $this->info("External IP address is: " . $ip);
    }

    /**
     * Get Local IP Address
     *
     * @return void
     */
    protected function getLocalIpAddress() {
        $ip = getHostByName(getHostName());
        $this->info("Local IP address is: " . $ip);
    }

}