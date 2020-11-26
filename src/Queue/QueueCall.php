<?php
namespace cn\hofan\Queue;

use cn\hofan\Models\Transits\Transit;
use Illuminate\Support\Facades\Queue;

class QueueCall
{
    protected static function call(Transit $transit, $job, $queue)
    {
        $default = config('queue.default');
        $connection = config('queue.second');
        if(empty($connection) || $connection == $default)
            Queue::push($job, $transit, $queue);
        else {
            Queue::connection($connection)->push($job, $transit, $queue);
        }
    }
}
