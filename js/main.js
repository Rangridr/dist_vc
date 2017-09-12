/* ###### LOGIN ###### */
$(document).on('submit', '#login', function(e){
  e.preventDefault();
  $.getJSON('../php/login.php', {usu:$('#usu').val(), pass:$('#pass').val()}, function(data){
    if (data[0].info == 1){
      Cookies.set('nom', data[1].nom, {path:'/', expires: 0.5});
      Cookies.set('ape', data[2].ape, {path:'/', expires: 0.5});
      Cookies.set('usu', data[3].usu, {path:'/', expires: 0.5});
      Cookies.set('lvl', data[4].lvl, {path:'/', expires: 0.5});
      location.href = '../html/m_index.php';
    }
    else{
      alert('Usuario y/o Contraseña Invalidos');
      $('#usu').val('').focus();
      $('#pass').val('');
    }
  });
});

/* ###### LOGOUT ##### */
$(document).on('click', '#logout', function(){
  Cookies.remove('nom', {path:'/'});
  Cookies.remove('ape', {path:'/'});
  Cookies.remove('usu', {path:'/'});
  Cookies.remove('lvl', {path:'/'})
  window.location.href = "../";
});

/* ###### USER MANAGER ###### */
/* ### ADD USER ### */
$(document).on('click', '#add-usr', function(){
  $.post('../html/form_nusu.html', function(html){
    $('#wrap').html(html);
  })
})
$(document).on('submit', '#formAddUsr', function(e){
  e.preventDefault();
  var D = $('#formAddUsr').serialize();
  $.ajax({
    type: 'POST',
    data: D,
    dataType: 'html',
    url: '../php/class/usuarios.php'
  })
  .done(function(html){
    $('#content').html(html);
  })
})

/* ### CHANGE PASSWORD ###*/
$(document).on('click', '#chng-pssw', function(){
  $.post('../html/upd_pssw.php', function(html){
    $('#wrap').html(html);
  })
})

$(document).on('submit', '#formUpdPass', function(e){
  e.preventDefault();
  var D = $('#formUpdPass').serialize();
  $.ajax({
    type: 'POST',
    data: D,
    dataType: 'html',
    url: '../php/class/usuarios.php'
  })
  .done(function(html){
    $('#content').html(html);
  })
})
/* ###### MAIN CLICK ###### */
$(document).on('click', '#main', function(){
  window.location.reload(true);
})
/* ###### CANCEL BUTTON ###### */
$(document).on('click', '#c_une', function(){
  $('#list-ne').click();
});

$(document).on('click', '#c_upr', function(){
  $('#list-pr').click();
});

$(document).on('click', '#c_pr', function(){
  $('.flatpickr-calendar').remove();
  $('#list-ve').click();
});

/* ###### BACKUPS ###### */
$(document).on('click', '#backup', function(){
  $.getJSON('../php/backup.php', function(data){
    if(data[0].info == 1){
      alert('Se Creo El Respaldo Exitosamente');
    }else{
      alert('Error al Crear el Respaldo');
    }
  });
});

$(document).on('click', '#manage', function(){
  $.post('../html/backup_list.html', function(data){
    $('#wrap').html(data);
  });
})

/* ###### REGISTER LINKS ###### */
$(document).on('click', '#reg-ne', function(){
  $.post('../html/form_negocio.html', function(html){
    $('#wrap').html(html)
  })
});

$(document).on('click', '#reg-pr', function(){
  $.post('../html/form_pro.html', function(html){
    $('#wrap').html(html)
  })
});

$(document).on('click', '#reg-ve', function(){
  $.post('../html/form_venta.php', function(html){
    $('#wrap').html(html)
  })
});


/* ###### LIST LINKS ###### */
$(document).on('click', '#list-ne', function(){
  $.post('../html/list_nego.html', function(html){
    $('#wrap').html(html)
  })
});

$(document).on('click', '#list-pr', function(){
  $.post('../html/list_pro.html', function(html){
    $('#wrap').html(html)
  })
});

$(document).on('click', '#list-ve', function(){
  $.post('../html/list_ven.html', function(html){
    $('#wrap').html(html)
  })
});

/* ###### SAVE ###### */
$(document).on('submit', '#formNegocio', function(e){
  e.preventDefault();
  var D = $('#formNegocio').serialize();
  $.ajax({
    type: 'POST',
    data: D,
    dataType: 'html',
    url: '../php/class/negocios.php'
  })
  .done(function(html){
    $('#content').html(html);
  })
})

