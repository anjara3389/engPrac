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
    <head>
        <script src="../jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function () {

                $("#ok").click(function () {
                    if ($("#name").val() == '') {
                        alert('Escriba nombre');
                        return;
                    }
                    $("#catForm").submit();

                });
            });


        </script>


    </head>
    <body>
        <form id="catForm" name="catForm" action=<?php
        if ($isNew) {
            echo "./Category.php?func=insert";
        } else {
            echo "./Category.php?func=edit";
        }
        ?> method="POST">
            <br>
            <br>
            <h2>Agregar categoría</h2>
            <br>
            <br>

            <?php if (!$isNew) { ?> 
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <?php } ?>      
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text"  class="form-control" name="name" placeholder="Ingrese un nombre" id="name" value="<?php echo $name; ?>">
            </div>
            <br>
            <br>
            <button id="ok" type="button" name="ok" class="btn btn-default">Guardar</button>
        </form>




    </body>

</html>

