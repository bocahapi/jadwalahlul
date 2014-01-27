$(function(){
	$("#fakultas").change(function(){
		var option = $(this).val();
		var user = $('#idm').val();
		var jab = $('#jab').val();
		if(option != ''){
		var dataString = 'place=' +option + '&user=' +user +'&jab='+jab;
			$.ajax({
				type: "POST",
				url: "../admin/list-jurusan.php",
				data: dataString,
				success: function(result){
	
					$("#jurusan").html(result);

					//console.log(result);
				}
			
			});
			return false;
		}else{
			$("#jurusan").html('<option value="">Plih Jurusan</option>');
		
		}
	});
	$("#jurusan").change(function(){
		var option = $(this).val();
		if(option != ''){
		var dataString = 'place=' +option;
			$.ajax({
				type: "POST",
				url: "../admin/list-dosen.php",
				data: dataString,
				success: function(result){

					$("#dosen").html(result);
					
					//console.log(result);
				}
			
			});
			return false;
		}else{
			$("#dosen").html('<option value="">Plih Dosen</option>');
		
		}
	});
});