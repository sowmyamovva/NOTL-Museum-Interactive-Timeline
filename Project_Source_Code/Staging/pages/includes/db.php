<?php
    // $server = "sql106.epizy.com";
    // $username = "epiz_33561013";
    // $password = "yr78nEbN65Ffp";
    // $dbname = "epiz_33561013_timeline";

    // $conn = mysqli_connect($server,$username,$password,$dbname);

    // if(!$conn)
    // {
    //     die("Connection has Failed: ".mysqli_connect_error());
    // }

    function OpenCon()
    {
        $server = "sql106.epizy.com";
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
