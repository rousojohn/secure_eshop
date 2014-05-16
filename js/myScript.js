(function(){
	$("#loginForm").ready(function(){
		$("#submitBtn").click(
			function(){
				$("#loginForm fieldset").append("<input type='hidden' name='p' id='p' />");
				
				// hash the password
				$("#p").val(hex_sha512($("#password").val()));
				
				$("#password").val("");
				
				$("#loginForm").submit();
			}
		);
	});
})();
