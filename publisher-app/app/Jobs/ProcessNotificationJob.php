<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscription;
use App\Jobs\PushNotificationJob;

class ProcessNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request_body;
    public $tries = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request_body = array())
    {
        $this->request_body = $request_body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (empty($this->request_body)) {
            return -1;
        }

        $topic = $this->request_body['topic'];

        $subscriptions = Subscription::where('topic', $topic)->get()->toArray();

        if (!$subscriptions || empty($subscriptions)) {
            return -1;
        }

        // Send post requests to subscriptions with topic
        foreach ($subscriptions as $subscription) {
            $url = $subscription['url'];
            $data = $this->request_body;
            PushNotificationJob::dispatch($url, $data);
        }

        return 0;
    }
}
