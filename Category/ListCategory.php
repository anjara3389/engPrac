<?php
include("./Category.php");
$categ = new Category();
$categories = $categ->select();

if (!$result) {
    echo "No hay datos.\n";
    exit;
}
?>
<html>
    <head>
        <script type="text/javascript" src="./Category.js"></script>
    </head>
    <body>
        <a href="./FrmCategory.php">Nuevo</a>
        <table name="tableCat" id="tableCat">
            <tr>
                <td>Categoría</td>
            </tr>
            <?php
            for ($i = 0; $i < $categories; $i++) {
                $id = $categories[$i]->id;
                $name = $categories[$i]->name;
                echo "<tr><td>$name</td><td><a href='./FrmCategory.php?id=$id'>Editar</a></td><td><a id='del' name='del' href='./Category.php?id=$id&func=del'>Eliminar</a></td></tr>";
            }
            ?>
        </table>
    </body>
</html>