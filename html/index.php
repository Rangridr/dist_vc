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

</head>
<body>

<?php include 'navbar.php'; ?>

<figure class="image">
  <img src="../img/camion.jpg" style="height: 700px; width: 1400px;">
</figure>
</div>

<?php include 'footer.html'; ?>
</body>
</html>

<?php
error_reporting(E_ERROR);
if(($_COOKIE['nom'] != null) || ($_COOKIE['usu'] != null) || ($_COOKIE['lvl'] != null) || ($_COOKIE['ape'] != null)): ?>
  <script type="text/javascript">
    Cookies.remove('nom', {path:'/'});
    Cookies.remove('ape', {path:'/'});
    Cookies.remove('usu', {path:'/'});
    Cookies.remove('lvl', {path:'/'})
  </script>
<?php endif; ?>