<?php

include_once("../DataBase/DBConnect.php");
$func = "";
$func = $_GET['func'];

if ($func) {
    $sentence = new Sentence();
    if (strcmp($func, "del") == 0) {//elimnar
        $id = $_GET['id'];
        $catId = $_GET['cat'];
        $sentence->delete($id);
    } else if (strcmp($func, "insert") == 0) {//insertar
        $english = $_POST['english'];
        $spanish = $_POST['spanish'];
        $catId = $_POST['cat'];
        $sentence->insert($english, $spanish, $catId);
    } else if (strcmp($func, "edit") == 0) {//editar
        $id = $_POST['id'];
        $english = $_POST['english'];
        $spanish = $_POST['spanish'];
        $catId = $_POST['cat'];
        $sentence->edit($english, $spanish, $catId, $id);
    }
    header('Location:./ListSentences.php?categ=' . $catId); //devuelve a la pág ListSentence
}

class Sentence {

    public $id;
    public $english;
    public $spanish;
    public $catId;

    function __construct() {
        
    }

    public function setPars($id, $english, $spanish, $catId) {
        $this->id = $id;
        $this->english = $english;
        $this->spanish = $spanish;
        $this->catId = $catId;
    }

    public function select($idCat) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT id,english,spanish,category_id FROM sentence WHERE category_id=$idCat");
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        $num = 0;
        while ($row = pg_fetch_row($result)) { //recuperar fila de un resultado
            $id = $row[0];
            $english = $row[1];
            $spanish = $row[2];
            $catId = $row[3];
            $sentence = new Sentence();
            $sentence->setPars($id, $english, $spanish, $catId);
            $sentences[$num] = $sentence;
            $num++;
        }
        return $sentences;
    }

    public function selectRamdomlyByCat($idCat, $numPhra) {
        $sentences = $this->select($idCat);
        $randomNumList;
        $randomSentences;
        $repeated;
        for ($i = 0; $i < $numPhra; $i++) {
            do {
                $randNum = rand(0, count($sentences) - 1); //numero random
                $repeated = $this->isRepeated($randNum, $randomNumList);
                if (!$repeated) {
                    $randomNumList[$i] = $randNum;
                }
            } while ($repeated);
            $randomSentences[$i] = $sentences[$randomNumList[$i]];
        }
        return $randomSentences;
    }

    public function isRepeated($randNum, $randNumList) {
        for ($j = 0; $j < count($randNumList); $j++) { //por cada numero de los que ya están se lo compara
            if ($randNum == $randNumList[$j]) {
                return true;
            }
        }
        return false;
    }

    public function getDataToEdit($idD) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "SELECT id,english,spanish,category_id FROM sentence WHERE id=" . $idD);
        $sentence = new Sentence(pg_fetch_row($result)[0], pg_fetch_row($result)[1], pg_fetch_row($result)[2], pg_fetch_row($result)[3]);
        return $sentence;
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

    public function insert($english, $spanish, $catId) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "INSERT INTO sentence(english,spanish,category_id) VALUES('$english','$spanish',$catId)");
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
        return $result;
    }

    public function edit($english, $spanish, $categId, $idE) {
        $connect = new DBConnect();
        $result = pg_query($connect->getDB(), "UPDATE sentence SET english='" . $english . "',spanish='" . $spanish . "',category_id=" . $categId . " WHERE id=" . $idE);
        if (!$result) {
            echo "Ha ocurrido un error.\n";
            exit;
        }
    }

}

/*
 * 
 * 
 *  public function selectRamdomlyByCat($idCat, $numPhra) {
        $sentences = $this->select($idCat);
        $randomNumList;
        $randomSentences;
        for ($i = 0; $i < $numPhra; $i++) {
            do {
                $repeated = false;
                
                $randNum = rand(0, count($sentences) - 1); //numero random
                
                $repeated = isRepeated($randNum, $randomNumList);
                if ($repeated == false) {
                    $randomNumList[$i] = $randNum;
                }
            } while ($found == true);

            $randomSentences[$i] = $sentences[$randomNumList[$i]];
        }
        return $randomSentences;
    }

 */
