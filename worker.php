<?php

declare(strict_types=1);

use Spiral\RoadRunner;
use Nyholm\Psr7;

require __DIR__ . "/vendor/autoload.php";

$worker = RoadRunner\Worker::create();
$psrFactory = new Psr7\Factory\Psr17Factory();
$worker = new RoadRunner\Http\PSR7Worker($worker, $psrFactory, $psrFactory, $psrFactory);

while ($request = $worker->waitRequest()) {
    try {
        $response = new Psr7\Response();
        $response->getBody()->write('Hello world!');

        $worker->respond($response);
    } catch (\Throwable $e) {
        $worker->getWorker()->error((string)$e);
    }
}
