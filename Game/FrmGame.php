<?php
$numPhra = "";
$isNew = !isset($_GET['id']);
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
            <table>
                <tr>
                    <?php if (!$isNew) { ?> 
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <?php } ?>
                <td>Num. Oraciones:</td> 
                <td><input type="numeric" name="numPhra" id="numPhra" value="<?php echo $numPhra; ?>"></td> 
                <td>Categoría</td> 
                <td>
                    <select name="cat" id="cat" value="<?php echo $catId; ?>" >
                        <?php for ($i = 0; $i < count($categories); $i++) { ?>
                            <option value="<?php echo $categories[$i]->id; ?>"><?php echo $categories[$i]->name; ?></option>
                        <?php } ?>
                    </select>
                </td> 
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Guardar</button></td> 
                </tr>
            </table>
        </form>


    </body>

</html>

