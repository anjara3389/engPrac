<?php

include_once("../DataBase/DBConnect.php");
$func = "";
$func = $_GET['func'];

if ($func) {
    $game = new Game();
    if (strcmp($func, "del") == 0) {//elimnar
        $id = $_GET['id'];
        $game->delete($id);
    } else if (strcmp($func, "insert") == 0) {//insertar
        $numPhra = $_POST['numPhra'];
        $catId = $_POST['cat'];
        $game->insert($numPhra, $catId);
        header('Location:./StartGame.php?cat=$catId&numPhra=$numPhra'); //va a la pag Start game
    }
}

class GameSentence {

    public $id;
    public $numPhra;
    public $catId;

    function __construct() {
        
    }

    public function setPars($id, $numPhra, $catId) {
        $this->id = $id;
        $this->numPhra = $numPhra;
        $this->catId = $catId;
    }

    public function select() {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT id,num_phrases,category_id FROM game");
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        $games;
        $num = 0;
        while ($row = pg_fetch_row($result)) { //recuperar fila de un resultado
            $id = $row[0];
            $numPhra = $row[1];
            $catId = $row[2];
            $game = new Game();
            $game->setPars($id, $numPhra, $catId);
            $games[$num] = $game;
            $num++;
        }
        return $games;
    }

    public function getDataToEdit($idD) {
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
    }

    public function insert($numPhraI, $catId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "INSERT INTO game(num_phrases,category_id) VALUES($numPhraI,$catId)");
        echo "INSERT INTO game(num_phrases,category_id) VALUES('$numPhraI',$catId)";
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $result;
    }

    public function edit($numPhraE, $categId, $idE) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "UPDATE game SET num_phrases=" . $numPhraE . ",category_id=" . $categId . " WHERE id=" . $idE);
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
    }

}
