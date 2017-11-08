<?php

//funciona al ejecutar el ajax de la clase StartGame. Recibe y Procesa la info de la pregunta actual y devuelve la siguiente pregunta

include("../GameSentence/GameSentence.php");
$right = "";
$gameId = "";

if (isset($_POST['right']) && isset($_POST['gameId']) && isset($_POST['numPhra'])) {
    $right = $_POST['right'];
    $gameId = $_POST['gameId'];
    $numP = $_POST['numPhra'];
    $numP--;
    $gameSenten = new GameSentence();
    $gameSenten->setResult($gameId, $right);
    if ($numP != 0) {
        $nextGameSent = $gameSenten->getNextGameSentence($gameId);
        $sent = new Sentence();
        $nextSentence = $sent->getDataToEdit($nextGameSent->sentenceId);
        //envía respuesta como json
        echo json_encode(array('nextQue' => $nextSentence->id, 'spanish' => $nextSentence->spanish, 'english' => $nextSentence->english, 'numP' => $numP));
    } else { //cuando se acaban las preguntas
        $punc = $gameSenten->getPunctuation($gameId);
        //envía respuesta como json
        echo json_encode(array('numP' => $numP, 'total' => $punc[0], 'rightAns' => $punc[1]));
    }
}
?>


