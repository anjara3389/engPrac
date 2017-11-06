<?php
$numPhra = "";
include("../Menu/Menu.php");
include("./Game.php");
include("../Category/Category.php");
$category = new Category();
$categories = $category->select();
?>
<html>
    <body>
        <form action=<?php echo "./Game.php?func=insert";?> method="POST">
            <h2>Nuevo juego</h2>
            <br>
            <br>
            <div class="form-group">
                <label for="numPhra">Num. Oraciones:</label>
                <input type="number" name="numPhra" class="form-control"id="numPhra">
            </div>
            <div class="form-group">
                <label for="cat">Categoría</label>
                <select name="cat" id="cat" class="form-control">
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

