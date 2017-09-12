<?php
include '../php/files/config.php';

$db = new mysqli(host, usr, pssw, db);
$db->set_charset('utf8');

if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$id = $_POST['id'];

$query = "SELECT * FROM productos WHERE id = '$id'";

if(!$res = $db->query($query)){
  echo $db->error;
  exit();
}

$row = $res->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Productos</title>

<script type="text/javascript">
  $(document).ready(function(){
    $('.flatpickr-calendar').remove();
  })
</script>

</head>
<body>

<div class="box">
<section class="section">
  <form id="formUpdPr">
    <table class="table is-bordered">
      <thead><th colspan="3" style="text-align:center;">Actualización de Datos</th></thead>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Precio por Unidad</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>
            <p class="control has-icon has-icon-right">
              <input type="text" name="nom" class="input" size="10" autocomplete="off" required value="<?php echo $row['nom'] ?>">
              <span class="icon is-small">
                <i class="fa"></i>
              </span>
            </p>
          </td>
          <td>
            <p class="control has-icon has-icon-right">
              <input type="text" name="cant" class="input" size="10" autocomplete="off" required value="<?php echo $row['cant'] ?>">
              <span class="icon is-small">
                <i class="fa"></i>
              </span>
          </td>
          <td>
            <p class="control has-icon has-icon-right">
              <input type="text" name="precio" class="input" size="10" autocomplete="off" required value="<?php echo $row['precio'] ?>">
              <span class="icon is-small">
                <i class="fa"></i>
              </span>
            </p>
          </td>
          <input type="hidden" name="quest" value="upd">
          <input type="hidden" name="match" value="<?php echo $id ?>">
        </tr>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="3" class="has-text-centered">
            <button type="submit" class="button is-info">Procesar</button>
            <button id="c_upr" type="button" class="button is-warning">Cancelar</button>
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