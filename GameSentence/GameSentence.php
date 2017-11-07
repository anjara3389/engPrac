<?php

include_once("../DataBase/DBConnect.php");
include_once("../Sentence/Sentence.php");
$func;

if (isset($_GET['func'])) {
    $func = $_GET['func'];
    if ($func) {
        $gameSent = new GameSentence();
        if (strcmp($func, "del") == 0) {//elimnar
            $id = $_GET['id'];
            $gameSent->delete($id);
        }
    }
}

class GameSentence {

    public $id;
    public $gameId;
    public $sentenceId;
    public $isRight;

    function __construct() {
        
    }

    public function setPars($id, $gameId, $sentenceId, $isRight) {
        $this->id = $id;
        $this->gameId = $gameId;
        $this->sentenceId = $sentenceId;
        $this->isRight = $isRight;
    }

    public function insert($gameId, $SentenceId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "INSERT INTO game_sentence(game_id,sentence_id) VALUES($gameId,$SentenceId)");
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $result;
    }

    public function getNextGameSentence($gameId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT gss.id,gss.game_id,gss.sentence_id FROM game_sentence gss WHERE gss.id= (SELECT MIN(gs.id) "
                . "FROM game_sentence gs "
                . "WHERE gs.game_id=" . $gameId . " AND gs.is_right IS NULL)");
        $row = pg_fetch_row($result);

        $gameSent = new GameSentence();
        $gameSent->setPars($row[0], $row[1], $row[2], null);
        return $gameSent;
    }

    public function setResult($gameId, $right) { //cambia a bien o mal
        $connect = new DBConnect();
        $nextGS = $this->getNextGameSentence($gameId);
        $result = pg_query($connect->getDB(), "UPDATE game_sentence SET is_right = " . $right . " WHERE id = " . $nextGS->id);
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
    }

    public function getPunctuation($gameId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT COUNT(*),(SELECT COUNT(*) "
                . "FROM game_sentence gss "
                . "WHERE gss.game_id=" . $gameId . " "
                . "AND gss.is_right) "
                . "FROM game_sentence gs "
                . "WHERE gs.game_id = " . $gameId);
        $row = pg_fetch_row($result);

        $punct[0] = $row[0];
        $punct[1] = $row[1];
        return $punct;
    }

    public function getStatistics($sentenceId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT COUNT(*),(SELECT COUNT(*) "
                . "FROM game_sentence gss "
                . "WHERE gss.sentence_id=" . $sentenceId . " "
                . "AND gss.is_right) "
                . "FROM game_sentence gs "
                . "WHERE gs.is_right IS NOT NULL "
                . "AND gs.sentence_id = " . $sentenceId);
        $row = pg_fetch_row($result);

        $stat[0] = $row[0];
        $stat[1] = $row[1];
        return $stat;
    }

}
