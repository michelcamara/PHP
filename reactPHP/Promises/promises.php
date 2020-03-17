<?php
//Essa importaçao trás um arquivo que executará este código quando o script for rodado.
require 'vendor/autoload.php';

function http(){
  //Variavel que instancia uma promise.
  $deferred = new \React\Promise\Deferred();

  for ($i = 1; $i <= 88; $i++) {
    //Variavel timeInit - tempo inicial de cada processo
    $timeInit = microtime(true);

    $url = "https://swapi.co/api/people/" . $i . "/";
    //json_decode - transcreve para um JSON manipulavel no PHP
    //file_get_contents - pega os dados de um JSON
    $response = json_decode(file_get_contents($url));
    //timeEnd - variavel do fim de tempo da captura do JSON
    $timeEnd = microtime(true);
    //round - funçao que comprime floats extensos, neste caso irá retornar
    //apenas 2 digitos após a virgula
    //total - variavel que contem o tempo total do processamento
    $total = round($timeEnd - $timeInit, 2);

    if ($response) {
      //Diz que a promise tem uma resposta
      $deferred->resolve($response);
      echo "\n";
      //PHP_EOL é para nao aparecer no console um %
      print_r("Processo: " . $i . PHP_EOL);
      echo "Tempo: " . $total . " segundos" . PHP_EOL;

      echo 'id: ' . $i . ', ';
      echo 'name: ' . $response->name . ', ';
      echo 'mass: ' . $response->mass;
      echo "\n";
    } else {
      $deferred->reject(new Exception('Sem resposta'));
    }
  }
  //Retorna a promise
  return $deferred->promise();
}
// microtime - funçao que inicia uma contagem de tempo em micro segundos
//Variavel start-time - tempo inicial de todo o código
$start_time = microtime(true);


//chama a funcao PHP
http()
  //Quando retorna positivo
  ->then(function () {
    echo "\n";
    echo "Concluido";
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

//Captura o tempo final quando acaba a promise.
$end_time = microtime(true);
//Calcula a o tempo total desse código
$execution_time = round($end_time - $start_time, 2);
echo "\n";
//Caso o tempo total seja maior ou igual 60 segundos.
if ($execution_time >= 60) {
  //"transfoma" para minutos
  $execution_time = round($execution_time / 60, 2);
  echo "Tempo Geral: " . $execution_time . ' min' . PHP_EOL;
} else {
  echo "Tempo Geral: " . $execution_time . ' s' . PHP_EOL;
}
