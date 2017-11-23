$(document).ready(function() {
	$(".updateCart").click(function(event) {
		var rowid = $(this).attr('id');
		var qty = $(this).parent().parent().find(".qty").val();
		var token = $("input[name='_token']").val();
		$.ajax({
			url:'cap-nhat/'+rowid+'/'+qty,
			type:'GET',
			cache:false,
			data:{"_token":token,"id":rowid,"qty":qty},
			success:function(data){
				if(data == "success"){
					window.location = "gio-hang"
				}
			}
		
			
		});
	});
});