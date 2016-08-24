<?php

namespace AppBundle\Producer;

class ActivityLoggerSystem
{
	private $messageQueue;

	public function __construct($messageQueue)
	{
		$this->messageQueue = $messageQueue;
	}


	public function log($msg = 'I am message from rabbitmq1->ActivityLoggerSystem')
	{
		$this->messageQueue->setContentType('application/json');
        $this->messageQueue->publish(json_encode($msg));
	}
}