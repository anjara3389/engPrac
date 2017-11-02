<?php
include("../Menu/Menu.php");
include("./Sentence.php");
$sentence = new Sentence();
$sentences = $sentence->select();
?>
<html>
    <head>
        <script type="text/javascript" src="./Sentence.js"></script>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compa]ble" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>Oraciones</h2>
            <br>
            <a class="btn btn-default" href="./FrmSentence.php">Nuevo</a>
            <br>
            <br>
            <table numPras="tableSentence" id="tableSentence" class="table table-striped">

                <?php if ($sentences) { ?>   
                    <thead>
                        <tr>
                            <th>Oraciones</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    <thead> 
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
        </div>
    </body>
</html>