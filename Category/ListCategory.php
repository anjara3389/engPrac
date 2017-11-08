<?php
include("../Menu/Menu.php");
include("./Category.php");

$categ = new Category();
$categories = $categ->select(false);
?>
<html>
    <body>
        <div class="container">
            <h2>Categorías</h2>
            <br>
            <a class="btn btn-default" href="./FrmCategory.php"><span class='glyphicon glyphicon-plus'></span> Nueva</a>
            <br>
            <br>
            <table name="tableCat" id="tableCat" class="table table-striped">
                <?php if ($categories) { ?>   
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th colspan="3">Opciones</th>
                        </tr>
                    <thead>
                        <?php
                        for ($i = 0; $i < count($categories); $i++) {
                            $category = $categories[$i];
                            $id = $category->id;
                            $name = $category->name;
                            echo "<tr><td>$name</td><td><a href='../Sentence/ListSentences.php?categ=$id'><span class='glyphicon glyphicon-th-list'></span> Oraciones</a></td><td><a href='./FrmCategory.php?id=$id'><span class='glyphicon glyphicon-pencil'></span> Editar</a></td><td><a id='del' name='del' onclick='javascript:deleteConfirmation($id);'><span class='glyphicon glyphicon-remove'></span> Eliminar</a></td></tr>";
                        }
                    }
                    ?>
            </table>
        </div>
    </body>
    <script type="text/javascript">
        function deleteConfirmation(idD) {
            if (confirm("Desea eliminar la categoría?")) {
                window.location = "./Category.php?id=" + idD + "&func=del";
            }
        }
    </script>
</html>

