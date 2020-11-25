<?php
namespace cn\hofan\Queue;

use cn\hofan\Models\Transits\Transit;
use Illuminate\Support\Facades\Queue;

class QueueCall
{
    protected static function call(Transit $transit, $job, $queue)
    {
        Queue::push($job, $transit, $queue);
    }
}
