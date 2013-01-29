jQuery(document).ready( function($) {


	//iphone checkbox
	$(".ibutton").iButton(); 
		
	//range
	$('.range-input-container input').rangeinput();


	var pf_val=$('#post-formats-select :checked').val();
	$('.op_pf_'+pf_val).show();
	
	$('#post-formats-select').change(function(){

		$('.op_pf').hide();
		pf_val=$('#post-formats-select :checked').val();
		$('.op_pf_'+pf_val).show();

	});
	



	
	value= $('.op_theme_page_type_i select').val();
	$('.op_theme_page_type').hide();
	$('.op_theme_page_type_'+value).stop().fadeTo(300,1);
	
						

	$('.op_theme_page_type_i select').change(function(e){
	
		e.preventDefault();
	
		$('.op_theme_page_type').hide();
		$('.op_theme_page_type_'+this.value).stop().fadeTo(300,1);
		


	});

	
	

	

});


