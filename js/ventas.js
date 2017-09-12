$(document).ready(function(){
	$('.add').each(function(e){
		$(this).bind('click', addField);
	})
})

function addField(){
	control++;

	var clickID = parseInt($(this).attr('id'));
	var newID = (clickID+1);

	$newClone = $('#tabla_'+clickID).clone(true);
	$newClone.attr('id', 'tabla_'+newID);

	$newClone.find('#valor_'+clickID).attr('id','valor_'+newID).val('');
	$newClone.find('#cant_'+clickID).attr('id','cant_'+newID).val('');
	$newClone.find('#total_'+clickID).attr('id', 'total_'+newID).val('');

	$newClone.find('.add').attr('id', newID);
	$newClone.insertAfter($('#tabla_'+clickID));

	var can = parseInt($('input[name=count]').val());
	var cal = (can + 1);
	$('input[name=count]').val(cal)

	$('#'+clickID).find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
	$('#'+clickID).unbind('click', addField);
	$('#'+clickID).bind('click', delField);
}

function delField(){
	$(this).closest('table').remove()
	var cnt = $('input[name=count]').val();
	var calc = (cnt - 1);
	$('input[name=count]').val(calc)
}