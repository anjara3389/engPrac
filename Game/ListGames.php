<?php

include("./Category.php");
$categ=new Category();
$result=$categ->select();

if (!$result) {
    echo "No hay datos.\n";
    exit;
}
?>
<html>
    <body>
        <a href="./FrmCategory.php">Nuevo</a>
        <table>
            <tr>
                <td>Categoría</td>
            </tr>
             <?php
                while ($row = pg_fetch_row($result)) {//recuperar fila de un resultado
                    $id=$row[0];
                    $name=$row[1];
                    echo "<tr><td>$name</td><td><a href='./FrmCategory.php?id=$id'>Editar</a></td><td><a href='./Category.php?id=$id&func=del'>Eliminar</a></td></tr>";
                }
                ?>
        </table>
    </body>
</html>