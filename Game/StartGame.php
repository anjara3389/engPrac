<?php
include("../Menu/Menu.php");
include("../Sentence/Sentence.php");
include("../Game/Game.php");

$game = new Game();
$currGame = $_GET['gameId'];
$numPhra = $_GET['numPhra'];


$gameSenten = new GameSentence();
$nextGameSent = $gameSenten->getNextGameSentence($currGame);
$sent = new Sentence();
$nextSentence = $sent->getDataToEdit($nextGameSent->sentenceId);
?>
<html>
    <head> <link href="../Css/MyStyle.css" rel="stylesheet" type="text/css">
        <script src="../jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#engls").hide();
                $("#btnRight").attr("disabled", "disabled");
                $("#btnWrong").attr("disabled", "disabled");
                $("#btnRight").click(function () {
                    var req = {
                        gameId: $("#currGame").val(),
                        right: "true",
                        numPhra: $("#numPhra").val()
                    }
                    $.ajax({
                        url: 'nextQuestion.php',
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            $('#nextQuest').val(data.nextQue);
                            $('#spani').html(data.spanish);
                            $('#engls').html(data.english);
                            $('#numPhra').val(data.numP);
                            $("#btnRight").attr("disabled", "disabled");
                            $("#btnWrong").attr("disabled", "disabled");
                            $("#engls").hide();
                            if ($("#numPhra").val() == 0) {
                                alert("Fin del Juego \n \n Puntuación: \n \n" + data.rightAns + " de " + data.total);
                                $("#btnAns").attr("disabled", "disabled");

                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert("Error: " + jqXHR + ", " + textStatus + ", " + errorThrown);
                        },
                        data: req
                    });

                });
                $("#btnWrong").click(function () {
                    var req = {
                        gameId: $("#currGame").val(),
                        right: "false",
                        numPhra: $("#numPhra").val()
                    }
                    $.ajax({
                        url: 'nextQuestion.php',
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            $('#nextQuest').val(data.nextQue);
                            $('#spani').html(data.spanish);
                            $('#engls').html(data.english);
                            $('#numPhra').val(data.numP);

                            $("#btnRight").attr("disabled", "disabled");
                            $("#btnWrong").attr("disabled", "disabled");
                            $("#engls").hide();
                            if ($("#numPhra").val() == 0) {
                                alert("FIN DEL JUEGO \n \n Puntuación: \n \n" + data.rightAns + " de " + data.total);
                                $("#btnAns").attr("disabled", "disabled");
                            }
                        }, error: function (jqXHR, textStatus, errorThrown) {
                            alert("Error: " + jqXHR + ", " + textStatus + ", " + errorThrown);
                        },
                        data: req
                    });
                });
                $("#btnAns").click(function () {
                    $("#engls").show();
                    $("#btnRight").removeAttr("disabled");
                    $("#btnWrong").removeAttr("disabled");
                });
            });


        </script>

    </head>
    <body>
        <div class="game">
            <br>
            <br>
            <table>
                <input type="hidden" id="numPhra" name="numPhra" value="<?php echo $numPhra; ?>">
                <input type="hidden" id="currGame" name="currGame" value="<?php echo $currGame; ?>">
                <input type="hidden" id="nextQuest" name="nextQuest" >

                <tr><td colspan="4"><h2 class="game" id="spani" name="spani"><?php echo $nextSentence->spanish; ?></h2></td></tr>
                <tr><td><br> </td></tr>
                <tr><td><button id="btnRight" name="btnRight" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-ok"></span> Bien </button></td>
                    <td><button class="btn btn-default btn-lg gamer" id="btnAns" colspan="2" name="btnAns"><p class="an">Respuesta</p></button></td>
                    <td><button class="btn btn-default btn-lg" id="btnWrong" name="btnWrong"><span class="glyphicon glyphicon-remove"></span> Mal </button></td></tr>
                <tr><td><br> </td></tr>
                <tr><td colspan="4"><h2  class="game" id="engls" name="engls"><?php echo $nextSentence->english; ?></h2></td></tr>
            </table>
        </div>
    </body>
</html>

