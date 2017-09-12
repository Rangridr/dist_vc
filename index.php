<?php
error_reporting(E_ERROR);
include ('php/files/config.php');

$db = new mysqli(host, usr, pssw, db);
if($db->connect_errno){
  echo "No se puede conectar con la base de datos <br>";
  echo "Contacte al administrador de sistema <br>";
  echo "Error: ".$db->connect_error."<br>";
  echo "Codigo de error: ".$db->connect_errno;
}else{
  header('location: html');
}
?>