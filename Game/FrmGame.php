<?php
$numPhra = "";
include("../Menu/Menu.php");
include("./Game.php");
include("../Category/Category.php");
$category = new Category();
$categories = $category->select(true);
?>
<html>
    <head>
        <script src="../jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function () {
                var req = {
                    categ: $("#cat").val(),
                }

                $.ajax({
                    url: 'getNumSentByCat.php',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        $('#maxi').html(data.numSent);
                        $('#numPhra').attr(data.numSent);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error: " + jqXHR + ", " + textStatus + ", " + errorThrown);
                    },
                    data: req
                });
                $("#start").click(function () {
                    if ($("#numPhra").val() == '') {
                        alert('Escriba núm. de oraciones');
                        return;
                    }
                    if ($("#numPhra").val() > $("#maxi").html()) {
                        alert('El valor ingresado excede num. de oraciones existentes');
                        return;
                    }
                    if ($("#numPhra").val() <= 0) {
                        alert('Número no válido');
                        return;
                    }
                    $("#formGame").submit();
                });
                $("#cat").change(function () {
                    var req = {
                        categ: $("#cat").val(),
                    }
                    $.ajax({
                        url: 'getNumSentByCat.php',
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            $('#maxi').html(data.numSent);
                            $('#numPhra').attr(data.numSent);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert("Error: " + jqXHR + ", " + textStatus + ", " + errorThrown);
                        },
                        data: req
                    });
                });
            });


        </script>
    </head>
    <body>
        <form id="formGame" name="formGame" action=<?php echo "./Game.php?func=insert"; ?> method="POST">
            <br>
            <br>
            <h2>Nuevo juego</h2>
            <br>
            <br>
            <div class="form-group">
                <label for="cat">Categoría</label>
                <select name="cat" id="cat" class="form-control">
                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                        <option value="<?php echo $categories[$i]->id; ?>"><?php echo $categories[$i]->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="numPhra">Num. Oraciones:</label>
                <input type="number" name="numPhra" min="1" max="<?php echo $category->getNumSentences($catId); ?>" placeholder="Ingrese número de oraciones" class="form-control"id="numPhra">Max. <p id="maxi" name="maxi">[Max]</p>

            </div>
            <br>
            <br>
            <button name="start" id="start" type="button" class="btn btn-default">Iniciar</button>
        </form>
    </body>

</html>

