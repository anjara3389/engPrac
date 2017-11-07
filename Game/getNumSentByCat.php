<?php

include("../Category/Category.php");
$catId = "";
if (isset($_POST['categ'])) {
    $category = new Category();
    $catId = $_POST['categ'];
    $numSent = $category->getNumSentences($catId);
    echo json_encode(array('numSent' => $numSent));
}