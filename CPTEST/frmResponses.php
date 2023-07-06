<?php
require_once( 'module_test.php' );
$codeTest = $_REQUEST[ 'test' ];
$codeAnswer = $_REQUEST[ 'answer' ];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Test</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Gestor de Respuestas</span>
    </div>
    </nav>
    <br><br>
    <main class="container">
    <div class="bg-body-tertiary p-5 rounded">
        <button class="btn btn-info" onclick="window.history.back();">Regresar</button>
        <br>
        <h1>Gestion de Respuestas</h1>
        <p class="lead">En esta pantalla se podran crear las Respuestas</p>
        <form>
            <div class="mb-3">
                <input type="hidden" name="codeTest" id="codeTest" value="<?= $codeTest ?>">
                <input type="hidden" name="codeAnswer" id="codeAnswer" value="<?= $codeAnswer ?>">

                <label for="exampleInputEmail1" class="form-label">Respuesta</label>
                <input type="text" class="form-control" id="reponse">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tipo</label>
                <select name="" id="type" class="form-control">
                    <option value="">Seleccione</option>
                    <option value="1">Correcta</option>
                    <option value="0">Incorrecta</option>

                </select>
            </div>
        </form>
        <a class="btn btn-lg btn-success" id="save" role="button" onclick="save()">Grabar</a>

    </div>
    <br><br>
    <div>
        <h3>Listado de Respuestas</h3>
        <br>
        <div id="container-table"></div>
    </div>
    </main>
    <script src="../ASSETS/JS/modules/response.js"></script>
    <script>
            window.addEventListener( 'load', ()=>{
                table();
            } );
        </script>
</body>

</html>
