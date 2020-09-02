<?php

namespace App\Jobs;

use App\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVerifyWebsite
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $website;

    /**
     * Create a new job instance.
     *
     * @param Website $website
     */
    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return bool
     * @throws \Throwable
     */
    public function handle()
    {
        $this->website->verified = true;
        return $this->website->saveOrFail();
    }
}
