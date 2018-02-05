// Main Js
var swiper = new Swiper('.swiper-container', {
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})

function signout() {
	$.ajax({
		method: "POST",
		url: "signout.php",
		dataType: "json",
		data: {
	  		"Signup" : "true"
		},
		success: function(e) {
			if(e.result == "0000") {
				location.reload();
			} else {
				alert(e.message);
			}
		},
		error: function() {
			alert("Connection error.");
		}
	});
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$("#sell_option").change(function() {
	var price = $(this).val();
	$(".movie_price").html("price: $"+ price);
});

function add_cart() {
	var movie_id = getUrlParameter("id");
	var price = $("#sell_option").val();
	var sell_type;
	var text = $("#sell_option option:selected").text();
	if (text == "I want to buy it.") {
		sell_type = '1';
	} else if (text == "I want to rent it.") {
		sell_type = '2';
	} else if (text == "I want to download it.") {
		sell_type = '3';
	}

	$.ajax({
		method: "POST",
		url: "confirm_cart.php",
		dataType: "json",
		data: {
	  		"movieID" : movie_id,
	  		"price" : price,
	  		"sellType" : sell_type
		},
		success: function(e) {
			if(e.result == "0000") {
				alert("Added to your cart!")
			} else {
				alert(e.message);
			}
		},
		error: function() {
			alert("Connection error.");
		}
	});
}

function checkout_cart() {
    $(':checkbox:checked').each(function(i){
		var val = $(this).val();
		$.ajax({
			method: "POST",
			url: "check_out.php",
			dataType: "json",
			data: {
		  		"checkType" : "cart",
		  		"cartID" : val
			},
			success: function(e) {
				if(e.result == "0000") {
					alert("You have successfully purchased selected products!");
					location.reload();
				} else {
					alert(e.message);
				}
			},
			error: function() {
				alert("Connection error.");
			}
		});
    });
}

function checkout_buy() {
	var movie_id = getUrlParameter("id");
	var price = $("#sell_option").val();
	var sell_type;
	var text = $("#sell_option option:selected").text();
	if (text == "I want to buy it.") {
		sell_type = '1';
	} else if (text == "I want to rent it.") {
		sell_type = '2';
	} else if (text == "I want to download it.") {
		sell_type = '3';
	}

	$.ajax({
		method: "POST",
		url: "check_out.php",
		dataType: "json",
		data: {
	  		"movieID" : movie_id,
	  		"price" : price,
	  		"sellType" : sell_type,
	  		"checkType" : "buy"
		},
		success: function(e) {
			if(e.result == "0000") {
				alert("Purchase successful!")
			} else {
				alert(e.message);
			}
		},
		error: function() {
			alert("Connection error.");
		}
	});
}