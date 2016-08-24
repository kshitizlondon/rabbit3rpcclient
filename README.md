# rabbitmq in symfony 

A simple repository to learn how to use RabbitMQ and Symfony 2.8

1) `git clone https://github.com/rodolfobandeira/rabbitmq-and-symfony-studies.git`

2) `cd rabbitmq-and-symfony-studies`

3) `composer install`

4) `php app/console | grep rabbitmq`

5) Try to create a producer and execute a consumer.

6) `php app/console server:run 0.0.0.0:8000`

7) Open in the browser. ex: http://127.0.0.1:8000

8) `php app/console rabbitmq:consumer hello_rabbitmq`

9) In order to create exchanges, queues and bindings at once and be sure you will not lose any message, you can run the following command: `php app/console rabbitmq:setup-fabric`

10) start rmpc server `app/console rabbitmq:rpc-server random_int`
