<?php


    function OpenCon()
    {
        $server = "";
        $username = "";
        $password = "";
        $dbname = "";

        $conn = new mysqli($server,$username,$password,$dbname) or die("Connect failed: %s\n". $conn -> error);
        
        return $conn;
    }
    
    function CloseCon($conn)
    {
        $conn -> close();
    }



?>
