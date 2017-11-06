<?php

include("../GameSentence/GameSentence.php");

$gameId = $_POST['gameId'];
$right = $_POST['right'];
echo $right;
echo $gameId;

//$gameSenten = new GameSentence();
//$gameSenten->setResult($gameId, $right);
//$nextQues = $gameSenten->getNextSentence($gameId);
//echo json_encode(array('nextQue' => $nextQues->id, 'spanish' => $nextQues->spanish, 'english' => $nextQues->english));
echo json_encode(array('nextQue' =>$right));
?>


