<?php
include("../Menu/Menu.php");
include("../Sentence/Sentence.php");
include("../Game/Game.php");

$game = new Game();
$currGame = $_GET['gameId'];

//$numPhra;
//$catId;
//$index;
//$numPhra = $_GET['numPhra'];
//$catId = $_GET['cat'];
//$index = 0;
//$sentence = new Sentence();
//$phrases = $sentence->selectRamdomlyByCat($catId, $numPhra);

function answer($right) {
    //$GLOBALS['index'] = $GLOBALS['index'] ++;
    //$phrase = $GLOBALS['phrases'][$GLOBALS['index']]->spanish;
    //echo "javascript:reload($phrase,1);";
}
?>
<html>
    <head> <link href="../Css/MyStyle.css" rel="stylesheet" type="text/css"></head>
    <body>
        <div class="game">
            <br>
            <br>
            <table>
                <tr><td colspan="4"><div id="spani" name="spani"></div></td></tr>
                <tr><td><br> </td></tr>
                <tr><td><button id="right" name="right" class="btn btn-default btn-lg" onclick="<?php //answer(true); ?>"><span class="glyphicon glyphicon-ok"></span> Bien </button></td>
                    <td><button class="btn btn-default btn-lg gamer" id="ans" colspan="2" name="ans"><p class="an">Respuesta</p></button></td>
                    <td><button class="btn btn-default btn-lg" id="wrong" name="wrong" onclick="<?php //answer(false); ?>"><span class="glyphicon glyphicon-remove"></span> Mal </button></td></tr>
                <tr><td><br> </td></tr>
                <tr><td colspan="4"><h2  class="game" id="engl" name="engls"><?php// echo $phrases[$index]->english; ?></h2></td></tr>
            </table>
        </div>
    </body>
    <script type="text/javascript">



        function reload(phrase, language) {
            var id = language == 1 ? "spani" : "engls"; // el div que quieres actualizar!
            var url = "./Spanish.php?phrase=" + phrase;//a donde se va a dirigir
            var xmlHttp; // The XMLHttpRequest object
            try {
                xmlHttp = new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
            } catch (e) {
                try {
                    xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
                } catch (e) {
                    try {
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        alert("Tu explorador no soporta AJAX.");
                        return false;
                    }
                }
            }
            xmlHttp.onreadystatechange = function () {
                if (xmlHttp.readyState == 4 && xmlHttp.readyState != null) {
                    document.getElementById(id).innerHTML = xmlHttp.responseText;
                }
            }
            xmlHttp.open("GET", url, true);
            xmlHttp.send(null);
        }
    </script>


</html>

