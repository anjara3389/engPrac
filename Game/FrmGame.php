<?php
$numPhra = "";
$isNew = !isset($_GET['id']);
include("../Menu/Menu.php");
include("./Game.php");
include("../Category/Category.php");
if (!$isNew) {
    $id = $_GET['id'];
    $game = new Game();
    $numPhra = $game->getDataToEdit($id)[0];
    $catId = $game->getDataToEdit($id)[1];
}
$category = new Category();
$categories = $category->select();
?>
<html>
    <body>
        <form action=<?php
        if ($isNew) {
            echo "./Game.php?func=insert";
        } else {
            echo "./Game.php?func=edit";
        }
        ?> method="POST">

            <?php if (!$isNew) { ?> 
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <?php } ?>
            <h2>Nuevo juego</h2>
            <br>
            <br>
            <div class="form-group">
                <label for="numPhra">Num. Oraciones:</label>
                <input type="number" name="numPhra" class="form-control"id="numPhra" value="<?php echo $numPhra; ?>">
            </div>
            <div class="form-group">
                <label for="cat">Categoría</label>
                <select name="cat" id="cat" class="form-control" value="<?php echo $catId; ?>" >
                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                        <option value="<?php echo $categories[$i]->id; ?>"><?php echo $categories[$i]->name; ?></option>
                    <?php } ?>
                </select>
            </div>

            <br>
            <br>
            <button type="submit" class="btn btn-default">Iniciar</button>

        </form>


    </body>

</html>

