<?php
class database{

            private $hostname = "localhost";
            private $username = "root";
            private $password = "";
            private $dbname = "crrud_ooop";

            private $mysqli = "";
            private $conn = false;
            private $result = array();

            // connection function.....................................
           public  function __construct(){
           if(!$this->conn){
           $this->mysqli = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
           $this->conn = true;



           if($this->mysqli->connect_error){
           array_push($this->result,$this->mysqli->connect_error);
           return false;
           }
               
           }else{
            return true;
           }

           }

         public function sql($sql){
        $query =  $this->mysqli->query($sql);
     
        if($query){
        $this->result = $query->fetch_all(MYSQLI_ASSOC);
        return true;
        }else{
        array_push($this->result, $this->mysqli->error);
        return false;
        }
        }
        private function tableExsist($table){
        $sql = "SHOW TABLES FROM $this->dbname LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if($tableInDb) {
        if($tableInDb->num_rows == 1) {
        return true;
           
        }else{
        array_push($this->result, $table."this table does not exsist");
        return false;
        }
        }
        }

        public function insert($table,$params=array()){
         if($this->tableExsist($table)){
         print_r($params);
         $table_columns = implode(', ', array_keys($params));
         $table_values = implode("', '", $params);

         $sql = "INSERT INTO $table ($table_columns) VALUES('$table_values')";

        if ($this->mysqli->query($sql)){
        array_push($this->result, $this->mysqli->insert_id);
        return true;
        }else{
        array_push($this->result, $this->mysqli->error);
        return false;
        }
        }else{

        }
        }

        public function update($table,$params=array(),$where = null){
        if($this->tableExsist($table)){
        $args = array();
        foreach ($params as $key => $value) {
        $args[] = "$key = '$value'";
        }
        $sql = "UPDATE $table SET ".implode(', ', $args);
        if($where != null) {
        $sql .= "WHERE $where";
        }
        if($this->mysqli->query($sql)){
        array_push($this->result,$this->mysqli->affected_rows);
        return true;
        }
        else{
        array_push($this->result, $this->mysqli_error);
         }



        }else{
            return false;
        }

        }

        public function delete($table,$where = null){
        if($this->tableExsist($table)){
        $sql = "DELETE FROM $table";
        if($where != null){
        $sql .= " WHERE $where";
        }
        if($this->mysqli->query($sql)){
        array_push($this->result,$this->mysqli->affected_rows);
        return true;
        }
        else{
        array_push($this->result, $this->mysqli_error);
         }

         }//($this->tableExsist($table))
         }


        public function getresult(){
         $val = $this->result;
         $this->result = array();
         return $val;
         } 



         public function __destruct(){
         if($this->conn) {
         if($this->mysqli->close()) {
         $this->conn = false;
         return true;
         }
         }else{
         false;
         }
         }
         }// connection close....................

?>