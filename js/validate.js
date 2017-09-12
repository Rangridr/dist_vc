$(document).on('blur', 'input[type=text]', function(){
  if($(this).val() === ''){
    $(this).removeClass('is-success')
    $(this).addClass('is-danger')
    $(this).next().find('i').removeClass('fa-check')
    $(this).next().find('i').addClass('fa-warning')
    return false;
  }
  else if($(this).val() != ''){
    $(this).removeClass('is-danger')
    $(this).addClass('is-success')
    $(this).next().find('i').removeClass('fa-warning')
    $(this).next().find('i').addClass('fa-check')
    return true;
  }
});