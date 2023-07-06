<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){

    case 'save':
        $codeTest        = $_REQUEST[ 'codeTest' ];
        $codeQuestion        = $_REQUEST[ 'codeQuestion' ];
        $response        = $_REQUEST[ 'response' ];
        $type            = $_REQUEST[ 'type' ];
        save( $codeTest, $codeQuestion, $response, $type );
    break;

    case 'table':
        $id          = $_REQUEST[ 'id' ];
        $codeTest        = $_REQUEST[ 'codeTest' ];
        $codeQuestion        = $_REQUEST[ 'codeQuestion' ];
        $response        = $_REQUEST[ 'response' ];

        table( $id, $codeTest, $codeQuestion, $response );
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


function save( $codeTest, $codeQuestion, $response, $type ){

    $arrResponse = array();

    if( $codeTest != '' && $codeQuestion != '' ){

        $ClsResp = new response();
        $idtest = $ClsResp->generateId();
        $id = $idtest->fetch_object()->max;
        $id++;
        $result = $ClsResp->save( $id, $codeTest, $codeQuestion, $response, $type );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "RESPUESTA Insertada Correctamente"
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

function table( $id, $codeTest, $codeQuestion, $response ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_response( $id, $codeTest, $codeQuestion, $response, 1 ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}


?>