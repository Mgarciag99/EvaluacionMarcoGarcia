<?php
require_once( '../CLASES/clsTest.php' );
require_once( '../CLASES/clsQuestion.php' );


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
            $output.= '            </td>';
            $output.= '        </tr>';
            $i++;
        }
        
        $output.= '    </tbody>';
        $output.= '</table>';
    }
    
    return $output;

}


?>