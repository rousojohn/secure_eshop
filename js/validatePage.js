(function(){
	var getItems = function(){
		$.get("get_items_in_cart.php")
		.done(function(data){
			var result = $.parseJSON(data);
			if(result.success){
				for(var i=0; i<result.rows.length; i++)
					$("tbody").append("<tr><td>"+(i+1)+"</td><td>"+result.rows[i].descr+"</td><td>"+result.rows[i].qty+"</td><td>"+result.rows[i].price+"</td></tr>");
				$("tbody").append("<tr><th>Total Cost:</th><td></td><td></td><td>"+result.total+"</td></tr>");
			}
			else
				alert(result.error);
		})
		.fail(function(data){alert("Error!~!!!!");});
	};

	
	var confirmOrder = function(){
		$.post("confirm_order.php", { address: $("span.label").text(), captcha_code : $("#captcha_code").val() })
		.done(function(data){
			var result = $.parseJSON(data);
			var msg = (result.success)?result.msg:result.error;
			alert(msg);
		})
		.fail(function(data){
			var result = $.parseJSON(data);
			alert(result.error);
		});
	};

	$("div#table-responsive").ready(getItems);
	$("div.panel").ready(function(){
		$("a#captchaChange").on("click", function(){
			$("img#captcha").attr("src",'securimage/securimage_show.php?' + Math.random());
		});
		
		$("button#confirmBtn").on("click", confirmOrder);
	});
})();
