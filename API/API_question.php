<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){
    
    case 'table':
        $id          = $_REQUEST[ 'id' ];
        $answer        = $_REQUEST[ 'answer' ];
        $test        = $_REQUEST[ 'test' ];    
        $situation   = $_REQUEST[ 'situation' ];
        table( $id, $answer, $test, $situation );
    break;
    

    case 'save':
        $answer        = $_REQUEST[ 'answer' ];
        $test        = $_REQUEST[ 'test' ];

        
        save( $answer, $test );
    break;

   
    case 'select':
        $id          = $_REQUEST[ 'id' ];
        select( $id );
    break;
    
    case 'update':
        $id          = $_REQUEST[ 'id' ];
        $answer        = $_REQUEST[ 'answer' ];
        $test        = $_REQUEST[ 'test' ];
        
        update( $id, $answer, $test );
    break;

    case 'delete':
        $id          = $_REQUEST[ 'id' ];
        delete( $id );
    break;

    default:
        $arrResponse = array();
        $arrResponse = array(
            "status"	=> false,
            "data" 	=> [],
            "message" 	=> "Verifique la peticion"
        );
        echo json_encode( $arrResponse );

    break;
}


function save( $answer, $test ){

    $arrResponse = array();

    if( $answer != ''  ){

        $ClsQue = new question();
        $idtest = $ClsQue->generateId();
        $id = $idtest->fetch_object()->max;
        $id++;
        $result = $ClsQue->save( $id, $answer, $test );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Pregunta Insertada Correctamente"
            );
        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "Error en el servidor"
            );
        }

    }else{
        $arrResponse = array(
			"status"	=> false,
			"data" 	=> [],
			"message" 	=> "Verifique los valores"
		);
    }
    
    echo json_encode( $arrResponse );

}

function table( $id, $answer, $test, $situation ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_question( $id, $answer, $test, $situation ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function select( $id ){
    
    $arrResponse = array();

    if( $id != '' ){
        $ClsQue = new question();
        $tests = $ClsQue->get( $id );
        $arrData = array();

        while( $test = $tests->fetch_object() ){

           $arrData[ 'que_code' ] = $test->que_code;
           $arrData[ 'que_anwer' ] = $test->que_anwer;
           $arrData[ 'que_test' ] = $test->que_test;
           $arrData[ 'que_situation' ] = $test->que_situation;

        }

        $arrResponse = array(
			"status"	=> true,
			"data" 	=> $arrData,
			"message" 	=> "Data obtenida satisfactoriamente"
		);

    }else{
        $arrResponse = array(
			"status"	=> false,
			"data" 	=> [],
			"message" 	=> "Verifique los valores"
		);
    }
    
    echo json_encode( $arrResponse );

}
function update( $id, $answer, $test ){
    
    $arrResponse = array();

    if( $id != '' && $answer != ''  ){

        $ClsQue = new question();
        $result = $ClsQue->update( $id, $answer, $test );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Pregunta Actualizada Correctamente"
            );
        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "Error en el servidor"
            );
        }

    }else{
        $arrResponse = array(
			"status"	=> true,
			"data" 	=> [],
			"message" 	=> "Verifique los valores"
		);
    }
    
    echo json_encode( $arrResponse );

}

function delete( $id ){

    $arrResponse = array();

    if( $id != ''  ){

        $ClsQue = new question();
        $result = $ClsQue->delete( $id, 0 );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "test Eliminada Correctamente"
            );
        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "Error en el servidor"
            );
        }

    }else{
        $arrResponse = array(
			"status"	=> true,
			"data" 	=> [],
			"message" 	=> "Verifique los valores"
		);
    }
    
    echo json_encode( $arrResponse );

}



?>