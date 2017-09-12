<?php
include '../files/config.php';
include '../files/interface.php';

class Usuario implements Modules{
  private $nomApe;
  private $usu;
  private $pass;
  private $lvl;
  private $email;
  private $db;
  private $match;
  private $oldpass;
  private $curr;
  private $rpass;

  public function __construct($nomApe, $usu, $pass, $lvl, $email, $db, $match, $oldpass, $curr, $rpass){
    $this->nomApe = $nomApe;
    $this->usu = $usu;
    $this->pass = $pass;
    $this->lvl = $lvl;
    $this->email = $email;
    $this->db = $db;
    $this->match = $match;
    $this->oldpass = md5($oldpass);
    $this->curr = $curr;
    $this->rpass = $rpass;
  }

  public function Add(){
    if(strlen($this->pass) < 8): ?>
      <script type="text/javascript">
        alert('La contraseña debe tener minimo 8 caracteres')
        $('#rpass').val('')
        $('#rpass').removeClass('is-success')
        $('#rpass').addClass('is-danger')
        $('#rpass').next().find('i').removeClass('fa-check')
        $('#rpass').next().find('i').addClass('fa-warning')
        $('#pass').val('').focus()
      </script><?php 
    elseif($this->pass != $this->rpass): ?>
      <script type="text/javascript">
        alert('La contraseña no coincide')
        $('#rpass').val('')
        $('#rpass').removeClass('is-success')
        $('#rpass').addClass('is-danger')
        $('#rpass').next().find('i').removeClass('fa-check')
        $('#rpass').next().find('i').addClass('fa-warning')
        $('#pass').val('').focus()
      </script>
    <?php else:
      $query = "INSERT INTO usuarios VALUES("
      ."null, '".implode("', '", $this->nomApe)."', '$this->usu', md5('$this->pass'), '$this->lvl', '$this->email')";
      
      if($this->db->query($query)): ?>
        <script type="text/javascript">
          alert('¡Registro Exitoso!');
          window.location.reload(true)
        </script>
      <?php else : ?>
        <input type="hidden" id="errno" value="<?php echo $this->db->errno; ?>">
        <script type="text/javascript">
          if(document.getElementById('errno').value === '1062'){
            alert('Ya existe el nombre de usuario, utilize otro');
          }else{
            alert("Error al registrar <?php echo $this->db->error ?>");
          }
        </script><?php
      endif;
    endif;
  }

  public function Destroy(){
    $query = "DELETE FROM usuarios WHERE id = '$this->match'";

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
    if(strlen($this->pass) < 8): ?>
      <script type="text/javascript">
        alert('La contraseña debe tener minimo 8 caracteres')
        $('#rpass').val('')
        $('#rpass').removeClass('is-success')
        $('#rpass').addClass('is-danger')
        $('#rpass').next().find('i').removeClass('fa-check')
        $('#rpass').next().find('i').addClass('fa-warning')
        $('#pass').val('').focus()
      </script><?php 
    elseif($this->pass != $this->rpass): ?>
      <script type="text/javascript">
        alert('La contraseña no coincide')
        $('#rpass').val('')
        $('#rpass').removeClass('is-success')
        $('#rpass').addClass('is-danger')
        $('#rpass').next().find('i').removeClass('fa-check')
        $('#rpass').next().find('i').addClass('fa-warning')
        $('#pass').val('').focus()
      </script>
    <?php elseif($this->curr != $this->oldpass): ?>
      <script type="text/javascript">
        alert('La clave actual no coincide');
        $('#oldpass').val('')
        $('#oldpass').removeClass('is-success')
        $('#oldpass').addClass('is-danger')
        $('#oldpass').next().find('i').removeClass('fa-check')
        $('#oldpass').next().find('i').addClass('fa-warning')
      </script>
    <?php else:
      $query = "UPDATE usuarios SET pass = md5('$this->pass') WHERE usu = '$this->match'";

      if($this->db->query($query)) : ?>
        <script type="text/javascript">
          alert('¡Registro Actualizado!');
          window.location.reload(true);
        </script>
      <?php else : ?>
        <script type="text/javascript">
          alert("Error al actualizar <?php echo $this->db->error ?>");
        </script>
      <?php endif;
    endif;
  }
}

$db = new mysqli (host, usr, pssw, db);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_errror;
  exit();
}

$nomApe = isset($_POST['nomApe']) ? $_POST['nomApe'] : array('' => '');
$usu = isset($_POST['usu']) ? $_POST['usu'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
$lvl = isset($_POST['lvl']) ? $_POST['lvl'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$match = isset($_POST['match']) ? $_POST['match'] : '';
$quest = isset($_POST['quest']) ? $_POST['quest'] : '';
$oldpass = isset($_POST['oldpass']) ? $_POST['oldpass'] : '';
$curr = isset($_POST['curr']) ? $_POST['curr'] : '';
$rpass = isset($_POST['rpass']) ? $_POST['rpass'] : '';

$obj = new Usuario($nomApe, $usu, $pass, $lvl, $email, $db, $match, $oldpass, $curr, $rpass);

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