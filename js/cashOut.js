(function(){
	var getProductsAsync = function(){
		$.get("get_items_in_cart.php")
		.done(function(data){
			var result = $.parseJSON(data);
			if (result.success){
				$(".list-group").append(result.html);
				$("#total").html("<bold>"+result.total+"&nbsp;<span class='glyphicon glyphicon-euro'></span></bold>");
			}
			else{
				$(".modal-content").text(result.error);
				$("#modal").modal('show');
			}
		})
		.fail(function(data){
			$result = $.parseJSON(data);
			alert($result.error);
		});
	};
	$(document).ready(function(){
		$("#submitBtn").on("click", function(evt){
			evt.preventDefault();
			if($("#address").val() === ""){
				alert("Error. Address Is Required");
				return false;
			}
			else{
				$("#modal").modal({ remote: "validate_order.php?address="+$("#address").val(), show: true});
			}
		});
	});
	$("div.list-group").ready(function(){getProductsAsync();});
})();
