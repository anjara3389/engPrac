<?php
include("./Sentence.php");
$sentence = new Sentence();
$sentences = $sentence->select();

?>
<html>
    <head>
        <script type="text/javascript" src="./Sentence.js"></script>
    </head>
    <body>
        <a href="./FrmSentence.php">Nuevo</a>
        <table numPras="tableSentence" id="tableSentence">

            <?php if ($sentences) { ?>   
                <tr><td>Oraciones</td></tr> 
                <?php
                for ($i = 0; $i < count($sentences); $i++) {
                    $sentence = $sentences[$i];
                    $id = $sentence->id;
                    $name = $sentence->name;
                    echo "<tr><td>$name</td><td><a href='./FrmSentence.php?id=$id'>Editar</a></td><td><a id='del' name='del' href='./Sentence.php?id=$id&func=del'>Eliminar</a></td></tr>";
                }
            }
            ?>
        </table>
    </body>
</html>