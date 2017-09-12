<?php
if(($_COOKIE['usu'] == null) || ($_COOKIE['nom'] == null) || ($_COOKIE['ape'] == null) || ($_COOKIE['lvl'] == null)){
  header('location: ../');
}else{
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Distribuidora</title>
<link rel="icon" type="image/ico" href="../img/favicon.ico">

<link rel="stylesheet" type="text/css" href="../css/bulma.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.css">

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bulma.js"></script>
<script type="text/javascript" src="../js/clipboard.min.js"></script>
<script type="text/javascript" src="../js/js.cookie.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript" src="../js/validate.js"></script>

</head>
<body bgcolor="#CDD5D3">
<div class="container">
  <h1 id="main" align="center" style="cursor: pointer;" class="title">
    <p style="padding-top: 15px;">Distribuidora Vergara Carrero</p>
  </h1>
  <hr>

  <div class="columns">
    <div class="column is-2 is-small">
      <?php include 'm_navbar.php'; ?>
    </div>

    <div class="column" id="wrap">
      <figure class="image box">
        <img src="../img/banner1.jpg" style="height: 500px">
      </figure>
    </div>
  
  </div>
</div>

<div id="content"></div>

<?php include 'footer.html'; ?>

</body>
</html>
<?php } ?>