<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){
    case 'save':
        $name        = $_REQUEST[ 'name' ];
        
        save( $name );
    break;

    case 'table':
        $id          = $_REQUEST[ 'id' ];
        $name        = $_REQUEST[ 'name' ];
        
        $situation   = $_REQUEST[ 'situation' ];
        table( $id, $name, $situation );
    break;
    
    case 'select':
        $id          = $_REQUEST[ 'id' ];
        select( $id );
    break;
    
    case 'update':
        $id          = $_REQUEST[ 'id' ];
        $name        = $_REQUEST[ 'name' ];
        
        update( $id, $name );
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


function save( $name ){

    $arrResponse = array();

    if( $name != ''  ){

        $ClsTest = new test();
        $idtest = $ClsTest->generateId();
        $id = $idtest->fetch_object()->max;
        $id++;
        $result = $ClsTest->save( $id, $name );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "test Insertada Correctamente"
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
        "data" 	=> table_test( $id, $name, $situation ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function select( $id ){
    
    $arrResponse = array();

    if( $id != '' ){
        $ClsTest = new test();
        $tests = $ClsTest->get( $id );
        $arrData = array();

        while( $test = $tests->fetch_object() ){

           $arrData[ 'test_code' ] = $test->test_code;
           $arrData[ 'test_name' ] = $test->test_name;
           $arrData[ 'test_situation' ] = $test->test_situation;

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

        $ClsTest = new test();
        $result = $ClsTest->update( $id, $name );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "test Actualizado Correctamente"
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

        $ClsTest = new test();
        $result = $ClsTest->delete( $id, 0 );
        
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