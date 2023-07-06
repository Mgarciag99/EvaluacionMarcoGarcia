<?php
require_once( 'clsConex.php' );

class question{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
 
    function get( $id = '', $test = '', $name = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM question";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE que_situation IN( $situation )";
        }

        if( strlen( $test ) > 0 ){
            $sql.= " AND que_test IN( $test )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND que_code = $id";
        }
        
        if( strlen( $name ) > 0 ){
            $sql.= " AND que_anwer LIKE '%$name%'";
        }
        
        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id, $name, $test ){

        $sql = "";
        $sql.= "INSERT INTO question";
        $sql.= " VALUES ( $id, '$name', $test, 1 );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function update( $id, $name, $test ){

        $sql = "";
        $sql.= "UPDATE question";
        $sql.= " SET que_anwer = '$name', ";
        $sql.= " que_test = '$test' ";

        $sql.= " WHERE que_code = $id ";
     //   echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function delete( $id, $situacion ){

        $sql = "";
        $sql.= "UPDATE question";
        $sql.= " SET que_situation	 = $situacion ";
        $sql.= " WHERE que_code = $id ";
     //   echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function generateId(){

        $sql = '';
        $sql = "SELECT max( que_code ) as max ";
		$sql.= " FROM question;";
        $max = $this->db->query( $sql );
        return $max;
   
    }

}
?>