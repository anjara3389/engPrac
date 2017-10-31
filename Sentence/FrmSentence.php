<?php
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
    <body>
        <form action=<?php
        if ($isNew) {
            echo "./Sentence.php?func=insert";
        } else {
            echo "./Sentence.php?func=edit";
        }
        ?> method="POST">
            <table>
                <tr>
                    <?php if (!$isNew) { ?> 
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <?php } ?>
                <td>Oración:</td> 
                <td><input type="text" name="name" id="name" value="<?php echo $name; ?>"></td> 
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

