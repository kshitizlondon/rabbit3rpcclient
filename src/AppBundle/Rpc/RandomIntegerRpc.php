<?php

namespace AppBundle\Rpc;

use AppBundle\Producer\ActivityLoggerSystem;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

/**
 * Callback to process request from the client and formulate the response.
 */
class RandomIntegerRpc
{
    /**
     * @var string
     */
    const RANDOM_NUMBER_LABEL = 'Server Random Number';

    /**
     * @var ActivityLoggerSystem
     */
    protected $activityLoggerSystem;

    public function __construct(ActivityLoggerSystem $activityLoggerSystem)
    {
        $this->activityLoggerSystem = $activityLoggerSystem;
    }

    /**
     * @param AMQPMessage $args
     *
     * @return string
     */
    public function execute(AMQPMessage $args)
    {
        /** @var array $body */
        $body = unserialize($args->getBody());
        $min = $body['min'];
        $max = $body['max'];

        $response = [
            static::RANDOM_NUMBER_LABEL . '1' => rand($min, $max),
            static::RANDOM_NUMBER_LABEL . '2' => rand($min, $max),
        ];

        $massageToLog = sprintf('Rabbit1 RPC Replied Successfully. Request: "%s", Response: "%s"', $args->getBody(), serialize($response));
        $this->activityLoggerSystem->log($massageToLog);

        return $response;
    }
}