<?php
require_once( 'module_test.php' );
$ClsTest = new test();
$test = $_REQUEST[ 'test' ];

$result = $ClsTest->get( $test, '', 1 );
while( $test = $result->fetch_object() ){
    $codetest = utf8_decode( $test->test_code );
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
    <style>
        ul{
            list-style: none;

        }
        ul li{
            border: 1px solid #000;
            margin-bottom: 1em;
            padding: 1em;
        }
    </style>
</head>

<body>

    <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Visualizacion De Examen <b><?= $nametest?> </b></span>
    </div>
    </nav>
    <br><br>
    <main class="container">
    <div class="bg-body-tertiary p-5 rounded">
        <h1>Examen: <b><?= $nametest?></h1>
        <br>
        <?php 
        $ClsQue = new question();
        
        $result = $ClsQue->get( '', '', $codetest, 1 );
        // var_dump( $result );die();
        while( $question = $result->fetch_object() ):
            $codeQuestion = trim( $question->que_code );
            $answerQuestion = utf8_decode( $question->que_anwer );
            $testQuestion = trim( $question->que_test );
            $situationQuestion = trim( $question->que_situation );
        ?>
        
        <p> <strong><?= $codeQuestion?>. </strong><?= $answerQuestion?></p>
        <p>Posibles Respuestas</p>
        <ul>
            <?php 
            $ClsResp = new response();
            $result = $ClsResp->get( '', $codetest, $codeQuestion, '', 1 );
            while( $response = $result->fetch_object() ):
                 $resp_response = trim( $response->resp_response );
            ?>
            
            <li><?= $resp_response?></li>

            <?php endwhile; ?>
        </ul>
        <?php endwhile;
        ?>

    </div>
    </main>
</body>

</html>
