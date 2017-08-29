$(document).ready(function(){
	cat();
	brand();
	product();
	recommended();
	mostview();
	function cat(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{category:1},
			success	:	function(data){
				$("#get_category").html(data);
				
			}
		})
	}

	function brand(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{brand:1},
			success	:	function(data){
				$("#get_brand").html(data);
			}
		})
	}
	
		function product(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getProduct:1},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	}
	
	function recommended(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{recommended:1},
			success	:	function(data){
				$(".recommended").html(data);
			}
		})
	}
	function mostview(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{mostview:1},
			success	:	function(data){
				$(".mostview").html(data);
			}
		})
	}
	$("body").delegate(".category","click",function(event){
		$("#get_product").html("<h3>Loading...</h3>");
		event.preventDefault();
		var cid = $(this).attr('cid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{get_seleted_Category:1,cat_id:cid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})
	$("body").delegate(".selectBrand","click",function(event){
		event.preventDefault();
		$("#get_product").html("<h3>Loading...</h3>");
		var bid = $(this).attr('bid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{selectBrand:1,brand_id:bid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})
	$("#search_btn").click(function(){
		$("#get_search").html("<h3>Loading...</h3>");
		var keyword = $("#search").val();
		if(keyword != ""){
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{search:1,keyword:keyword},
			success	:	function(data){ 
				$("#get_search").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
		}
	})
	$("#signup_button").click(function(event){
		event.preventDefault();
			$.ajax({
			url		:	"register.php",
			method	:	"POST",
			data	:	$("form").serialize(),
			success	:	function(data){
				if (data == "reg") {
					window.location.href = "profile.php";
				} else {
					$("#signup_msg").html(data);
				}
			}
		})
		
	})

     $("#send_button").click(function(event){
		event.preventDefault();
			$.ajax({
			url		:	"message.php",
			method	:	"POST",
			data	:	$("form").serialize(),
			success	:	function(data){
				$("#send_msg").html(data);
				
			}
		})
		
	})

		


	$("#login").click(function(event){
		event.preventDefault();
		var email = $("#email").val();
		var pass = $("#password").val();
		$.ajax({
			url	:	"login.php",
			method:	"POST",
			data	:	{userLogin:1,userEmail:email,userPassword:pass},
			success	:function(data){
				if(data == "login"){
					window.location.href = "profile.php";
				} else if(data == "nouser"){
					$('#e_msg').html("E-mail is invalid.");
				} else if(data == "nopass"){
					$('#e_msg').html("Password is incorrect.");
				}
			}
		})
	})
	cart_count();
	$("body").delegate("#product","click",function(event){
		event.preventDefault();
		var p_id = $(this).attr('pid');
		var popup = $(this).attr('popup');
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{addToProduct:1,proId:p_id},
			success	:	function(data){
				if (popup != 1) {
					$("#product_msg").html(data);
				} else {
					$('#product_msg_popup').html(data);
				}
				cart_count();
			}
		})
	})
	
	function cart_count(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{cart_count:1},
			success	:	function(data){
				$(".badge").html(data);
			}
		})
	}
	


	cart_checkout();
	function cart_checkout(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{cart_checkout:1},
			success	: function(data){
				$("#cart_checkout").html(data);
			}
		})
	}
	$("body").delegate(".qty","keyup",function(){
		var pid = $(this).attr("pid");
		var qty = $("#qty-"+pid).val();

		var price = $("#price-"+pid).val();
		var total = qty * price;
		$("#total-"+pid).val(total);
	})
	$("body").delegate(".remove","click",function(event){
		event.preventDefault();
		var pid = $(this).attr("remove_id");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{removeFromCart:1,removeId:pid},
			success	:	function(data){
				$("#cart_msg").html(data);
				cart_checkout();
			}
		})
	})
	$("body").delegate(".update","click",function(event){
		event.preventDefault();
		var pid = $(this).attr("update_id");
		var qty = $("#qty-"+pid).val();
		var price = $("#price-"+pid).val();
		var total = $("#total-"+pid).val();
		$.ajax({
			url	:"action.php",
			method	:	"POST",
			data	:	{updateProduct:1,updateId:pid,qty:qty,price:price,total:total},
			success	:	function(data){
				$("#cart_msg").html(data);
				cart_checkout();
			}
		})
	})
	
	

	$("body").delegate(".openModal","click",function(){
		proModalID = $(".proModalID", this).val();
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{getProductDetail:1,proModalID:proModalID},
			success	:	function(data){
				$("#proImageModal .modal-content").html(data);
			}
		})
	})

	$('#editProfileModal').on('shown.bs.modal', function (e) {
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{editprofile:1},
			success	:	function(data){
				$('#editProfileModal .modal-body').html(data);
			}
		})
	})

	$("body").delegate("#editprofile_submit_btn","click",function(){
		$.ajax({
			url	:	"register.php",
			method	:	"POST",
			data	:	$("#editprofileform").serialize(),
			success	:	function(data){
				if (data == "updated") {
					$('#editProfileModal').modal('hide');
					alert("Profile updated successfully.");
					window.location.href = "profile.php";
				} else {
					$("#err_profile").html(data);
				}
			}
		})
	})

	$('#changePassModal').on('shown.bs.modal', function (e) {
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{changepass:1},
			success	:	function(data){
				$('#changePassModal .modal-body').html(data);
			}
		})
	})

	$("body").delegate("#changepass_submit_btn","click",function(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	$("#changepassform").serialize(),
			success	:	function(data){
				if (data == "changed") {
					$('#changePassModal').modal('hide');
					alert("Password changed successfully.");
				} else {
					$("#err_passchange").html(data);
				}
			}
		})
	})
	
	$("body").delegate(".checkoutbtn","click",function(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{checkout:1},
			success	:	function(data){
				
					window.location.href = "thankyou.php";
				$("#cart_container .badge").html("0");
			
		}
		})
	})
	$('#gototoplink').hide();
	$(window).scroll(function () {
	    if ($(window).scrollTop() > 120) {
	    	$('#gototoplink').show();
	    }
	    if ($(window).scrollTop() < 120) {
	    	$('#gototoplink').hide();
	    }
	})

	$("body").delegate(".qty, .mob","keydown",function(e){
        if ($.inArray(e.keyCode, [8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) return;
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) e.preventDefault();
    });







})












