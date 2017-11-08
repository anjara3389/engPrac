<?php

include_once("../DataBase/DBConnect.php");
include_once("../GameSentence/GameSentence.php");
$func = "";
if (isset($_GET['func'])) {
    $func = $_GET['func'];

    if ($func) {
        $game = new Game();
        if (strcmp($func, "insert") == 0) {//insertar
            $numPhra = $_POST['numPhra'];
            $catId = $_POST['cat'];
            $gameId = $game->insert($numPhra, $catId);
            header('Location:./StartGame.php?cat=' . $catId . '&numPhra=' . $numPhra . '&gameId=' . $gameId); //va a la pag Start game
        }
    }
}

class Game {

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

    public function insert($numPhraI, $catId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "INSERT INTO game(num_phrases,category_id) VALUES($numPhraI,$catId) RETURNING id");
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        $data = pg_fetch_array($result);
        $this->startGame($catId, $numPhraI, $data[0]);
        return $data[0]; //retorna el id
    }

    //da el id del juego actual
    public function getCurrGame() {
        $connect = new DBConnect();
        $curgame = pg_query($connect->getDB(), "SELECT currval('autoincrement_game')");
        if (!$curgame) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $curgame;
    }

    /* Inicia juego eligiendo frases al azar dentro de la categoría y insertando dentro de la tabla gameSentence cada uno de los ids de las oraciones y el id del juego actual.
      catId el id de la categoría del juego actual en el que se va a jugar
      numPhra el numero de oraciones que va a tener el juego actual
      curgame el id del juego actual
     */

    public function startGame($catId, $numPhra, $curgame) {
        $sentence = new Sentence();
        $phrases = $sentence->selectRamdomlyByCat($catId, $numPhra);
        for ($i = 0; $i < count($phrases); $i++) {
            $gameSentence = new GameSentence();
            $gameSentence->insert($curgame, $phrases[$i]->id);
        }
    }

}
