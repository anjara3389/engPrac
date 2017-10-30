<?php
$name="";
$isNew = !isset($_GET['id']);
include("./Category.php");
if (!$isNew) {
    $id = $_GET['id'];
    $categ=new Category();
    $name=$categ->getDataToEdit($id);
}
?>
<html>
    <body>
        <form action=<?php if($isNew){ echo "./Category.php?func=insert";} else{ echo "./Category.php?func=edit";}?> method="POST">
            <table>
                <tr>
                    <?php if(!$isNew){ ?> 
                   <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <?php } ?>
                    <td>Nombre:</td> 
                    <td><input type="text" name="name" id="name" value="<?php echo $name; ?>"></td> 
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Guardar</button></td> 
                </tr>
            </table>
        </form>


    </body>

</html>

