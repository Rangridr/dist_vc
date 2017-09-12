<?php
include '../files/config.php';
include '../files/interface.php';

class Negocio implements Modules{
  private $nom;
  private $rif;
  private $dire;
  private $db;
  private $match;

  public function __construct($nom, $rif, $dire, $db, $match){
    $this->nom = $nom;
    $this->rif = $rif;
    $this->dire = $dire;
    $this->db = $db;
    $this->match = $match;
  }

  public function Add(){
    $query = "INSERT INTO negocios VALUES("
    ."'$this->nom', '$this->rif', '$this->dire')";
    
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
    $query = "DELETE FROM negocios WHERE rif = '$this->match'";

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
    $query = "UPDATE negocios SET "
    ."nom = '$this->nom', "
    ."rif = '$this->rif', "
    ."dire = '$this->dire' "
    ."WHERE rif = '$this->match'";

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
$rif = isset($_POST['rif']) ? $_POST['rif'] : '';
$dire = isset($_POST['dire']) ? $_POST['dire'] : '';
$match = isset($_POST['match']) ? $_POST['match'] : '';
$quest = isset($_POST['quest']) ? $_POST['quest'] : '';

$obj = new Negocio($nom, $rif, $dire, $db, $match);

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