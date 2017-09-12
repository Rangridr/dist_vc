<?php
include '../files/config.php';
include '../files/interface.php';

class Producto implements Modules{
  private $nom;
  private $cant;
  private $precio;
  private $db;
  private $match;

  public function __construct($nom, $cant, $precio, $db, $match){
    $this->nom = $nom;
    $this->cant = $cant;
    $this->precio = $precio;
    $this->db = $db;
    $this->match = $match;
  }

  public function Add(){
    $query = "INSERT INTO productos VALUES("
    ."null, '$this->nom', '$this->cant', '$this->precio', now())";
    
    if($this->db->query($query)): ?>
      <script type="text/javascript">
        alert('¡Registro Exitoso!');
        window.location.reload(true)
      </script>
    <?php else : ?>
      <script type="text/javascript">
        alert("Error al registrar <?php echo $this->db->error ?>");
      </script>
    <?php endif;
  }

  public function Destroy(){
    $query = "DELETE FROM productos WHERE id = '$this->match'";

    if ($this->db->query($query)): ?>
      <script type="text/javascript">
        alert('Registro Borrado');
      </script>
    <?php else : ?>
      <input type="hidden" id="errno" value="<?php echo $this->db->errno ?>">
      <script type="text/javascript">
      if(document.getElementById('errno').value === '1451'){
        alert('No es posible elimiar el producto');
      }else{
        alert("Error al Borrar <?php echo $this->db->error ?>");
      }
      </script>
    <?php endif;
  }

  public function Update(){
    $query = "UPDATE productos SET "
    ."nom = '$this->nom', "
    ."cant = '$this->cant', "
    ."precio = '$this->precio', "
    ."fecha = now() "
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

$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$cant = isset($_POST['cant']) ? $_POST['cant'] : '';
$precio = isset($_POST['precio']) ? $_POST['precio'] : '';
$match = isset($_POST['match']) ? $_POST['match'] : '';
$quest = isset($_POST['quest']) ? $_POST['quest'] : '';

$obj = new Producto($nom, $cant, $precio, $db, $match);

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