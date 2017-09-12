<?php
include 'files/config.php';

$db = new mysqli(host, usr, pssw, db);
$db->set_charset('utf8');

if($db->connect_errno){
	echo $db->connect_error;
	exit();
}

$cliente = isset($_POST['val']) ? $_POST['val']: '';
$fe = isset($_POST['dat']) ? $_POST['dat'] : '';

$sql = "SELECT ventas.fecha, negocios.nom, SUM(ventas.c_pago) AS total FROM ventas INNER JOIN negocios ON ventas.cliente = negocios.rif WHERE ventas.cliente = '$cliente' AND ventas.fecha LIKE '%$fe%' group by ventas.fecha";

if(!$re = $db->query($sql)){
  echo $db->error;
  exit();
}
$r = $re->fetch_assoc();

$query = "SELECT ventas.fecha, ventas.id_prod, ventas.cant, ventas.c_pago, ventas.cliente, productos.id, productos.nom, productos.precio, negocios.nom AS cl_nom, negocios.rif FROM (ventas INNER JOIN productos ON ventas.id_prod = productos.id) INNER JOIN negocios ON ventas.cliente = negocios.rif WHERE ventas.cliente = '$cliente' AND ventas.fecha LIKE '%$fe%'";

if(!$res = $db->query($query)){
	echo $db->error;
	exit();
}
?>

<link rel="stylesheet" type="text/css" href="../css/flatpickr.css">
<link rel="stylesheet" type="text/css" href="../css/themes/material_blue.css">
<script type="text/javascript" src="../js/flatpickr.js"></script>
<script type="text/javascript" src="../js/l10n/es.js"></script>

<script type="text/javascript">
  $('#pick').flatpickr({
    locale: 'es',
    altInput: true,
    maxDate: 'today'
  });
</script>

<input type="hidden" id="cli" value="<?php echo $cliente ?>">
<div class="column box">
	<div class="field has-addons has-addons-centered">
		<p class="control">
	    <input id="pick" class="input" type="text" placeholder="Por Fecha">
	  </p>
	  <p class="control">
	    <button id="send" class="button is-info">
	      <i class="fa fa-search"></i>
	    </button>
	  </p>
	</div>
	<?php if($res->num_rows): ?>
    <div id="details">
    <link rel="stylesheet" type="text/css" href="../css/bulma.css">
	<table class="table is-narrow is-bordered">
  	<thead>
      <th colspan="4" style="text-align: center;">Control de Ventas</th>
    </thead>
    <thead>
      <th colspan="2">Fecha:&nbsp;<u><?php
        $x = $r['fecha'];
        $f = explode('-', $x);
        $fixed = $f[2]."/".$f[1]."/".$f[0];
        echo $fixed;
        ?></u></th>
      <th colspan="2">Nombre:&nbsp;<u><?php echo $r['nom'] ?></u></th>
    </thead>
    <tr>
      <td>Cant</td>
      <td>Descripción</td>
      <td>Precio Unitario</td>
      <td>Total</td>
    </tr>
    <?php while($row = $res->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['cant'] ?></td>
      <td><?php echo $row['nom'] ?></td>
      <td><?php echo $row['precio'] ?></td>
      <td><?php echo $row['c_pago'] ?></td>
    </tr>
  <?php endwhile; ?>
    <tr>
      <td style="border: none;"></td>
      <td style="border: none;"></td>
      <td>Total</td>
      <td><?php echo $r['total'] ?></td>
    </tr>
  </table>
  </div>
  <table class="table">
  <tfoot>
    <tr>
      <td colspan="4" class="has-text-centered">
        <button class="button is-small is-info" id="print">Imprimir</button>
        <button class="button is-small is-warning" id="c_pr">Regresar</button>
      </td>
    </tr>
  </tfoot>
	</table>
	<?php	else: ?>
	<article class="message is-dark">
    <div class="message-header">
      <p>Tabla Vacia</p>
    </div>
    <div class="message-body has-text-centered">
      <strong>No hay resultados</strong><br><br>
      <button class="button is-warning" id="c_pr">Regresar</button>
    </div>
  </article>
  <?php
  endif;?>
</div>

<script type="text/javascript">
  $('#send').click(function(){
    var date = $('#pick').val();
    var cl = $('#cli').val();
    if(date === ''){
      return false;
    }
    
    $.ajax({
      type: 'post',
      data: {dat: date, val: cl},
      dataType: 'html',
      url: '../php/factura_venta.php'
    })
    .done(function(datos){
      $('#wrap').html(datos)
    })
  })

  $('#print').on('click', function(){
    var cont = document.getElementById('details');
    var win = window.open();
    win.document.write(cont.innerHTML);
    win.document.close()
    win.focus();
    win.print();
    win.close();
  })
</script>