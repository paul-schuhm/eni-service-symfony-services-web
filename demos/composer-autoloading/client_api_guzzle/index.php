<?php
/*
 * Un client HTTP de notre service web CMS
 * utilisant le package Guzzle.
 */
require 'vendor/autoload.php';
use GuzzleHttp\Client;

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
set_exception_handler(function (\Throwable $e) {
    echo 'Une Exception a été détectée. Nous mettons fin au programme.' . PHP_EOL;
    var_dump($e->getMessage());
});

$client = new Client([
    'base_uri' => 'http://localhost:5005',
    'timeout'  => 5,
    'headers'  => ['Accept' => 'application/json'],
]);

try {
    $response = $client->get('/', [
        'query' => ['page' => 1], 
    ]);

    echo $response->getStatusCode(), PHP_EOL;                 
    echo $response->getHeaderLine('Content-Type'), PHP_EOL; 

    $body = json_decode(
        $response->getBody()->getContents(),
        associative: true,
        flags: JSON_THROW_ON_ERROR
    );
    //On dump la réponse (pour le test)
    var_dump($body);
} catch (GuzzleException $e) {
    echo 'Erreur HTTP : ', $e->getMessage(), PHP_EOL;
}
