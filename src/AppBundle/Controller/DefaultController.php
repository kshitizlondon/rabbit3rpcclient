<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return string
     */
    public function indexAction()
    {
	   return new Response('url to send message: http://rabbit3.dev/rand_int');
    }

    /**
     * @Route("/rand_int", name="rand_int_using_rpc")
     */
    public function randomRpcAction()
    {
        $requestId = mt_rand(5,10);
        $client = $this->get('old_sound_rabbit_mq.integer_store_rpc');
        $client->addRequest(serialize(array('min' => 0, 'max' => 10)), 'random_integer', $requestId);
        $replies = $client->getReplies();

        if (array_key_exists($requestId, $replies)) {
            return new Response(json_encode($replies));
        }
    }
}
