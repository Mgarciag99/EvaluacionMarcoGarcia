<?php
require_once( 'clsConex.php' );

class response{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
 
    function get( $id = '', $test = '', $question = '', $response = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM response";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE resp_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND resp_code = $id";
        }

        if( strlen( $test ) > 0 ){
            $sql.= " AND resp_test = $test";
        }

        if( strlen( $question ) > 0 ){
            $sql.= " AND resp_question = $question";
        }
        
        if( strlen( $response ) > 0 ){
            $sql.= " AND resp_response LIKE '%$response%'";
        }
        
        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id, $test, $question, $response, $trueOrFalse ){

        $sql = "";
        $sql.= "INSERT INTO response";
        $sql.= " VALUES ( $id, $test, $question, '$response', $trueOrFalse, 1 );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }


    function generateId(){

        $sql = '';
        $sql = "SELECT max( resp_code ) as max ";
		$sql.= " FROM response;";
        $max = $this->db->query( $sql );
        return $max;
   
    }

}
?>