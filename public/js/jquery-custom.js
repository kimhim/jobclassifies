$(document).ready(function(){
	$("#email").blur(function(){
		var email_address = $(this).val();
		$.ajax({
		    type:"GET",
		    url: "/user/emailvalidation", // ************* change url here for other resource **************//
		    data:{email:email_address},
		    success: function(data) {
		    	if(data>0){
		    		$("#btn-register").attr('disabled',true);
		    		$("#group-email").addClass(' has-error');
		    		$("#email-message-status").text("This email already taken by someone else!").addClass(' help-block');
		    		$("#result-email-validation").attr('title','This email already taken by someone else!').addClass(' fa-times email-fail');
		    	}else{
		    		$("#btn-register").attr('disabled',false);
		    		$("#group-email").removeClass(' has-error');
		    		$("#email-message-status").text('');
		    		$("#result-email-validation").removeClass(' email-fail').addClass(' fa-check-square email-success');
		    	}
		    },
		    error: function(jqXHR, textStatus, errorThrown) {
		    	console.log(errorThrown);
		    },
		  });
	});
});