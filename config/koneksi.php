<?php
    $host = 'db';
    $user = 'root';
    $pwod = 'root';
    $dbs = 'projek-pkl';

    $konek = mysqli_connect($host, $user, $pwod, $dbs);
    if (!$konek){
        die('koneksi malas menyambung: ' . mysqli_connect_error());
    }
?>