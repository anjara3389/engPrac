<?php

include_once("../DataBase/DBConnect.php");
include_once("../Sentence/Sentence.php");
$func = "";
$func = $_GET['func'];

if ($func) {
    $gameSent = new GameSentence();
    if (strcmp($func, "del") == 0) {//elimnar
        $id = $_GET['id'];
        $gameSent->delete($id);
    }
}

class GameSentence {

    public $id;
    public $gameId;
    public $sentenceId;

    function __construct() {
        
    }

    /* public function getDataToEdit($idD) {
      $connect = new DBConnect();
      $result = pg_query($connect->getDB(), "SELECT num_phrases,category_id FROM game WHERE id=" . $idD);
      $data[0] = pg_fetch_row($result)[0];
      $data[1] = pg_fetch_row($result)[1];
      return $data;
      }

      public function delete($idD) {
      $connect = new DBConnect();
      $result = pg_query($connect->getDB(), "DELETE FROM game WHERE id=" . $idD);
      if (!$result) {
      echo "Ha ocurrido un error.\n";
      exit;
      }
      return $result;
      } */

    public function insert($gameId, $SentenceId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "INSERT INTO game_sentence(game_id,sentence_id) VALUES($gameId,$SentenceId)");
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $result;
    }

    public function getNextSentence($gameId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT MIN(gs.id)"
                . "FROM game_sentence gs "
                . "WHERE gs.game_id=" . $gameId . " AND right IS NULL");
        $sentenceId = pg_fetch_row($result)[0];
        $sentence = new Sentence();
        return $sentence->getDataToEdit($sentenceId);
    }

    public function setResult($gameId, $right) { //cambia a bien o mal
        $connect = new DBConnect();
        $maxGameSentence = getMaxGameSentence($gameId);
        $result = pg_query($connect->getDB(), "UPDATE game_sentence SET right=" . $right . " WHERE id=" . $maxGameSentence);
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
    }

    /*  public function edit($numPhraE, $categId, $idE) {
      $connect = new DBConnect();
      $result = pg_query($connect->getDB(), "UPDATE game SET num_phrases=" . $numPhraE . ",category_id=" . $categId . " WHERE id=" . $idE);
      if (!$result) {
      echo "Ha ocurrido un error.\n";
      exit;
      }
      } */
}
