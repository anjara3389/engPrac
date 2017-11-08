<?php

include("./Category.php");
if (isset($_POST['name'])) {
    $category = new Category();
    $name = $_POST['name'];
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    $answ = $category->validateName($name, isset($_POST['id']) ? $id : null);
    if ($answ) {
        echo json_encode(array('right' => $answ));
    } else {
        echo json_encode(array('right' => $answ, 'excep' => 'El nombre propocionado ya pertenece a otra categoría'));
    }
}

