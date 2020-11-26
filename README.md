Hofan components for Laravel
======================

## Installation

You can install this package via composer using this command:

```
composer require upingli/hofan
```

The queue components in this package is based on vladimir-yuldashev/laravel-queue-rabbitmq. Because laravel-queue-rabbitmq serialize message in queue by using PHP serialize(), which can not be realized by the other language, it's unfriendly. This component provide a JSON serialized format for message to exchange message for the other non-PHP system.   

Before use this component, you must config it.
 
Add connection to `config/queue.php`:

```php
'default' => env('QUEUE_CONNECTION', 'sync'),
//Not required, if you want to use a second conenection to avoid use the default one, add the below line. Otherwise, will use the default.
'second'  => env('QUEUE_CONNECTION2', 'rabbitmq'),

'connections' => [
    // ...

    'rabbitmq' => [
    
       'driver' => 'rabbitmq',
       'queue' => env('RABBITMQ_QUEUE', 'default'),
       'connection' => PhpAmqpLib\Connection\AMQPLazyConnection::class,
   
       'hosts' => [
           [
               'host' => env('RABBITMQ_HOST', '127.0.0.1'),
               'port' => env('RABBITMQ_PORT', 5672),
               'user' => env('RABBITMQ_USER', 'guest'),
               'password' => env('RABBITMQ_PASSWORD', 'guest'),
               'vhost' => env('RABBITMQ_VHOST', '/'),
           ],
       ],
   
       'options' => [
           'ssl_options' => [
               'cafile' => env('RABBITMQ_SSL_CAFILE', null),
               'local_cert' => env('RABBITMQ_SSL_LOCALCERT', null),
               'local_key' => env('RABBITMQ_SSL_LOCALKEY', null),
               'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
               'passphrase' => env('RABBITMQ_SSL_PASSPHRASE', null),
           ],
       ],
   
       /*
        * Set to "horizon" if you wish to use Laravel Horizon.
        */
       'worker' => env('RABBITMQ_WORKER', 'default'),
        
    ],

    // ...    
],
```

Example for create order using rabbitmq queue:
```php
class TestController extends \Illuminate\Routing\Controller
{
    $order = new OrderTransit();
    OrderQueueCall::createOrder($order);
}
```
The result of createOrder() will be handled by cn\hofan\Queue\Jobs\OrderJsonJob. If you want to handle it yourself, there is a example.

Define your job:
```php
class MyJob extends JsonJob
{
    protected function handle(string $command, $result)
    {
        if($command = "CREATE_ORDER_RESULT")
        {
            //Handle result for createOrder
        }

        return true;
    }
}
```
Then change the code in controller:
```php
class TestController extends \Illuminate\Routing\Controller
{
    $order = new OrderTransit();
    OrderQueueCall::createOrder($order, MyJob::class);
}
```