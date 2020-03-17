<?php

require 'vendor/autoload.php';

function http($array)
{
  $deferred = new \React\Promise\Deferred();
  $timeInit = microtime(true);

  $url = "https://swapi.co/api/people/" . $array . "/";
  $response = file_get_contents($url);
  $timeEnd = microtime(true);
  $total = round($timeEnd - $timeInit, 2);

  if ($response) {
    $deferred->resolve($response);
  } else {
    $deferred->reject(new Exception('Sem resposta'));
  }
  return $deferred->promise();
}

$start_time = microtime(true);
$n = array(1, 2, 3, 4, 5);

foreach ($n as $x) {
  http($x)
    ->then(function ($response) {
      return $response->name;
    })

    ->then(
      function ($response) {
        echo $response . PHP_EOL;
      }
    )

    ->otherwise(
      function (Exception $exception) {
        echo $exception->getMessage() . PHP_EOL;
      }
    );
}

$end_time = microtime(true);
$execution_time = round($end_time - $start_time, 2);
echo "\n";
if ($execution_time >= 60) {
  $execution_time = round($execution_time / 60, 2);
  echo "Tempo Geral: " . $execution_time . ' min' . PHP_EOL;
} else {
  echo "Tempo Geral: " . $execution_time . ' s' . PHP_EOL;
}
