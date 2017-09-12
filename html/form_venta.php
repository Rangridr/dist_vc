<?php
include '../php/files/config.php';
$db = new mysqli(host, usr, pssw, db);
$db->set_charset('utf8');

if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$query = "SELECT * FROM productos;";
$query .= "SELECT * FROM negocios";

if($db->multi_query($query)){
  $res1 = $db->store_result();
  $db->next_result();
  $res2 = $db->store_result();
  $db->close();
}else{
  echo $db->error;
  exit();
}

$row1 = $res1->fetch_assoc();

if(!$res1->num_rows): ?>
  <script type="text/javascript">
    alert('No hay productos para la venta');
    $('#reg-pr').click();
    $('a').removeClass('is-active');
    $('#reg-pr a').addClass('is-active');
  </script><?php 
elseif(!$res2->num_rows): ?>
  <script type="text/javascript">
    alert('No hay clientes registrados');
    $('#reg-ne').click();
    $('a').removeClass('is-active');
    $('#reg-ne a').addClass('is-active');
  </script><?php endif;

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Ventas</title>

</head>
<body>

<div class="box">
<section class="section">
  <form id="formVenta">
    <table width="100%" class="table is-bordered">
      <thead><th colspan="6" style="text-align:center;">Registro de Venta</th></thead>
      <tr>
        <th width="20%" style="text-align:center;" colspan="2">Comprador</th>
        <td colspan="2">
          <div class="field">
            <p class="control">
              <span class="select">
                <select name="cliente" id="cliente" required>
                  <option value="">Seleccione</option>
                </select>
              </span>
            </p>
          </div>
        </td>
      </tr>
      <table name="clon" id="tabla_1" width="100%" class="table is-bordered">
        <thead>
          <th colspan="4" style="padding-left: 52em; border: none">
            <button type="button" id="1" class="button is-primary is-small add">
              <span class="icon is-small">
                <i class="fa fa-plus"></i>
              </span>
            </button>
          </th>
        </thead>
        <tr>
          <th width="20%" style="text-align:center;">Producto</th>
          <td>
            <div class="field">
              <p class="control">
                <span class="select">
                  <select name="id_pro[]" id="producto_1" required></select>
                </span>
              </p>
            </div>
          </td>
          <th width="10%" style="text-align:center;">Precio +IVA</th>

          <td>
            <p class="control has-icon has-icon-right">
              <input type="text" name="valor[]" id="valor_1" class="input is-disabled" size="5">
              <span class="icon is-small">
                <i class="fa"></i>
              </span>
            </p>
          </td>
        </tr>
        <tr>          
          <th width="10%" style="text-align:center;">Cantidad</th>
          <td>
            <p class="control has-icon has-icon-right">
              <input type="text" name="cant[]" id="cant_1" onchange="calc()" class="input num-only" size="5" autocomplete="off" required>
              <span class="icon is-small">
                <i class="fa"></i>
              </span>
            </p>
          </td>

          <th width="20%" style="text-align:center;">Total</th>

          <td>
            <p class="control has-icon has-icon-right">
              <input type="text" name="total[]" id="total_1" class="input is-disabled" size="5">
              <span class="icon is-small">
                <i class="fa fa-money"></i>
              </span>
            </p>
          </td>
        </tr>

        <tr>
          <th width="20%" style="text-align:center;" colspan="2">Tipo de pago</th>
          <td style="padding-left: 7em;" colspan="2">
            <div class="field">
              <p class="control">
                <span class="select">
                  <select name="t_pago[]" required>
                    <option value="">Seleccione</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="cheque">Cheque</option>
                    <option value="transferencia">Transferencia</option>
                  </select>
                </span>
              </p>
            </div>
          </td>
        </tr>
      </table>
      
      <input type="hidden" name="quest" value="add">
      <input type="hidden" name="count" value="1">

      <center>
      <tr>
        <td colspan="6" class="has-text-centered">
          <button type="submit" class="button is-info">Procesar</button>
        </td>
      </tr>
      </center>
    </table>
  </form>
</section>
</div>
<div id="content"></div>

<script type="text/javascript">

$(document).ready(function(){
  $('.flatpickr-calendar').remove();

  $.getJSON('../php/load_client.php', function(data){
    $('#cliente').html(data[0].info);
  })
  
  $.getJSON('../php/load_pro.php', function(data){
    $('#producto_1').html(data[0].info);
  })
  
  $('.num-only').keydown(function(e){
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) != -1 || //allow backspace, delete, tab, escape, enter and .
        (e.keyCode == 65 && e.ctrlKey == true) || //allow ctrl+a
        (e.keyCode == 67 && e.ctrlKey == true) || //allow ctrl+c
        (e.keyCode == 88 && e.ctrlKey == true) || //allow ctrl+x
        (e.keyCode == 86 && e.ctrlKey == true) || //allow ctrl+v
        (e.keyCode >= 35 && e.keyCode <= 39)) { //allow home, end, left, right
      return;
    }

    if ((e.shifKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)){
      e.preventDefault();
    }
  });
});


var control = 1;

function calc(){
  console.log(control)
  var val = document.getElementById('valor_'+control).value;
  var cant = document.getElementById('cant_'+control).value;
  
  var suma = val * cant;

  $('#total_'+control).val(suma.toFixed(2));
}

$(document).on('change', '#producto_'+control, function(){
  var idpro = $(this).val();
  if($(this).val() === ''){
    return false;
  }
  //console.log(idpro);
  $.ajax({
    type: 'POST',
    data: {id: idpro},
    url: '../php/costo.php'
  })
  .done(function(data){
    $('#valor_'+control).val(data);
    calc();
  })
})
</script>
<script type="text/javascript" src="../js/ventas.js"></script>

</body>
</html>