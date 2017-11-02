<?php
include("../Menu/Menu.php");
$name = "";
$isNew = !isset($_GET['id']);
include("./Sentence.php");
include("../Category/Category.php");
if (!$isNew) {
    $id = $_GET['id'];
    $sentence = new Sentence();
    $name = $sentence->getDataToEdit($id)[0];
    $catId = $sentence->getDataToEdit($id)[1];
}
$category = new Category();
$categories = $category->select();
?>
<html>
    <head>
        <title>Oraciones</title>
    </head>
    <body>
        <form action=<?php
        if ($isNew) {
            echo "./Sentence.php?func=insert";
        } else {
            echo "./Sentence.php?func=edit";
        }
        ?> method="POST" >
            <h2>Agregar oración</h2>
            <br>
            <br>
            <?php if (!$isNew) { ?> 
                <input type="hidden" name="id"  id="id" value="<?php echo $id; ?>">
            <?php } ?>
            <div class="form-group">
                <label for="name">Oración:</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="cat">Categoría:</label>
                <select name="cat" id="cat" class="form-control" value="<?php echo $catId; ?>" >
                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                        <option value="<?php echo $categories[$i]->id; ?>"><?php echo $categories[$i]->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-default">Guardar</button>
        </form>
    </body>
</html>

