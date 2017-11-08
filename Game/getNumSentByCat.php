<?php

//funciona al ejecutar el ajax de la clase FrmGame. Recibe id de categoría envía como json el número de oraciones
include("../Category/Category.php");
$catId = "";
if (isset($_POST['categ'])) {
    $category = new Category();
    $catId = $_POST['categ'];
    $numSent = $category->getNumSentences($catId);
    echo json_encode(array('numSent' => $numSent));
}