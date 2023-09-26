<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $timeout = 120;
    public $tries = 3;
    protected $data;
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        // $filePath = base_path().'/jobs.txt';
        // $contentToAdd = $this->data['name']."\n";
        // file_put_contents($filePath ,$contentToAdd,FILE_APPEND);
        //file_put_contents(base_path().'/jobs.txt','queue jobs'); 
        send_mail(['subject' => $this->data['name']]);
    }
}
