<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){
    case 'save':
        $name        = $_REQUEST[ 'name' ];
        $question        = $_REQUEST[ 'question' ];

        
        save( $name, $question );
    break;

    case 'table':
        $id          = $_REQUEST[ 'id' ];
        $name        = $_REQUEST[ 'name' ];
        $question        = $_REQUEST[ 'question' ];
        
        $situation   = $_REQUEST[ 'situation' ];
        table( $id, $question, $name, $situation );
    break;
    
    case 'select':
        $id          = $_REQUEST[ 'id' ];
        select( $id );
    break;
    
    case 'update':
        $id          = $_REQUEST[ 'id' ];
        $name        = $_REQUEST[ 'name' ];
        $question        = $_REQUEST[ 'question' ];
        
        update( $id, $question, $name );
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


function save( $name, $test ){

    $arrResponse = array();

    if( $name != ''  ){

        $ClsQue = new question();
        $idquestion = $ClsQue->generateId();
        $id = $idquestion->fetch_object()->max;
        $id++;
        $result = $ClsQue->save( $id, $name, $test );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "question Insertada Correctamente"
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

function table( $id, $name, $situation ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_question( $id, $name, $situation ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function select( $id ){
    
    $arrResponse = array();

    if( $id != '' ){
        $ClsQue = new question();
        $questions = $ClsQue->get( $id );
        $arrData = array();

        while( $question = $questions->fetch_object() ){

           $arrData[ 'question_code' ] = $question->question_code;
           $arrData[ 'question_name' ] = $question->question_name;
           $arrData[ 'question_situation' ] = $question->question_situation;

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
function update( $id, $name ){
    
    $arrResponse = array();

    if( $id != '' && $name != ''  ){

        $ClsQue = new question();
        $result = $ClsQue->update( $id, $name );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "question Actualizado Correctamente"
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
                "message" 	=> "question Eliminada Correctamente"
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