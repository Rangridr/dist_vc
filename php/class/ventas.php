<?php
include '../files/config.php';
include '../files/interface.php';

class Venta implements Modules{
  private $id_pro;
  private $cant;
  private $valor;
  private $t_pago;
  private $total;
  private $cliente;
  private $con;
  private $db;
  private $match;

  public function __construct($id_pro, $cant, $valor, $t_pago, $total, $cliente, $con, $db, $match){
    $this->id_pro = $id_pro;
    $this->cant = $cant;
    $this->valor = $valor;
    $this->t_pago = $t_pago;
    $this->total = $total;
    $this->cliente = $cliente;
    $this->con = $con;
    $this->db = $db;
    $this->match = $match;
  }

  public function Add(){
    $rg = 0;
    for($c = 0; $c < $this->con; $c++):
      $select = "SELECT nom, cant FROM productos WHERE id = '{$this->id_pro[$c]}'";
      $res = $this->db->query($select);
      $row = $res->fetch_assoc();
      if(intval($row['cant']) < $this->cant[$c]): ?>
        <script type="text/javascript">
          alert('No hay suficiente cantidad de <?php echo $row["nom"] ?> en inventario, disponible <?php echo $row["cant"] ?>');
          $('#cant_'+<?php echo $c ?>).val('').focus();
        </script><?php
        exit();
      else:
        $query = "INSERT INTO ventas VALUES(null, 
        '{$this->id_pro[$c]}', '{$this->cant[$c]}', '{$this->valor[$c]}', 
        '{$this->t_pago[$c]}', '{$this->total[$c]}', '$this->cliente', now())";
        
        if($this->db->query($query)): 
          $rg++;
          $trigger = "UPDATE productos SET cant = (productos.cant - '{$this->cant[$c]}') WHERE id = '{$this->id_pro[$c]}'";
          $this->db->query($trigger);
        else : ?>
          <script type="text/javascript">
            alert("Error al registrar <?php echo $this->db->error ?>");
          </script>
        <?php endif;
      endif;
    endfor; ?>
    <script type="text/javascript">
      alert('<?php echo $rg; ?> Registros Exitosos')
      window.location.reload(true)
    </script><?php
  }

  public function Destroy(){
    $query = "DELETE FROM ventas WHERE id = '$this->match'";

    if ($this->db->query($query)): ?>
      <script type="text/javascript">
        alert('Registro Borrado');
      </script>
    <?php else : ?>
      <script type="text/javascript">
        alert("Error al Borrar <?php echo $this->db->error ?>");
      </script>
    <?php endif;
  }

  public function Update(){
    $query = "UPDATE ventas SET "
    ."id_prod = '$this->id_pro', "
    ."cant = '$this->cant', "
    ."valor = '$this->valor', "
    ."t_pago = '$this->t_pago', "
    ."c_pago = '$this->total', "
    ."cliente = '$this->cliente' "
    ."WHERE id = '$this->match'";

    if($this->db->query($query)) : ?>
      <script type="text/javascript">
        alert('¡Registro Actualizado!');
      </script>
    <?php else : ?>
      <script type="text/javascript">
        alert("Error al actualizar <?php echo $this->db->error ?>");
      </script>
    <?php endif;
  }
}

$db = new mysqli (host, usr, pssw, db);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_errror;
  exit();
}

$id_pro = isset($_POST['id_pro']) ? $_POST['id_pro'] : array('', '');
$cant = isset($_POST['cant']) ? $_POST['cant'] : array('', '');
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';
$t_pago = isset($_POST['t_pago']) ? $_POST['t_pago'] : array('', '');
$total = isset($_POST['total']) ? $_POST['total'] : array('', '');
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
$con = isset($_POST['count']) ? $_POST['count'] : 0;
$match = isset($_POST['match']) ? $_POST['match'] : '';
$quest = isset($_POST['quest']) ? $_POST['quest'] : '';

//var_dump($id_pro, $cant, $valor, $t_pago, $total, $cliente, $con);

$obj = new Venta($id_pro, $cant, $valor, $t_pago, $total, $cliente, $con, $db, $match);

switch ($quest) {
  case 'add':
    $obj->Add();
    break;
  case 'destroy':
    $obj->Destroy();
    break;
  case 'upd':
    $obj->Update();
    break;
  default:
    echo "Algo malo paso!";
    break;
}

?>