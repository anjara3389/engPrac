<?php
include("../Menu/Menu.php");
include("../Sentence/Sentence.php");
include("../Game/Game.php");

$game = new Game();
$currGame = $_GET['gameId'];
echo $currGame;
?>
<html>
    <head> <link href="../Css/MyStyle.css" rel="stylesheet" type="text/css">
        <script src="../jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#btnRight").click(function () {
                    alert("right");
                    var req = {
                        gameId: $("#currGame").val(),
                        right: "true"
                    }
                    $.ajax({
                        url: 'nextQuestion.php',
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            alert("HEEEY");
                            $('#currGame').html(data.nextQue);
                            //$('#spani').html(data.spanish);
                            //$('#engls').html(data.english);
                        },
                        data: req
                    });
                });

                $("#btnWrong").click(function () {
                    alert("wrong");
                    var req = {
                        gameId: $("#currGame").val(),
                        right: "false"
                    }
                    $.ajax({
                        url: 'nextQuestion.php',
                        type: 'post',
                        dataType: 'json',
                        success: function (data) {
                            $('#nextQuest').html("here"+data.nextQue);
                            // $('#spani').html(data.spanish);
                            //$('#engls').html(data.english);
                        },
                        data: req
                    });
                });
            });


        </script>

    </head>
    <body>
        <div class="game">
            <br>
            <br>
            <table>
                <input type="text" id="currGame" name="currGame" value="<?php echo $currGame; ?>">
                <input type="text" id="nextQuest" name="nextQuest" >
                <tr><td colspan="4"><div id="spani" name="spani">[res]</div></td></tr>
                <tr><td><br> </td></tr>
                <tr><td><button id="btnRight" name="btnRight" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-ok"></span> Bien </button></td>
                    <td><button class="btn btn-default btn-lg gamer" id="ans" colspan="2" name="ans"><p class="an">Respuesta</p></button></td>
                    <td><button class="btn btn-default btn-lg" id="btnWrong" name="btnWrong"><span class="glyphicon glyphicon-remove"></span> Mal </button></td></tr>
                <tr><td><br> </td></tr>
                <tr><td colspan="4"><div  class="game" id="engls" name="engls">[res]</div></td></tr>
            </table>
        </div>
    </body>
</html>

