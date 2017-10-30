<?php
$name="";
$isNew = !isset($_GET['id']);
include("./Game.php");
include("../Category/Category.php");

if (!$isNew) {
    $id = $_GET['id'];
    $game=new Game();
    $nSentenc=$game->getDataToEdit($id);
}
?>
<html>
    <body>
        <form action=<?php if($isNew){ echo "./Category.php?func=insert";} else{ echo "./Category.php?func=edit";}?> method="POST">
            <table>
                <tr>
                    <?php if(!$isNew){ ?> 
                   <input type="hidden" name="idGame" id="idGame" value="<?php echo $id; ?>">
                    <?php } ?>
                    <td>N° de Oraciones:</td> 
                    <td><input type="number" name="nSentenc" id="nSentenc" value="<?php echo $nSentenc; ?>"></td> 
                    <td>Categoría:</td> 
                    <td><select id="categ" name="categ" >
                            <option value="0">Select Manufacturer</option>
                            <option value="1">--Any--</option>
                            <option value="2">Toyota</option>
                            <option value="3">Nissan</option>
                        </select></td> 
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Guardar</button></td> 
                </tr>
            </table>
        </form>


    </body>

</html>

