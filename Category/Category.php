<?php

include_once("../DataBase/DBConnect.php");
include_once("../Sentence/Sentence.php");
$func = "";
if (isset($_GET['func'])) {
    $func = $_GET['func'];

    if ($func) {
        $categ = new Category();
        if (strcmp($func, "del") == 0) {//elimnar
            $id = $_GET['id'];
            $categ->delete($id);
        } else if (strcmp($func, "insert") == 0) {//insertar
            $name = $_POST['name'];
            $categ->insert($name);
        } else if (strcmp($func, "edit") == 0) {//editar
            $id = $_POST['id'];
            $name = $_POST['name'];
            $categ->edit($name, $id);
        }
        header('Location:./ListCategory.php '); //devuelve a la pág ListCategory
    }
}

class Category {

    public $id;
    public $name;

    function __construct() {
        
    }

    public function setPars($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function select($sentenc) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT c.id,c.name FROM category c WHERE active " . (!$sentenc ? "" : "AND c.id IN(SELECT s.category_id FROM sentence s) "));
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        $categories;
        $num = 0;
        while ($row = pg_fetch_row($result)) { //recuperar fila de un resultado
            $id = $row[0];
            $name = $row[1];
            $category = new Category();
            $category->setPars($id, $name);
            $categories[$num] = $category;
            $num++;
        }
        if (isset($categories)) {
            return $categories;
        }
    }

    public function getDataToEdit($idD) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT name FROM category WHERE id=$idD");
        return pg_fetch_row($result)[0];
    }

    public function delete($idD) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "UPDATE category SET active=false WHERE id=" . $idD);
        $sentenc = new Sentence();
        $sentenc->delete(null, $idD);
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $result;
    }

    public function insert($nameI) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "INSERT INTO category(name) VALUES('$nameI')");
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $result;
    }

    public function edit($nameE, $idE) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "UPDATE category SET name='" . $nameE . "' WHERE id=" . $idE);
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
    }

    //retorna el numero de oraciones que tiene una caegoría
    public function getNumSentences($idD) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT COUNT(*) FROM sentence WHERE category_id=$idD");
        return pg_fetch_row($result)[0];
    }

    public function validateName($name, $idC) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT COUNT(*) FROM category WHERE name LIKE '$name' " . ($idC != null ? "AND id<>$idC)" : ""));
        return (pg_fetch_row($result)[0] == 0);
    }

}
