<?php


namespace cn\hofan\Queue;

use cn\hofan\Models\Transits\Transit;
use cn\hofan\Queue\Jobs\OrderJsonJob;

class OrderQueueCall extends QueueCall
{
    public static function createOrder(Transit $order, string $handler = OrderJsonJob::class)
    {
        $order->command = Transit::METHOD_CREATE_ORDER;

        static::call($order, $handler, 'order');
    }
}
