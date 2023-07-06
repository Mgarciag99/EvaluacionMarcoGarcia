<?php
require_once( '../CLASES/clsTest.php' );
require_once( '../CLASES/clsQuestion.php' );
require_once( '../CLASES/clsResponse.php' );



function table_test( $code = '', $name = '', $situation = 1 ){
    $ClsTest = new test();
    $tests = $ClsTest->get( $code, $name, $situation );
    $output = '';
    if ( $tests->num_rows == 0 ){
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han registrado Evaluaciones';
        $output.= '</div>';
    }else{
        $output.= '<table class="table">';
        $output.= '    <thead>';
        $output.= '        <tr>';
        $output.= '            <th scope="col">Codigo</th>';
        $output.= '            <th scope="col">Nombre de la Evaluacion</th>';
        $output.= '            <th scope="col">Opciones</th>';
        $output.= '        </tr>';
        $output.= '    </thead>';
        $output.= '    <tbody>';
        $test = '';
        $i = 1;
        while ( $test = $tests->fetch_object() ){
            $testId = $test->test_code;  
            $output.= '        <tr class="odd gradeX">';
            $output.= '            <td scope="row"> '. $i . ' </td>';
            $output.= '            <td> '. utf8_decode( $test->test_name ). ' </td>';
            $output.= '            <td>';
            $output.= '                 <button title="Seleccionar test" class="btn btn-primary" onclick="select( ' . $testId . ' );">Seleccionar</button>';
            $output.= '                 <button title="Eliminar " class="btn btn-danger"  onclick="delete_( ' . $testId . ' );">Eliminar</button>';
            $output.= '                 <a title="Agregar Preguntas" class="btn btn-success" href="frmQuestions.php?test=' . $testId . '">Agregar Preguntas</a>';
            $output.= '                 <a title="Ver Examen" class="btn btn-info" href="frmTest.php?test=' . $testId . '">Ver Examen</a>';
            $output.= '            </td>';
            $output.= '        </tr>';
            $i++;
        }
        
        $output.= '    </tbody>';
        $output.= '</table>';
    }
    
    return $output;

}

function table_question( $code = '', $answer = '', $test = '', $situation = 1 ){
    $ClsQue = new question();
    $tests = $ClsQue->get( $code, $answer, $test, $situation );
    $output = '';
    if ( $tests->num_rows == 0 ){
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han registrado Preguntas para este examen';
        $output.= '</div>';
    }else{
        $output.= '<table class="table">';
        $output.= '    <thead>';
        $output.= '        <tr>';
        $output.= '            <th scope="col">Codigo</th>';
        $output.= '            <th scope="col">Nombre de la Evaluacion</th>';
        $output.= '            <th scope="col">Opciones</th>';
        $output.= '        </tr>';
        $output.= '    </thead>';
        $output.= '    <tbody>';
        $test = '';
        $i = 1;
        while ( $test = $tests->fetch_object() ){
            $testId = $test->que_code;
            $answerCode = $test->que_test;  

            $output.= '        <tr class="odd gradeX">';
            $output.= '            <td scope="row"> '. $i . ' </td>';
            $output.= '            <td> '. utf8_decode( $test->que_anwer ). ' </td>';
            $output.= '            <td>';
            $output.= '                 <button title="Seleccionar test" class="btn btn-primary" onclick="select( ' . $testId . ' );">Seleccionar</button>';
            $output.= '                 <button title="Eliminar " class="btn btn-danger"  onclick="delete_( ' . $testId . ' );">Eliminar</button>';
            $output.= '                 <a title="Agregar Preguntas" class="btn btn-success" href="frmResponses.php?test=' . $answerCode . '&answer=' . $testId . '">Agregar Respuestas</a>';
            $output.= '            </td>';
            $output.= '        </tr>';
            $i++;
        }
        
        $output.= '    </tbody>';
        $output.= '</table>';
    }
    
    return $output;

}


function table_response( $code = '', $codeTest = '', $codeQuestion = '', $response = '', $situation = 1 ){
    $ClsResp = new response();
    $tests = $ClsResp->get( $code, $codeTest, $codeQuestion, $response, $situation );
    $output = '';
    if ( $tests->num_rows == 0 ){
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han registrado respuestas para esta pregunta';
        $output.= '</div>';
    }else{
        $output.= '<table class="table">';
        $output.= '    <thead>';
        $output.= '        <tr>';
        $output.= '            <th scope="col">Codigo</th>';
        $output.= '            <th scope="col">Respuesta</th>';
        $output.= '            <th scope="col">Tipo</th>';
        $output.= '        </tr>';
        $output.= '    </thead>';
        $output.= '    <tbody>';
        $test = '';
        $i = 1;
        while ( $test = $tests->fetch_object() ){
            $testId = $test->resp_code;
            $respResponse = $test->resp_response; 
            $typeResponse = $test->resp_true_or_false;

            switch( $typeResponse ){
                case 1:
                    $tipo = 'Correcta';
                break;
                case 0:
                    $tipo = 'Incorrecta';
                break;
            }

            $output.= '        <tr class="odd gradeX">';
            $output.= '            <td scope="row"> '. $i . ' </td>';
            $output.= '            <td> '. utf8_decode( $respResponse ). ' </td>';
            $output.= '            <td> '. $tipo . ' </td>';
            $output.= '        </tr>';
            $i++;
        }
        
        $output.= '    </tbody>';
        $output.= '</table>';
    }
    
    return $output;

}




?>