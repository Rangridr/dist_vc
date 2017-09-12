<?php
if(($_COOKIE['nom'] == null) || ($_COOKIE['usu'] == null) || ($_COOKIE['lvl'] == null) || ($_COOKIE['ape'] == null)){
  header('location: ../');
}else{
  include 'files/config.php';

  $db = new mysqli(host, usr, pssw, db);
  $db->set_charset('utf8');
  if($db->connect_errno){
    echo $db->connect_error;
    exit();
  }

  $limit = 10;

  if(isset($_POST['id'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
  }else{
    $id = 1; //if there's no page number, set it to 1
  }

  $fe = isset($_POST['dat']) ? $_POST['dat'] : '';

  $page_position = (($id-1) * $limit);
  
  $query = "SELECT ventas.fecha, ventas.id AS id_ven, ventas.id_prod, ventas.cant, ventas.valor, ventas.t_pago, ventas.c_pago, ventas.cliente, productos.id, productos.nom, negocios.nom AS cl_nom, negocios.rif FROM (ventas INNER JOIN productos ON ventas.id_prod = productos.id) INNER JOIN negocios ON ventas.cliente = negocios.rif WHERE ventas.fecha LIKE '%$fe%' ORDER BY ventas.fecha ASC LIMIT $page_position, $limit";

  //$query = "SELECT ventas.fecha, any_value(ventas.cliente) AS cliente, any_value(negocios.nom) AS cl_nom, any_value(negocios.rif) AS rif FROM ventas INNER JOIN negocios ON ventas.cliente = negocios.rif WHERE ventas.fecha LIKE '%$fe%' GROUP BY ventas.fecha";

  if(!$results = $db->query($query)){
    echo $db->error;
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="../css/flatpickr.css">
<link rel="stylesheet" type="text/css" href="../css/themes/material_blue.css">
<script type="text/javascript" src="../js/flatpickr.js"></script>
<script type="text/javascript" src="../js/l10n/es.js"></script>

<script type="text/javascript">
  $('#pick').flatpickr({
    locale: 'es',
    altInput: true
  });
</script>

</head>

<body>
<div class="box">
<div class="field has-addons has-addons-centered">
  <p class="control">
    <input id="pick" class="input" type="search" placeholder="Buscar Por Fecha" value="<?php echo $fe ?>">
  </p>
  <p class="control">
    <button id="search" class="button is-info">
      <i class="fa fa-search"></i>
    </button>
  </p>
</div>
<?php if($results->num_rows) : ?>
  <table width="100%" class="table is-narrow is-bordered is-small">
    <thead>
      <td width="15%">Producto</td>
      <td width="5%">Cantidad</td>
      <td width="10%">Precio por Unidad</td>
      <td width="10%">Total Pagado</td>
      <td width="10%">Tipo de Pago</td>
      <td width="15%">Cliente</td>
      <td width="10%">Fecha</td>
      <td width="5%">Facturar</td>
    </thead>
    <?php while ($row = $results->fetch_assoc()) : ?>
    <tbody>
      <td><?php echo $row['nom'] ?></td>
      <td><?php echo $row['cant'] ?></td>
      <td><?php echo $row['valor'] ?></td>
      <td><?php echo $row['c_pago'] ?></td>
      <td><?php echo $row['t_pago'] ?></td>
      <td><?php echo $row['cl_nom'] ?></td>
      <td>
        <?php
        $x = $row['fecha'];
        $f = explode('-', $x);
        $fixed = $f[2]."/".$f[1]."/".$f[0];
        echo $fixed;
        ?>
      </td>
      <td class="has-text-centered">
        <button class="button is-small is-success" id="fac_ven" value="<?php echo $row['rif'] ?>">
          <span class="icon is-small">
            <i class="fa fa-print"></i>
          </span>
        </button>
      </td>
      <?php endwhile;
      $squery = "SELECT * FROM ventas WHERE fecha LIKE '%$fe%'";
      $fields = $db->query($squery);
      $total_rows = $fields->num_rows;
      $total = ceil($total_rows/$limit);
      ?>
      <tfoot>
          <td colspan="8">
            <nav class="pagination is-centered is-small"><?php
              if($id > 1) :?>
              <a data-page="<?php echo ($id-1); ?>" class="pagination-previous">Anterior</a>
              <?php else : ?>
              <a class="pagination-previous" disabled>Anterior</a><?php endif;
              
              if($id != $total) : ?>
              <a class="pagination-next" data-page="<?php echo ($id+1); ?>">Siguiente</a>
              <?php else : ?>
              <a class="pagination-next" disabled>Siguiente</a><?php endif;
              
              for($i = 1; $i <= $total; $i++) : ?>
              <ul class="pagination-list">
              <?php if($id == $i) : ?>
                <li>
                  <a class="pagination-link is-current"><?php echo $i ?></a>
                </li>
                <?php else : ?>
                <li><?php if($i == $id) : ?>
                  <a class="pagination-link is-current"><?php echo $i ?></a>
                </li><?php else : ?>
                <li>
                  <a class="pagination-link" data-page="<?php echo $i; ?>"><?php echo $i ?></a>
                </li><?php endif;
              endif; ?>
              </ul>
              <?php endfor; ?>
            </nav>
          </td>
        </tfoot>
      </table><?php else : ?>
    <article class="message is-dark">
      <div class="message-header">
        <p>Tabla Vacia</p>
      </div>
      <div class="message-body has-text-centered">
        <strong>No hay resultados</strong>
      </div>
    </article>
  <?php endif; ?>
</div>
<div id="content"></div>
</body>
</html>

<?php } ?>