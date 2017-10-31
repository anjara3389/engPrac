<?php
include("./Category.php");
$categ = new Category();
$categories = $categ->select();
?>
<html>
    <head>
        <script type="text/javascript" src="./Category.js"></script>
        <script type = "text/javascript"  src = "../jQuery/jquery-2.1.3.min.js"></script>
    </head>
    <body>
        <a href="./FrmCategory.php">Nuevo</a>
        <table name="tableCat" id="tableCat">
            <?php if ($categories) { ?>   
                <tr>
                    <td>Categoría</td>
                </tr>
                <?php
                for ($i = 0; $i < count($categories); $i++) {
                    $category = $categories[$i];
                    $id = $category->id;
                    $name = $category->name;
                    echo "<tr><td>$name</td><td><a href='./FrmCategory.php?id=$id'>Editar</a></td><td><a id='del' name='del' href='./Category.php?id=$id&func=del' onclick='javascript:deleteConfirmation($id);'>Eliminar</a></td></tr>";
                }
            }
            ?>
        </table>
    </body>
    <script type="text/javascript">
        function deleteConfirmation(idD) {
            if (confirm("Desea eliminar la categoría?")) {
                Category cat = new Category();
                cat.delete(idD)
            }
        }
    </script>
</html>

