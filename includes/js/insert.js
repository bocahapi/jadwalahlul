
/** AUTO GENERATE PASSWORD**/
$(function(){
$('#generate').click(function(){

$.ajax({
	type: "POST",
	url: "autogenerate.php",
	success: function(result){
		$('#password').val(result);
	}
	
	});
	return false;

});
});

/** delete action **/

$(function(){
	
	$('#action  a[title|="delete"]').click(function(){
		
		var action = $(this).attr('title');
		var from = $(this).parent().attr('data');
		var id = $(this).attr('data-id');
		var parent = $(this).parents('tr.tr');
		var dataString = 'action=' + action+ '&id=' + id + '&data=' + from;

		 $.ajax({
			type: "POST",
			url: "modif.php",
			data: dataString,
			success: function(result){

				if(result != 'true'){
					$('.notife').html(result).delay(6000).hide('slow');
				}else{	
					$('.notife').html('berhasil Dihapus').delay(3000).hide('slow');
					parent.hide('slow');
				}
				return;
			}
			});
			return false;

	});


});