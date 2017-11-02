<?php
include("../Menu/Menu.php");
$name = "";
$isNew = !isset($_GET['id']);
include("./Category.php");
if (!$isNew) {
    $id = $_GET['id'];
    $categ = new Category();
    $name = $categ->getDataToEdit($id);
}
?>
<html>
    <body>
        <form action=<?php
        if ($isNew) {
            echo "./Category.php?func=insert";
        } else {
            echo "./Category.php?func=edit";
        }
        ?> method="POST">
            <h2>Agregar categoría</h2>
            <br>
            <br>

            <?php if (!$isNew) { ?> 
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <?php } ?>      
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text"  class="form-control" name="name" id="name" value="<?php echo $name; ?>">
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-default">Guardar</button>


        </form>


    </body>

</html>

