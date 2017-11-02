<?php
ob_start();
?>
<html>
    <head>
        <title>English Practice</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compa]ble" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <link href="../Css/MyStyle.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <!--navbar-toggle collapsed significa activación-contraido,data-target=#navbar es que cuando el botón sea presionado entonces que use el div con el id navbar(target=objetivo)-->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <!--estas son solamente las tres barritas del botón (DISEÑO)-->
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">English Practice</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav"><!--unsorted list -->
                        <li class="dropdown"><!--DROPDOWN(DESPLEGABLE)-->
                            <!--Item MENÚ desde donde se desplegará nuestro menú desplegable con click,span class="caret" significa que se usa el icono del triangulito en el menú-->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Juego<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../Game/FrmGame.php">Nuevo</a></li>
                                <li><a href="../Category/ListCategory.php">Categorías</a></li>
                                <li><a href="../Sentence/ListSentences.php">Listados</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Estadísticas</a></li>
                            </ul>
                        </li>   <!--fin lista desplegable dropdown-->
                    </ul> 
                </div> 
            </div>
        </nav> <!--fin de la navbar-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../Bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
echo ob_get_clean();
?>

