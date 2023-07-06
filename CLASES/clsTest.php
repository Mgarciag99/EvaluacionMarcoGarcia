<?php
require_once( 'clsConex.php' );

class test{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
 
    function get( $id = '', $name = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM test";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE test_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND test_code = $id";
        }
        
        if( strlen( $name ) > 0 ){
            $sql.= " AND test_name LIKE '%$name%'";
        }
        
        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id, $name ){

        $sql = "";
        $sql.= "INSERT INTO test";
        $sql.= " VALUES ( $id, '$name', 1 );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function update( $id, $name ){

        $sql = "";
        $sql.= "UPDATE test";
        $sql.= " SET test_name = '$name'";
        $sql.= " WHERE test_code = $id ";
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
        $sql.= "UPDATE test";
        $sql.= " SET test_situation	 = $situacion ";
        $sql.= " WHERE test_code = $id ";
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
        $sql = "SELECT max( test_code ) as max ";
		$sql.= " FROM test;";
        $max = $this->db->query( $sql );
        return $max;
   
    }

}
?>