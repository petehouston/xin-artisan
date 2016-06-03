<?php

namespace Petehouston\Xin;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class XinGistCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'xin:gist
        {filename : Path to file.}
        {--desc= : Share description.}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Share a source file to Gist.';

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
        // normalize path if Windows
        $filename = str_replace('\\', '/', $this->argument('filename'));

        if(empty($filename)) {
            $this->comment('No input file specified.');
        } else {
            if(!$this->verifyFileExist($filename)) {
                $this->comment('File does not exist at: '.base_path($filename));
            } else {
                $this->shareGist($filename, $this->option('desc') ?: 'Share code via xin:gist https://github.com/petehouston/xin-artisan');
            }
        }
    }

    /**
     * Check if file exist at path
     *
     * @param  string $file
     *
     * @return bool
     */
    protected function verifyFileExist($file)
    {
        return file_exists(base_path($file));
    }

    /**
     * Share Gist
     *
     * @param  string $file
     * @param  string $description
     *
     * @return void
     */
    protected function shareGist($file, $description)
    {
        $GIST_API = 'https://api.github.com/';
        $name = last(explode('/', $file));
        $data = [
            'public' => true,
            'description' => $description,
            'files' => [
                $name => [
                    'content' => file_get_contents(base_path($file))
                ]
            ]
        ];

        $client = new Client(['base_uri' => $GIST_API]);
        $response = $client->request('POST', 'gists', [
            'json' => $data
        ]);

        $result = json_decode($response->getBody()->getContents());

        $this->line('Gist Sharing Information');
        $this->line('------------------------------------------------------------------');
        $this->line('Gist Id:  '.$result->id);
        $this->line('Gist Url: '.$result->html_url);
    }

}