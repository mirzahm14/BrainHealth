<?php
$db=pg_connect('host=localhost dbname=counseling user=postgres password=mirzahm');
if(!$db){
    die("Gagal terhubung dengan database: " . pg_connect_error());
}
?>