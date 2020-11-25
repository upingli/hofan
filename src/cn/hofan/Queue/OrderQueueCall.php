<?php


namespace cn\hofan\Queue;

use cn\hofan\Models\Transits\Transit;
use cn\hofan\Queue\Jobs\OrderJsonJob;

class OrderQueueCall extends QueueCall
{
    public static function createOrder(Transit $order)
    {
        $order->command = Transit::METHOD_CREATE_ORDER;

        static::call($order, OrderJsonJob::class, 'order');
    }
}
