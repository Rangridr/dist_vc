<?php
include '../php/files/config.php';

$db = new mysqli(host, usr, pssw, db);
$db->set_charset('utf8');

if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$usu = $_COOKIE['usu'];

$query = "SELECT pass FROM usuarios WHERE usu = '$usu'";

if(!$res = $db->query($query)){
  echo $db->error;
  exit();
}

$row = $res->fetch_assoc();

$current = $row['pass'];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<script type="text/javascript">
$(document).ready(function(){
  $('.flatpickr-calendar').remove();
})
</script>

</head>
<body>

<div class="box">
<section class="section">
  <form id="formUpdPass">
    <table class="table is-bordered">
      <thead><th colspan="3" style="text-align:center;">Cambio de Clave</th></thead>
      <thead>
        <tr>
          <th>Clave Actual</th>
          <th>Clave Nueva</th>
          <th>Confirmar Clave</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>
            <p class="control has-icon has-icon-right">
              <input type="password" id="oldpass" name="oldpass" class="input" size="10" autocomplete="off" required>
              <span class="icon is-small">
                <i class="fa"></i>
              </span>
            </p>
          </td>
          <td>
            <p class="control has-icon has-icon-right">
              <input type="password" id="pass" name="pass" class="input" size="10" autocomplete="off" required>
              <span class="icon is-small">
                <i class="fa"></i>
              </span>
          </td>
          <td>
            <p class="control has-icon has-icon-right">
              <input type="password" id="rpass" name="rpass" class="input" size="10" autocomplete="off" required>
              <span class="icon is-small">
                <i class="fa"></i>
              </span>
            </p>
          </td>
          <input type="hidden" name="quest" value="upd">
          <input type="hidden" name="match" value="<?php echo $usu ?>">
          <input type="hidden" name="curr" value="<?php echo $current ?>">
        </tr>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="3" class="has-text-centered">
            <button type="submit" class="button is-info">Procesar</button>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</section>
</div>

<div id="content"></div>



</body>
</html>