<?php
include("../Menu/Menu.php");
include("./Sentence.php");
include("../Category/Category.php");
include("../GameSentence/GameSentence.php");

$sentence = new Sentence();
$idCat = $_GET['categ'];
$sentences = $sentence->select($idCat);
$categ = new Category();
$categ = $categ->getDataToEdit($idCat);
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

            <h2><?php echo "Oraciones " . $categ; ?></h2>
            <br>
            <a class="btn btn-default" href=<?php echo "./FrmSentence.php?categ=$idCat"; ?>>Nueva</a>
            <br>
            <br>
            <table numPras="tableSentence" id="tableSentence" class="table table-striped">

                <?php if ($sentences) { ?>   
                    <thead>
                        <tr>
                            <th>Inglès</th>
                            <th>Español</th>
                            <th>Aciertos</th>
                            <th>Juegos</th>
                            <th colspan="3">Opciones</th>
                        </tr>
                    <thead> 
                        <?php
                        for ($i = 0; $i < count($sentences); $i++) {
                            $sentence = $sentences[$i];
                            $id = $sentence->id;
                            $english = $sentence->english;
                            $spanish = $sentence->spanish;
                            $catId = $sentence->catId;
                            $gamSe = new GameSentence();
                            $resut = $gamSe->getStatistics($id);
                            echo "<tr><td>$english</td><td>$spanish</td><td>$resut[1]</td><td>$resut[0]</td><td><a href='./FrmSentence.php?id=$id&categ=$catId'>Editar</a></td><td><a id='del' name='del' onClick='javascript:deleteConfirmation($id,$catId)'>Eliminar</a></td></tr>";
                        }
                    }
                    ?>
            </table>
        </div>
    </body>
    <script type="text/javascript">
        function deleteConfirmation(idD, catId) {
            if (confirm("Desea eliminar la oración?")) {
                window.location = "./Sentence.php?id=" + idD + "&cat=" + catId + "&funcSe=del";
            }
        }
    </script>
</html>