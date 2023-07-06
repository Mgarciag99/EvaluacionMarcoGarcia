<?php
require_once( 'module_test.php' );

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
        <span class="navbar-brand mb-0 h1">Gestor de Examenes</span>
    </div>
    </nav>
    <br><br>
    <main class="container">
    <div class="bg-body-tertiary p-5 rounded">
        <h1>Gestion de Examenes</h1>
        <p class="lead">En esta pantalla se podran crear los examenes</p>
        <form>
            <div class="mb-3">
                <input type="hidden" name="code" id="code">
                <label for="exampleInputEmail1" class="form-label">Nombre del examen</label>
                <input type="text" class="form-control" id="name">
            </div>
        </form>
        <a class="btn btn-lg btn-success" id="save" role="button" onclick="save()">Grabar</a>
        <a class="hidden btn btn-lg btn-primary " id="update" role="button" onclick="update()">Modificar</a>

    </div>
    <br><br>
    <div>
        <h3>Listado de Examenes</h3>
        <br>
        <div id="container-table"></div>
    </div>
    </main>
    <script src="../ASSETS/JS/modules/test.js"></script>
    <script>
            window.addEventListener( 'load', ()=>{
                table();
            } );
        </script>
</body>

</html>
