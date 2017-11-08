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
    $english = $sentence->getDataToEdit($id)->english;
    $spanish = $sentence->getDataToEdit($id)->spanish;
}
$category = new Category();
?>
<html>
    <head>
        <title>Oraciones</title>

        <script src="../jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#ok").click(function () {
                    if ($("#english").val() == '') {
                        alert('Escriba oración en inglés');
                        return;
                    }
                    if ($("#spanish").val() == '') {
                        alert('Escriba oración en español');
                        return;
                    }
                     $("#sentForm").submit();
                });
            });


        </script>
    </head>
    <body>
        <form id="sentForm" name="sentForm" action=<?php
        if ($isNew) {
            echo "./Sentence.php?funcSe=insert";
        } else {
            echo "./Sentence.php?funcSe=edit";
        }
        ?> method="POST" >
            <br>
            <br>
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
            <br>
            <br>
            <button id="ok" name="ok" type="button" class="btn btn-default">Guardar</button>
        </form>
    </body>
</html>

