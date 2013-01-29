<?php
function add_shortcode_contactform($atts) {

	extract(shortcode_atts(array(
		'email' => get_bloginfo('admin_email')
	), $atts));
	$output='';
	
	global $add_contact_script;$add_contact_script = true;

	$output.="<div class='contact_form_wrap'>";
		$output.="<form action='".THEME_URI."/mail.php' method='post' novalidate='novalidate'>";
			$output.="<input type='hidden' value='".$email."' name='to'/>";
			$output.="<input type='text' required='required' id='contact_name' name='name' placeholder='Name' />";
			$output.="<input type='email' required='required' id='contact_email' name='email' placeholder='Email'/>";
			$output.="<textarea required='required' name='content'></textarea>";
			$output.="<button type='submit' class='button'>".__('Submit',THEME_SLUG)."</button>";
		$output.="</form>";
		$output.="<div class='success hidden'>".__('Your message was successfully sent!',THEME_SLUG)."</div>";
	$output.="</div>";
	



	$output.="
	
	<script>
	
	jQuery(document).ready(function($) {
	
		$('.contact_form_wrap form').validate({

			highlight: function(element, errorClass) {
				$(element).addClass('invalid');
			},

			unhighlight: function(element, errorClass) {
				$(element).removeClass('invalid');
			},

			errorPlacement: function(error, element) {

			},

			submitHandler: function(form) {
			
				$.post(form.action+'?'+$(form).serialize(),function(){
				

					$(form).siblings('.success').fadeIn(200);
					
					
					
				});
				
			}
		
		});
	
	});
	
	</script>
	
	";
	
	
	return $output;

	
	
}

add_shortcode('contactform', 'add_shortcode_contactform');
?>
