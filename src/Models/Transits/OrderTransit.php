<?php
namespace cn\hofan\Models\Transits;

use Faker\Provider\Uuid;

class OrderTransit extends Transit
{
    public $data = [
        //订单信息

        //订单号，内部订单号，自动生成
        'orderId' => '',
        //订单类型
        'type' => '',
        //商品SKU
        'sku' => '',
        //数量
        'quantity' => 1,
        //装箱留言
        'comment' => '',
        //配送速度：Standard, Expedited, Priority，缺省为Standard
        'deliverySLA' => 'Standard',
        //买家姓名
        'addressName' => null,
        //买家地址
        'addressFieldOne' => null,
        //城市
        'addressCity' => null,
        //国家简码
        'addressCountryCode' => null,
        //省/州
        'addressState' => null,
        //邮编
        'addressPostCode' => null,

        //账号信息

        //礼品账号
        'accountName' => null,
        //SELLER ID
        'sellerId' => null,
        //商场 ID
        'marketplaceId' => null,
        //申请人
        'staffName' => null
    ];

    public function __construct()
    {
        $this->data['orderId'] = Uuid::uuid();
    }
}
