<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>

<body>
    <?php
        // microtime - funçao que inicia uma contagem de tempo em micro segundos
        //Variavel start-time - tempo inicial de todo o código
        $start_time = microtime(true);

        for($i= 1; $i<11; $i++){
            //Variavel timeInit - tempo inicial de cada processo
            $timeInit = microtime(true);

            $url= "https://swapi.co/api/people/".$i."/";
            //file_get_contents - pega os dados de um JSON
            $response = file_get_contents($url);
            //timeEnd - variavel do fim de tempo da captura do JSON
            $timeEnd = microtime(true);
            //round - funçao que comprime floats extensos, neste caso irá retornar
            //apenas 2 digitos após a virgula
            //total - variavel que contem o tempo total do processamento
            $total = round($timeEnd - $timeInit, 2);

            echo "<b>Processo:</b> ".$i."<br><br>";
            echo $response."</br><br>";
            echo "<b>Tempo de Execuçao:</b> ".$total." segundos <br/>";
            echo "================</br>";
        }

        // Fim do loop
        $end_time = microtime(true);

        // Calcula o tempo total deste código
        $execution_time = round($end_time - $start_time, 2);

        echo "<br/> <b>Tempo total desse código =</b> ".$execution_time." segundos";

    ?>
</body>

</html>
