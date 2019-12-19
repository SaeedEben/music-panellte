<?php

namespace App\Console\Commands;

use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;

class getImage extends Command
{
    const BASE_DATA_PATH_IMG = "app/public/image/%s";


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Image From chosen Site';

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
        if (!\Storage::exists('public/image') || !\Storage::exists('public/sites')) {
            \Storage::makeDirectory('public/image');
            \Storage::makeDirectory('public/sites');
        }
        $kind = $this->choice('please choose image or site:', ['Image', 'Site'], 'Image');
        switch ($kind) {
            case 'Image':
                $this->Image_getter();
                break;
            case 'Site':
                $url = readline('please enter address of your Site with http:// or https://:');
                $this->SiteImage_getter($url);
                break;
        }


    }

    private function Image_getter()
    {
        $i        = 1;
        $progress = $this->output->createProgressBar(1);
        $input    = readline('please insert your Image Url:');
        while ($i <= 1) {
            $name      = explode('/', $input);
            $make_name = end($name);
            $storage   = storage_path(sprintf(self::BASE_DATA_PATH_IMG, $make_name));
            file_put_contents($storage, file_get_contents($input));
            $progress->advance();
            $i++;
        }
        $progress->finish();
        echo "\n";
        $this->info('your image successfully saved.');
        echo "\n";


    }

    private function SiteImage_getter($url)
    {
        $dom = new DOMDocument;
        $dom->loadXML('<'.$url);
        var_dump($dom->getElementsByTagName('<div>'));
        dd();
        foreach ($dom->getElementsByTagName('img') as $node) {
            echo $node->nodeValue . ': ' . $node->getAttribute("href") . "\n";
            echo 'hi';
        }
    }
}

