<?php
include("../Menu/Menu.php");
include("../Sentence/Sentence.php");
$numPhra = $_GET['numPhra'];
$catId = $_GET['cat'];
$sentence = new Sentence();
$phases = $sentence->selectRamdomlyByCat($catId, $numPhra);
$index = 0;

function rightAnswer($index) {
    $index++;
    header('Location:./StartGame.php?$numPhra=' . $numPhra . '&cat=' . $catId);
}

function wrongAnswer($index) {
    $index++;
    header('Location:./StartGame.php?$numPhra=' . $numPhra . '&cat=' . $catId);
}
?>
<html>
    <head> <link href="../Css/MyStyle.css" rel="stylesheet" type="text/css"></head>
    <body>
        <div class="game">
            <br>
            <br>
            <table>
                <tr><td colspan="4"><h2  class="game"id="spani" name="spani"><?php echo $phases[$index]->spanish; ?></h2></td></tr>
                <tr><td><br> </td></tr>
                <tr><td><button id="right" name="right" class="btn btn-default btn-lg" onclick="<?php rightAnswer($index); ?>"><span class="glyphicon glyphicon-ok"></span> Bien </button></td>
                    <td><button class="btn btn-default btn-lg gamer" id="ans" colspan="2" name="ans"><p class="an">Respuesta</p></button></td>
                    <td><button class="btn btn-default btn-lg" id="wrong" name="wrong" onclick="<?php wrongAnswer($index); ?>"><span class="glyphicon glyphicon-remove"></span> Mal </button></td></tr>
                <tr><td><br> </td></tr>
                <tr><td colspan="4"><h2  class="game" id="engl" name="engls"><?php echo $phases[$index]->english; ?></h2></td></tr>
            </table>
        </div>
    </body>

    
</html>

