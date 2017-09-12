<nav class="nav has-shadow">
  <div class="container">
    <div class="nav-left">
      <a class="nav-item" onclick="window.location.reload(true)">
        <img src="../img/logo.png">
      </a>
      <a class="nav-item is-tab modal-button" data-target="#modal-direc">Dirección</a>
      <a class="nav-item is-tab modal-button" data-target="#modal-cont">Contacto</a>
    </div>
    <div class="nav-right nav-menu">
      <a class="nav-item is-tab modal-button" data-target="#modal-ter">Iniciar Sesión</a>
    </div>
  </div>
</nav>

<script type="text/javascript">
  $('a').hover(function(){
    $(this).addClass('is-active')
    },
    function(){
      $(this).removeClass('is-active')
    }
  );
</script>

<?php include 'login_form.html'; ?>