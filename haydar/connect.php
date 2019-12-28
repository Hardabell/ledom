<?php
$konek=new mysqli('localhost','root','','ledom');
if ($konek->connect_errno){
    "Database Error".$konek->connect_error;
}
?>