<?php

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
        echo json_encode(array('nextQue' => $nextSentence->id, 'spanish' => $nextSentence->spanish, 'english' => $nextSentence->english, 'numP' => $numP));
    } else {
        $punc = $gameSenten->getPunctuation($gameId);
        echo json_encode(array('numP' => $numP, 'total' => $punc[0], 'rightAns' => $punc[1]));
    }
}
?>


