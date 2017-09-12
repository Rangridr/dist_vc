<aside class="menu">
  <p class="menu-label">Registros</p>
  <ul class="menu-list">
    <li>
      <ul>
        <li id="reg-ne"><a>Clientes</a></li>
        <li id="reg-pr"><a>Productos</a></li>
        <li id="reg-ve"><a>Vender</a></li>
      </ul>
    </li>
  </ul>
  <p class="menu-label">Listados</p>
  <ul class="menu-list">
    <li>
      <ul>
        <li id="list-ve"><a>Ver Ventas</a></li>
        <li id="list-pr"><a>Ver Productos</a></li>
        <li id="list-ne"><a>Ver Clientes</a></li>
      </ul>
    </li>
  </ul>
  <p class="menu-label">Base de Datos</p>
  <ul class="menu-list">
    <li>
      <ul>
        <li id="backup"><a>Crear Respaldo</a></li>
        <li id="manage"><a>Gestionar Respaldos</a></li>
      </ul>
    </li>
  </ul>
  <p class="menu-label">Sesión</p>
  <ul class="menu-list">
    <li>
      <ul>
        <li id="chng-pssw"><a>Cambiar Clave</a></li>
        <?php if($_COOKIE['lvl'] == 1) : ?>
        <li id="add-usr"><a>Nuevo Usuario</a></li> <?php endif; ?>
        <li id="logout"><a>Desconectar</a></li>
      </ul>
    </li>
  </ul>
</aside>

<script type="text/javascript">
  $('a').on('click', function(){
    $('a').removeClass('is-active')
    $(this).addClass('is-active')
  });
</script>