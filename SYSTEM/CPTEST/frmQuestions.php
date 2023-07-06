<?php
require_once( 'module_test.php' );
$ClsTest = new test();
$test = $_REQUEST[ 'test' ];

$result = $ClsTest->get( $test, '', 1 );
while( $test = $result->fetch_object() ){
    $nametest = utf8_decode( $test->test_name );
}
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
        <span class="navbar-brand mb-0 h1">Gestor de Preguntas Examen <b><?= $nametest?> </b></span>
    </div>
    </nav>
    <br><br>
    <main class="container">
    <div class="bg-body-tertiary p-5 rounded">
        <h1>Gestion de Preguntas <b><?= $nametest?></h1>
        <p class="lead">En esta pantalla se podran crear las preguntas para el Examen <b><?= $nametest?> </b></p>
        <form>
            <div class="mb-3">
                <input type="hidden" name="code" id="code">
                <label for="exampleInputEmail1" class="form-label">Pregunta</label>
                <input type="text" class="form-control" id="question">
            </div>
        </form>
        <a class="btn btn-lg btn-success" id="save" role="button" onclick="save()">Grabar</a>
        <a class="hidden btn btn-lg btn-primary " id="update" role="button" onclick="update()">Modificar</a>

    </div>
    <br><br>
    <div>
        <h3>Listado de Preguntas</h3>
        <br>
        <div id="container-table"></div>
    </div>
    </main>
    <script src="../ASSETS/JS/modules/question.js"></script>
    <script>
            window.addEventListener( 'load', ()=>{
                table();
            } );
        </script>
</body>

</html>
