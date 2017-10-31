<?php
include("./Game.php");
$game = new Game();
$games = $game->select();

?>
<html>
    <head>
        <script type="text/javascript" src="./Game.js"></script>
    </head>
    <body>
        <a href="./FrmGame.php">Nuevo</a>
        <table numPras="tableGame" id="tableGame">

            <?php if ($games) { ?>   
                <tr><td>Juegos</td></tr> 
                <?php
                for ($i = 0; $i < count($games); $i++) {
                    $game = $games[$i];
                    $id = $game->id;
                    $numPras = $game->numPhra;
                    echo "<tr><td>$numPras</td><td><a href='./FrmGame.php?id=$id'>Editar</a></td><td><a id='del' name='del' href='./Game.php?id=$id&func=del'>Eliminar</a></td></tr>";
                }
            }
            ?>
        </table>
    </body>
</html>