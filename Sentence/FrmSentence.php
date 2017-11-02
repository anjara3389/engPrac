<?php
include("../Menu/Menu.php");
$english = "";
$spanish = "";
$isNew = !isset($_GET['id']);
$catId = $_GET['categ'];
include("./Sentence.php");
include("../Category/Category.php");
if (!$isNew) {
    $id = $_GET['id'];
    $sentence = new Sentence();
    $english = $sentence->getDataToEdit($id)[0];
    $spanish = $sentence->getDataToEdit($id)[1];
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
            <input type="hidden" name="cat"  id="cat" value="<?php echo $catId; ?>">
            <?php if (!$isNew) { ?> 
                <input type="hidden" name="id"  id="id" value="<?php echo $id; ?>">
            <?php } ?>
            <div class="form-group">
                <label for="english">Oración Inglés:</label>
                <input type="text" name="english" class="form-control" placeholder="Ingrese oración en inglés" id="english" value="<?php echo $english; ?>">
            </div>
                <div class="form-group">
                <label for="name">Oración Español:</label>
                <input type="text" name="spanish" class="form-control" placeholder="Ingrese oración en español" id="spanish" value="<?php echo $spanish; ?>">
            </div>
         <!--   <div class="form-group">
                <label for="cat">Categoría:</label>
                <select name="cat" id="cat" class="form-control">
                //    <?php //for ($i = 0; $i < count($categories); $i++) { ?>
                    <option value="<?php// echo $categories[$i]->id; ?>" <?php// if($catId==$categories[$i]->id){echo "selected";} ?>><?php //echo $categories[$i]->name; ?></option>
                    <?php// } ?>
                </select>
            </div> -->
            <br>
            <br>
            <button type="submit" class="btn btn-default">Guardar</button>
        </form>
    </body>
</html>

