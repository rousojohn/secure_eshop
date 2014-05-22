(function(){

	var getProductsAsync = function(searchTerm){
		$.get("get_product_list.php",{ searchTerm : $.trim(searchTerm) || "" })
		 .done(function(data){
			$("a.product").off("click");
			$("div.list-group").empty();
			var elems = $.parseJSON(data);
			for(var i=0; i<elems.length-1; i++)
				$("div.list-group").append(elems[i]);
			$("span#totalItems").text(elems[elems.length-1]);
		})
		.fail(function(data){
		 	var result = $.parseJSON(data);
			$(".modal-content").text(result[0]);
			$("#modal").modal('show'); 
		})
		.always(function () {
			$("span.label-default").text(searchTerm);
			$("input#searchTxt").val("");
			$("a.product").on("click", function (evt){
				evt.preventDefault();
				$.post('add_to_cart_page.php',{ product_id : $(this).attr("product_id") })
				.done( function (data){
					var result = $.parseJSON(data);
					if ( result.success )
						getProductsAsync();
					else{
						$(".modal-content").text(result.error);
						$("#modal").modal('show');
					}
				})
				.fail( function (data){
					var result = $.parseJSON(data);
					$(".modal-content").text(result.error);
					$("#modal").modal('show');
				});
			});
		});
	};

	$(document).ready(function(){
		$("button#dismissBtn").on("click", function(evt){
			evt.preventDefault();
			window.location.href = "index.php";
		});

		

		$("a#logoutLnk").on("click", function(evt){
			evt.preventDefault();
			window.location.href = "includes/logout.php";
		});

		$("button#submitBtn").on("click", function(evt){
			getProductsAsync($("input#searchTxt").val());
		});
	});

	$("div.list-group").ready(function(){getProductsAsync("");});

})();
