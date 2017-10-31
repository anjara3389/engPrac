<?php

include_once("../DataBase/DBConnect.php");
$func = "";
$func = $_GET['func'];

if ($func) {
    $sentence = new Sentence();
    if (strcmp($func, "del") == 0) {//elimnar
        $id = $_GET['id'];
        $sentence->delete($id);
    } else if (strcmp($func, "insert") == 0) {//insertar
        $name = $_POST['name'];
        $catId = $_POST['cat'];
        $sentence->insert($name, $catId);
    } else if (strcmp($func, "edit") == 0) {//editar
        $id = $_POST['id'];
        $name = $_POST['name'];
        $catId = $_POST['cat'];
        $sentence->edit($name, $catId, $id);
    }
    header('Location:./ListSentences.php '); //devuelve a la pág ListSentence
}

class Sentence {

    public $id;
    public $name;
    public $catId;

    function __construct() {
        
    }

    public function setPars($id, $name, $catId) {
        $this->id = $id;
        $this->name = $name;
        $this->catId = $catId;
    }

    public function select() {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT id,name,category_id FROM sentence");
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        $sentences;
        $num = 0;
        while ($row = pg_fetch_row($result)) { //recuperar fila de un resultado
            $id = $row[0];
            $name = $row[1];
            $catId = $row[2];
            $sentence = new Sentence();
            $sentence->setPars($id, $name, $catId);
            $sentences[$num] = $sentence;
            $num++;
        }
        return $sentences;
    }

    public function getDataToEdit($idD) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT name,category_id FROM sentence WHERE id=" . $idD);
        $data[0] = pg_fetch_row($result)[0];
        $data[1] = pg_fetch_row($result)[1];
        return $data;
    }

    public function delete($idD) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "DELETE FROM sentence WHERE id=" . $idD);
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $result;
    }

    public function insert($nameI, $catId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "INSERT INTO sentence(name,category_id) VALUES('$nameI',$catId)");
        echo "INSERT INTO sentence(name,category_id) VALUES('$nameI',$catId)";
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $result;
    }

    public function edit($nameE, $categId, $idE) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "UPDATE sentence SET name='" . $nameE . "',category_id=" . $categId . " WHERE id=" . $idE);
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
    }

}
