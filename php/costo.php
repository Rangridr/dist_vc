<?php
include 'files/config.php';

$db = new mysqli (host, usr, pssw, db);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$id = isset($_POST['id']) ? $_POST['id'] : '';

$query = "SELECT precio FROM productos WHERE id LIKE '%$id%'";

if(!$res = $db->query($query)){
  echo $db->error;
  exit();
}

$row = $res->fetch_assoc();

$iva = ($row['precio'] * 0.10);
$pagar = ($row['precio'] + $iva);

echo round($pagar, 3);

?>