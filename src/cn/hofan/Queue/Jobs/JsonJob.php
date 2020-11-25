<?php
namespace cn\hofan\Queue\Jobs;

use cn\hofan\Models\Transits\Transit;
use Illuminate\Queue\Jobs\Job;

abstract class JsonJob
{
    /**
     * 处理消息队列中的包，根据command调用处理函数
     * @param Job $job
     * @param Transit $transit
     */
    public function fire(Job $job, Transit $transit)
    {
        echo json_encode($transit);
        if($this->handle($transit->command, $transit->data))
            $job->delete();
    }

    abstract protected function handle(string $command, $data);
}
