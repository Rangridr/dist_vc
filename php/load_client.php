<?php
include 'files/config.php';

$db = new mysqli (host, usr, pssw, db);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$query = "SELECT * FROM negocios ORDER BY nom";

if(!$res = $db->query($query)){
  echo $db->error;
  exit();
}

if($res->num_rows){
  $info = "<option value=''>Seleccione</option>";
  while($row = $res->fetch_assoc()){
    $info .= "<option value='".$row['rif']."'>".$row['nom']."</option>";
  }
}else{
  $info = "<option value=''>Seleccione</option>";
}

$response = null;
$response[0] = array('info' => $info);

echo json_encode($response);

?>