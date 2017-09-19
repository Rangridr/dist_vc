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

  $fecha = isset($_POST['dat']) ? $_POST['dat'] : '';
  $cl = isset($_POST['val']) ? $_POST['val'] : '';

  $page_position = (($id-1) * $limit);
  
  $query = "SELECT ANY_VALUE(ventas.id) AS id, ventas.fecha FROM ventas INNER JOIN negocios ON ventas.cliente = negocios.rif WHERE ventas.cliente = '$cl' AND ventas.fecha LIKE '%$fecha%' GROUP BY ventas.fecha ORDER BY ventas.fecha ASC LIMIT $page_position, $limit";

  if(!$results = $db->query($query)){
    echo $db->error;
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<script type="text/javascript">
  $('#picdate').flatpickr({
    locale: 'es',
    altInput: true
  });
</script>

</head>

<body>
<div class="box">
<div class="field has-addons has-addons-centered">
  <p class="control">
    <input id="picdate" class="input" type="search" placeholder="Buscar Por Fecha" value="<?php echo $fecha ?>">
  </p>
  <p class="control">
    <button id="sdate" class="button is-info">
      <i class="fa fa-search"></i>
    </button>
  </p>
</div>
<input type="hidden" id="cl" value="<?php echo $cl; ?>">
<?php if($results->num_rows) : ?>
  <table width="100%" class="table is-bordered is-small">
    <thead>
      <td>N° Factura</td>
      <td>Fecha</td>
      <td class="has-text-centered">Facturar</td>
    </thead>
    <?php while ($row = $results->fetch_assoc()) : ?>
    <tbody>
      <td><?php echo $row['id'] ?></td>
      <td>
        <?php
        $x = $row['fecha'];
        $f = explode('-', $x);
        $fixed = $f[2]."/".$f[1]."/".$f[0];
        echo $fixed;
        ?>
      </td>
      <td class="has-text-centered">
        <button class="button is-small is-success" id="fac_ven" value='<?php echo $cl.','.$x ?>'>
          <span class="icon is-small">
            <i class="fa fa-print"></i>
          </span>
        </button>
      </td>
      <?php endwhile;
      $squery = "SELECT ventas.fecha FROM ventas INNER JOIN negocios ON ventas.cliente = negocios.rif WHERE ventas.cliente = '$cl' AND ventas.fecha LIKE '%$fecha%' GROUP BY ventas.fecha";
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
          <tr>
            <td colspan="3" class="has-text-centered">
              <button class="button is-small is-warning" id="c_pr">Regresar</button>
            </td>
          </tr>
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

<script type="text/javascript">
  
//executes code below when user click on pagination links
$(document).on("click", ".pagination a", function (e){
  e.preventDefault();
  var cli = $('#cl').val();
  var page = $(this).attr("data-page"); //get page number from link
  var fecha = $('#picdate').val();
  $(".box").load("../php/factura_cliente.php",{id:page, dat:fecha, val:cli});
});

$(document).on('click', '#sdate', function(){
  var cli = $('#cl').val();
  var fecha = $('#picdate').val();
  if(fecha === ''){
    return false;
  }
  $(".box").load("../php/factura_cliente.php",{dat:fecha, val:cli});
})
</script>

</body>
</html>

<?php } ?>