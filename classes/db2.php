<?php

class Database{

    //private variables can't be accessed outside
    private $host = "localhost";
    private $username = "root";
    private $password="";
    private $db="domantay_mary_db";
    
    function connect(){ //once this runs, db does not run immediately unless it meets the following criteria

        //use the keyword $this-> to access private var inside a function, inside a class
        $conn=mysqli_connect($this->host, $this->username, $this->password, $this->db); //code is self-contained

        //test code can be removed afterwards
        if(!$conn) //CREATED VARIABLE FOR DB
        {
            die("Connection failed".mysqli_connect_error());

        }else{

            //echo "database connected successfuly";
        }

        return $conn; //exit function 
    }
    
    function read($query){ //query = passed argument in function
         $connection = $this->connect(); //to call the connect function inside class; connect dd
         $result = mysqli_query($connection, $query);

         if(!$result){ //if result is false, then...
             return false;
         }else{
             
             $data = false; //creating an array
             while($row = mysqli_fetch_assoc($result)){
                 $data[] = $row;
             }
             return $data; //return array
         }
    }
    
    function save($query){ //writes data in database
        $connection = $this->connect(); //to call the connect function inside class; connects db
        $result = mysqli_query($connection, $query);

        if(!$result){ //if result is false, then...
            return false;
        }else{
            return true;
        }
    }
}

//testing
/*$DB = new Database();

$query = "select * from users";
$data = $DB->read($query);

echo "<pre>";
print_r($data);
echo "</pre>";*/
