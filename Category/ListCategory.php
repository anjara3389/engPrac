<?php
include("../Menu/Menu.php");
include("./Category.php");

$categ = new Category();
$categories = $categ->select();
?>
<html>
    <body>
        <div class="container">
            <h2>Categorías</h2>
            <br>
            <a class="btn btn-default" href="./FrmCategory.php">Nueva</a>
            <br>
            <br>
            <table name="tableCat" id="tableCat" class="table table-striped">
                <?php if ($categories) { ?>   
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    <thead>
                        <?php
                        for ($i = 0; $i < count($categories); $i++) {
                            $category = $categories[$i];
                            $id = $category->id;
                            $name = $category->name;
                            echo "<tr><td>$name</td><td><a href='./FrmCategory.php?id=$id'>Editar</a></td><td><a id='del' name='del' onclick='javascript:deleteConfirmation($id);'>Eliminar</a></td></tr>";
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

