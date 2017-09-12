<?php
  include 'files/config.php';

  $datab = new mysqli(host, usr, pssw, db);

  if ($datab->connect_errno){
    echo $datab->connect_error;
    exit();
  }

  $datab->set_charset('utf8');

  $usu = $_GET['usu'];
  $pass = md5($_GET['pass']);

  $query = "SELECT * FROM usuarios WHERE usu = '$usu' AND pass = '$pass'";

  if (!$res = $datab->query($query)){
    echo $datab->error;
    exit();
  }

  if ($res->num_rows == 1) {
    $info = 1;
    $row = $res->fetch_assoc();
  }
  else{
    $info = 0;
  }

  if ($info == 1){
    $response = null;
    $response[0] = array('info' => $info);
    $response[1] = array('nom' => $row['nom']);
    $response[2] = array('ape' => $row['ape']);
    $response[3] = array('usu' => $row['usu']);
    $response[4] = array('lvl' => $row['lvl']);

    echo json_encode($response);
  }
  else{
    $response[0] = array('info' => $info);
    echo json_encode($response);
  }
?>