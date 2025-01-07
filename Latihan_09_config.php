<?php
    $servername = "localhost";
    $username = "root";
    $password = ""; //Sesuaikan jika ada password untuk user root
    $dbname = "db_alumni";
    //membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);
    //memeriksa koneksi
    if($conn->connect_error){
        die("Koneksi gagal:" .$conn->connect_error);
    }
?>