$(document).on('submit', '#formPro', function(e){
  e.preventDefault();
  var D = $('#formPro').serialize();
  $.ajax({
    type: 'POST',
    data: D,
    dataType: 'html',
    url: '../php/class/productos.php'
  })
  .done(function(html){
    $('#content').html(html);
  })
})

$(document).on('submit', '#formVenta', function(e){
  e.preventDefault();
  var D = $('#formVenta').serialize();
  $.ajax({
    type: 'POST',
    data: D,
    dataType: 'html',
    url: '../php/class/ventas.php'
  })
  .done(function(html){
    $('#content').html(html);
  })
})

/* ###### DELETE ###### */
$(document).on('click', '#delNe', function(){
  var id = $(this);
  var conf = confirm('¿Desea eliminar este registro?');
  if(conf){
    $.ajax({
      type: 'POST',
      data: {match: $(id).val(), quest: 'destroy'},
      dataType: 'html',
      url: '../php/class/negocios.php'
    })
    .done(function(html){
      $('#content').html(html);
      window.location.reload(true);
    })
  }
})

$(document).on('click', '#delPro', function(){
  var id = $(this);
  var conf = confirm('¿Desea eliminar este registro?');
  if(conf){
    $.ajax({
      type: 'POST',
      data: {match: $(id).val(), quest: 'destroy'},
      dataType: 'html',
      url: '../php/class/productos.php'
    })
    .done(function(html){
      $('#content').html(html);
      window.location.reload(true);
    })
  }
})

$(document).on('click', '#delVen', function(){
  var id = $(this);
  var conf = confirm('¿Desea eliminar este registro?');
  if(conf){
    $.ajax({
      type: 'POST',
      data: {match: $(id).val(), quest: 'destroy'},
      dataType: 'html',
      url: '../php/class/ventas.php'
    })
    .done(function(html){
      $('#content').html(html);
      window.location.reload(true);
    })
  }
})

/* ###### UPDATE ###### */
$(document).on('click', '#updPr',function(){
  var id = $(this);
  $.ajax({
    type: 'POST',
    url: '../html/upd_pro.php',
    data: {id: $(id).val()},
    dataType: 'html'
  })
  .done(function(html){
    $('#wrap').html(html);
  });
});

$(document).on('submit', '#formUpdPr', function(e){
  e.preventDefault();
  var D = $('#formUpdPr').serialize();
  $.ajax({
    type: 'POST',
    url: '../php/class/productos.php',
    data: D,
    dataType: 'html'
  })
  .done(function(html){
    $('#content').html(html);
    $('#list-pr').click();
  })
})

$(document).on('click', '#updNe', function(){
  var rif = $(this);
  $.ajax({
    type: 'POST',
    url: '../html/upd_negocio.php',
    data: {rif: $(rif).val()},
    dataType: 'html'
  })
  .done(function(html){
    $('#wrap').html(html);
  });
});

$(document).on('submit', '#formUpdNe', function(e){
  e.preventDefault();
  var D = $('#formUpdNe').serialize();
  $.ajax({
    type: 'POST',
    url: '../php/class/negocios.php',
    data: D,
    dataType: 'html'
  })
  .done(function(html){
    $('#content').html(html);
    $('#list-ne').click();
  })
})

/* ###### FACTURA ###### */
$(document).on('click', '#fac_ven', function(){
  var cli = $(this);
  var d = new Date();
  var dd = d.getDate();
  var mm = d.getMonth() + 1;
  var yy = d.getFullYear();

  if(dd == '1'){dd = '01';}
  else if(dd == '2'){var dd = '02';}
  else if(dd == '3'){var dd = '03';}
  else if(dd == '4'){var dd = '04';}
  else if(dd == '5'){var dd = '05';}
  else if(dd == '6'){var dd = '06';}
  else if(dd == '7'){var dd = '07';}
  else if(dd == '8'){var dd = '08';}
  else if(dd == '9'){var dd = '09';}

  if(mm == '1'){mm = '01';}
  else if(mm == '2'){var mm = '02';}
  else if(mm == '3'){var mm = '03';}
  else if(mm == '4'){var mm = '04';}
  else if(mm == '5'){var mm = '05';}
  else if(mm == '6'){var mm = '06';}
  else if(mm == '7'){var mm = '07';}
  else if(mm == '8'){var mm = '08';}
  else if(mm == '9'){var mm = '09';}

  var date = yy+'-'+mm+'-'+dd;

  $.ajax({
    type: 'POST',
    url: '../php/factura_venta.php',
    data: {
      val: $(cli).val(),
      dat: date
    },
    dataType: 'html'
  })
  .done(function(html){
    $('#wrap').html(html);
  })
})