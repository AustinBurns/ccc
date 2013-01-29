jQuery(document).ready( function($) {



	jQuery('.range-input-container input').rangeinput();

	var multipleValues = jQuery('select#immersionsocial_icons').val() || [];
	var i=0;
	for (i=0;i<multipleValues.length;i++)
		jQuery('.social_icon_'+multipleValues[i]).show();

	jQuery('select#immersionsocial_icons').change(function(){

		var multipleValues = jQuery(this).val() || [];

		jQuery('.social_icon').hide();
		
		var i=0;
		for (i=0;i<multipleValues.length;i++)
			jQuery('.social_icon_'+multipleValues[i]).show();

	});
	
	//custom sidebar
	jQuery('#add_sidebar').click(function() {
		
		var sb_name=jQuery('#sidebar_name').val();
		
		if (sb_name!='') {
					
			jQuery('#created_sidebars').append('<div class="created_item" data-name="'+sb_name+'">'+sb_name+'<a class="of-button">delete</a></div>');
			
			update_sidebar_field();

		}
			
	});
	
	function update_sidebar_field(){
	
		jQuery('#custom_sidebars').val('');
		
		jQuery('#created_sidebars .created_item').each(function(index){
		
			jQuery('#custom_sidebars').val(jQuery('#custom_sidebars').val()+jQuery(this).attr('data-name')+',');

		
		});
	
	}
	
	
	//custom footer
	jQuery('#adm_add_footer').click(function() {
	
		var ci_name=jQuery('#adm_footer_name').val();
	
		if (ci_name!='') {
					
			jQuery('#created_footers').append('<div class="created_item" data-name="'+ci_name+'" data-layout="'+jQuery('#adm_footer_layout').val()+'">'+ci_name+'<a class="of-button">delete</a></div>');
			
			update_footer_fields();

		}
			
	});
	
	function update_footer_fields(){
	
		jQuery('#adm_custom_footers_name, #adm_custom_footers_layout').val('');
		
		jQuery('#created_footers .created_item').each(function(index){
		
			jQuery('#adm_custom_footers_name').val(jQuery('#adm_custom_footers_name').val()+jQuery(this).attr('data-name')+',');
			jQuery('#adm_custom_footers_layout').val(jQuery('#adm_custom_footers_layout').val()+jQuery(this).attr('data-layout')+',');
		
		});
	}

	
	jQuery('.created_item > a').live('click', function(){
	
		jQuery(this).parent().hide().remove();
		
		update_sidebar_field();
		update_footer_fields();
		
	});
	


});


