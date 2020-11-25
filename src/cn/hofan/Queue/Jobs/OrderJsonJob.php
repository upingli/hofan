<?php

namespace cn\hofan\Queue\Jobs;

/**
 * 订单消息队列示例
 *
 * Class OrderJsonJob
 * @package App\cn\hofan\Queue\Jobs
 */
class OrderJsonJob extends JsonJob
{
    /**
     * 创建订单成功后消息队列的通知
     *
     * @param $result array  创建结果
     * @return bool 返回true，表示处理成功，框架会从消息队列中删除此消息
     */
    public function createOrderResult($result)
    {
        return true;
    }
}
