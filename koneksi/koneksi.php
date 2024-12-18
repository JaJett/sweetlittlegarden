<?php

    $server = "localhost";
    $user = "swee_flower";
    $password = "Pn6DxJ4x4%ycpup^";
    $nama_database = "swee_flower";

    $db = mysqli_connect($server,$user,$password,$nama_database);

    if( !$db){
        die("gagal terhubung dengan database: " . mysqli_connect_error());
    }
    

?>