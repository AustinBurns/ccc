jQuery(document).ready( function($) {

	//colorpicker show on click
	$(".colorSelector").click(function(){
	
		$(this).prev().prev().children('.farbtastic').slideToggle(200);
		
	});
	
});


