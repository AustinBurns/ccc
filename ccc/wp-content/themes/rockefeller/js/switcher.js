  jQuery(document).ready(function($) {
	
	var switcher_link = $('#skins-switcher');
	
	var headertypeval = jQuery.cookie("if_cookie_headertypeval");
	var layoutwidthval = jQuery.cookie("if_cookie_layoutwidthval");
	
	if(headertypeval=="absolute"){
		var fixedselected = "";
		var absoluteselected = 'selected="selected"';
	}else{
		var fixedselected = 'selected="selected"';
		var absoluteselected = '';
	}
	
	if(layoutwidthval=="1040"){
		var _940selected = '';
		var _1040selected = 'selected="selected"';
		var _1140selected = '';
	}else if(layoutwidthval=="1140"){
		var _940selected = '';
		var _1040selected = '';
		var _1140selected = 'selected="selected"';
	}else{
		var _940selected = 'selected="selected"';
		var _1040selected = '';
		var _1140selected = '';
	}
		
	var styleswitcherstr = ' \
	<div id="style-switcher"> \
	<form id="style-switcher-form">\
	  <div id="style-switcher-heading"><a id="toggleswitcher" href="#"><h4>Style Switcher</h4></a></div>\
	  <div class="switchercontainer"> \
		  <span>Header Type</span> \
		  <div id="headertypecontainer"> \
		  	<select id="headertype" name="headertype"> \
				<option value="fixed" '+fixedselected+'>Fixed</option> \
				<option value="absolute" '+absoluteselected+'>Absolute</option> \
			</select> \
		  </div> \
		  <div class="clear"></div> \
	  </div> \
	  <div class="switchercontainer"> \
		  <a href="#" id="switcher-reset">Reset</a> \
		  <div class="clear"></div> \
	  </div> \
	</form>\
	</div> \
	';
	
	jQuery("body").prepend( styleswitcherstr );
	
	/*************** SKINS **************/
	jQuery("#toggleswitcher").click(function(e){
		jQuery("#style-switcher").toggleClass("active");
	});
	
	jQuery('#headertype').change(function(e){
		var headertypeval = jQuery(this).val();
		jQuery("#outerheader").css("position", headertypeval);
		jQuery.cookie("if_cookie_headertypeval", headertypeval);
	});
	jQuery('#layoutwidth').change(function(e){
		var layoutwidthval = jQuery(this).val();
		jQuery("#subbody .row").css("max-width", layoutwidthval+"px");
		jQuery.cookie("if_cookie_layoutwidthval", layoutwidthval);
	});
	/*************** END SKINS **************/
	
	
	/*************** COLOR **************/
    jQuery('#style-switcher a.color-box').each(function (i) {
        var a =   jQuery(this);
        a.css({
            backgroundColor: '#' + a.attr('rel')
        });
    });
	
  
	
  var headertypeval		= jQuery.cookie("if_cookie_headertypeval");
  var layoutwidthval	= jQuery.cookie("if_cookie_layoutwidthval");
  var color 			= jQuery.cookie("if_cookie_bgcolor");
  var background 		= jQuery.cookie("if_cookie_bgimage");
  
  
  if (headertypeval) {
      jQuery("#outerheader").css("position", headertypeval);
  }
  
  if (layoutwidthval) {
      jQuery("#subbody .row").css("max-width", layoutwidthval+"px");
  }
  
  if (background) {
      jQuery('body').css({
        backgroundImage: background,
        backgroundRepeat: "repeat"
      });
  }
  
  
  jQuery("#switcher-reset").click(function(){
		
		var headertypeval = "fixed";
		jQuery("#outerheader").css("position", headertypeval);
		jQuery.cookie("if_cookie_headertypeval",headertypeval);
		
		jQuery("#headertype").val(headertypeval);
		
		var widthvalue = 940;
		jQuery( "#subbody .row" ).css("max-width",widthvalue+"px");
		jQuery.cookie("if_cookie_layoutwidthval",widthvalue);
		
		jQuery("#layoutwidth").val(widthvalue);
		
		
		var color = "2d6191";
		switcher_link.attr('href',"styles/color/default.css");
		var atrrHref = switcher_link.attr('href');
		jQuery.cookie("if_cookie_bgcolor", color);
		
		
		var backgroundUrl = '';
		jQuery('body').css({
		  	backgroundImage: backgroundUrl,
		  	backgroundRepeat: "repeat"
	  	});
		jQuery.cookie("if_cookie_bgimage",backgroundUrl);
		 
  });
         
});