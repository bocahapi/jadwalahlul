$(function(){
	$("#login").click(function(){
	var username = $("#username").val(); //nilai username
	var password = $("#password").val(); // nilai password
		
		
	var dataString = 'username-login=' + username + '&password-login=' + password; //user dan pass adalah atribut name(sama seperti elemen input)
	$(".back").fadeIn();
				$(".error").html('<div class="alert alert-info center"><i class="fa fa-spinner fa-spin fa-2x"></i> Sedang diproses</div>');
	 $.ajax({
		type: "POST",
		url: "admin/check_login.php",
		data: dataString,
		success: function(result){
		
			if(result == 'true'){
			$("body").fadeOut();
				window.location="admin/";
			
			}else{
				
				$(".error").html(result);
				$(".back").delay(3000).fadeOut();
				
			}
			
			}
		});
		return false;
		
	});

});

