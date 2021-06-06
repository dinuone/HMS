<?php 


class Model{

   private $server = "localhost";
   private $username = "root";
   private $password ="";
   private $db = "hostpital_system";
   private $conn;

   public function __construct(){
       try{
           $this->conn = new mysqli($this->server, $this->username, $this->password,
           $this->db);

       }catch(\Throwable $th){
           echo "Connection Error". $th->getMessage();
       }
   }

   public function fetch(){
       $data = [];

       $query = "SELECT * FROM patients";
       if($sql = $this->conn->query($query)){
           while ($row = mysqli_fetch_assoc($sql)){
               $data[] = $row;
           }
       }
       return $data;

   }

   public function date_range($start_date,$end_date)
   {
        $data =[];
        if(isset($start_date) && isset($end_date)){
            $query ="SELECT * FROM `patients` WHERE `DateNow` > '$start_date' AND `DateNow` < '$end_date'";
           
            if($sql = $this->conn->query($query)){
                while ($row = mysqli_fetch_assoc($sql)){
                    $data[] = $row;
                }
            
                
           }
        }
       return $data;
   }
}
    




?>