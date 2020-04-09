<?php 
    $link = mysqli_connect("localhost","root","","library_management_system");

    if(mysqli_connect_error()) {
        die("Database Connection Error");
    }
?>