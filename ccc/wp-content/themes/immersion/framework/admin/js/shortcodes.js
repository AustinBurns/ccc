jQuery(document).ready( function($) {

	var textField;
	var val1, val2, error;
	var tb_show_temp = window.tb_show; 


	
	//add image id	
	jQuery('.op_upload_wrap button').click(function(e) {

		e.preventDefault();
		tb_show('Insert Image ID', 'media-upload.php?type=gallery&tab=library&TB_iframe=1');
		textField= jQuery(this).prev();
		
			
	});
	
	
	window.tb_show = function() { 

		tb_show_temp.apply(null, arguments); 

		var iframe = jQuery('#TB_iframeContent');
		iframe.load(function() {

			var iframeJQuery = iframe[0].contentWindow.jQuery;

			jQuery('<input id="insert_id" class="insert_id button-primary" value="Insert ID">').insertBefore(iframeJQuery('.savesend .del-link'));
						
			iframeJQuery('.insert_id').click(function(){
			
				textField.val(jQuery(this).siblings('.del-attachment').attr('id').slice(15));
				tb_remove();
				
			});
		
			
			
		});
	}
	
	
	//tabs 
	$('.first_sc_container_tabs').find('tr:gt(0)').hide();
	$('#sc_tabs_count').change(function(event, value) {

		$(this).parents('tbody').children('tr:gt(0)').hide();
		$(this).parents('tbody').children('tr:lt('+(value*2+1)+')').show();
		
	});
	
	//pricing tables 
	$('.first_sc_container_pricing_table').find('tr:gt(0)').hide();
	$('#sc_pricing_table_columns').change(function(event, value) {

		$(this).parents('tbody').children('tr:gt(0)').hide();
		$(this).parents('tbody').children('tr:lt('+(value*9+1)+')').show();
		
	});

	
	$('#first_sc_select').val('none');
	$('#first_sc_select').change(function(e, value){

		$('.first_sc_container').hide();
		$('.secondary_sc_container').hide();
		$('.secondary_sc_select').val('none');	
		$('.first_sc_container_'+this.value).stop().fadeTo(300,1);

		
	});
	
	$('.secondary_sc_select').change(function(){
	
		$('.secondary_sc_container').hide();
		$('.secondary_sc_container_'+this.value).stop().fadeTo(300,1);	
		
	});
	
	$('#generate_code').click(function(){
	
		$('#generated-code').val(generate_sc_code());
		
	});
	
	

	
	
	
	function get_text_value(val){
	
		if (val2 == undefined) return $('#sc_'+val1+'_'+val).val();
		else return $('#sc_'+val1+'_'+val2+'_'+val).val();

	}
	
	function generate_sc_code(e){
	
		val1 = $('#first_sc_select').val();
		val2 = $('.secondary_sc_select_'+val1).val();
		error='';
		var sc='';
		
		switch(val1){
		
			case 'blog-posts':
						
				var cats=get_text_value('cats');
				
				if(cats!=null) cats=' cats="'+cats+'"';
				else error=true;

				sc='[blog-posts'+cats+']';
				
			break;
		
			case 'button':
						
				var text=get_text_value('text');
				var link=get_text_value('link');
				var color=get_text_value('color');
				var fullwidth=get_text_value('fullwidth');
				
				if(text!='') text=' text="'+text+'"';
				else error=true;
				if(link!='') link=' link="'+link+'"';
				else link='';
				if(color!='...') color=' color="'+color+'"';
				else color='';
				if(fullwidth=='yes') fullwidth=' fullwidth="true"';
				else fullwidth='';
				
				
				sc='[button'+link+text+color+fullwidth+']';
				
			break;

			case 'contactform':
						
				var email=get_text_value('email');
				
				if(email!='') email=' email="'+email+'"';
				
				sc='[contactform'+email+']';
				
			break;
			
				
			case 'gmap':
			
				var height=get_text_value('height');
				var latitude=get_text_value('latitude');
				var longitude=get_text_value('longitude');
				var zoom=get_text_value('zoom');
				var popup=get_text_value('popup');

				if(height!=0) height= ' height="'+height+'"';
				else height='';
				if(latitude!= '') latitude= ' latitude="'+latitude+'"';
				else error =true;
				if(longitude!='') longitude= ' longitude="'+longitude+'"';
				else error =true;
				if(zoom!=0) zoom= ' zoom="'+zoom+'"';
				else zoom='';
				
				if(popup!='') popup= ' popup="'+popup+'"';
				else popup='';


				sc='[gmap'+height+latitude+longitude+zoom+popup+']';
				
			break;
			
			case 'gallery':
			
				var cats=get_text_value('cats');

				


				if(cats!=null) cats=' id="'+cats+'"';
				else error=true;
				
				sc='[gallery'+cats+']';
			
			break;
				
			case 'images':
		
				var id=get_text_value('id');
				var width=get_text_value('width');
				var height=get_text_value('height');
				var align=get_text_value('align');
				var lightbox=get_text_value('lightbox');
				var link=get_text_value('link');

				if(id!='') id=' id="'+id+'"';
				else error=true;
				if(width!='0') width=' width="'+width+'"';
				else width='';
				if(height!='0') height=' height="'+height+'"';
				else height='';
				
				if(align!='none') align=' align="'+align+'"';
				else align='';
				
				if(lightbox!='no') lightbox=' lightbox="'+lightbox+'"';
				else lightbox='';
				
				if(link!='') link=' link="'+link+'"';
				else link='';

				
				sc='[img'+id+width+height+align+lightbox+link+']';
				
			break;
			
				case 'portfolio-projects':
						
				var cats=get_text_value('cats');
				
				if(cats!=null) cats=' cats="'+cats+'"';
				else error=true;

				sc='[portfolio-projects'+cats+']';
				
			break;
			
			case 'portfolio':
						
				var cats=get_text_value('cats');
				
				if(cats!=null) cats=' cats="'+cats+'"';
				else error=true;

				sc='[portfolio'+cats+']';
				
			break;
			
			case 'pricing_table':
			
				var columns=get_text_value('columns');				
				var plans='';
				
				for(i=1;i<=columns;i++) {
				
					var name=get_text_value('plan_name_'+i); 
					var price=get_text_value('plan_price_'+i); 
					var per=get_text_value('plan_per_'+i); 
					var description=get_text_value('plan_description_'+i); 
					var link=get_text_value('plan_link_'+i); 
					var linkname=get_text_value('plan_linkname_'+i); 
					var color=get_text_value('plan_color_'+i); 
					var featured=get_text_value('plan_featured_'+i);
					var features=get_text_value('plan_features_'+i); 					
					
					name=' name="'+name+'"';
					price=' price="'+price+'"';
					per=' per="'+per+'"';
					description=' description="'+description+'"';
					link=' link="'+link+'"';
					linkname=' linkname="'+linkname+'"';
					color=' color="'+color+'"';
					
					if(featured=='yes') featured=' featured="true"';
					else featured='';
				
					plans+='[plan'+name+price+per+description+link+linkname+color+featured+']\n'+features+'\n[/plan]\n';
				
				}
				
				columns=' cols="'+columns+'"';
				
				
				sc='[pricing-table'+columns+']\n'+plans+'[/pricing-table]';
				
			break;
				
			case 'slideshow':
						
				var cats=get_text_value('cats');
				var height=get_text_value('height');
				
				if(cats!=null) cats=' gallery="'+cats+'"';
				else error=true;
				
				if(height!=0) height=' height="'+height+'"';
				else error=true;

				sc='[slideshow'+cats+height+']';
				
			break;
			
			case 'slogan':
						
				var content=get_text_value('content');
				
				if(content=='') error=true;


				sc='[slogan]\n'+content+'\n[/slogan]';
				
			break;
				
			case 'typography':

				switch( val2 ){
		
					case 'blockquote':
					
						var content=get_text_value('content');
						
				        if(content=='') error=true;
						
						sc='[blockquote]'+content+'[/blockquote]';
					break;

	
						
					case 'highlight':
					
						var content=get_text_value('content');
						var color=get_text_value('color');
						
						if(content=='') error =true;
						if(color!='...') color = ' color="'+color+'"';
						else color='';
						
						sc='[highlight'+color+']'+content+'[/highlight]';
						
					break;
					
					case 'dropcap':
					
						var text=get_text_value('text');
						
						if(text!='') text = ' text="'+text+'"';
						else error =true;
						
						sc='[dropcap'+text+']';
						
					break;
					

				
					}
					
				break;
				
	
			
			case 'tabs':
			
				var count=get_text_value('count');				
				var tabs='';
				
				for(i=1;i<=count;i++) tabs+='\n[tab title="'+get_text_value('tab_title_'+i)+'"]\n'+get_text_value('tab_content_'+i)+'\n[/tab]\n';
				
				sc='[tabgroup]'+tabs+'[/tabgroup]';
				
			break;
			
			case 'toggles':
			
				var title=get_text_value('title');				
				var content=get_text_value('content');	
				var hidden=get_text_value('hidden');	
				
				if(title!='') title = ' title="'+title+'"';
				
				if(hidden=='yes') hidden = '';
				else hidden = ' hidden="no"';
			
				sc='[toggle'+title+hidden+']\n'+content+'\n[/toggle]';
				
			break;
			 
			case 'videos':

				switch(val2){
				
					case 'youtube':
					
						var id=get_text_value('id');

						if(id!='') id=' id="'+id+'"';
						else error=true;

						sc='[youtube'+id+']';
						
					break;
					case 'vimeo':
					
						var id=get_text_value('id');
	
						if(id!='') id=' id="'+id+'"';
						else error =true;

						sc='[vimeo'+id+']';
					break;
				
				}
				break;
			
		}
		

		if(error==true) return '';
		else return sc;
			 
		e.preventDefault();
		return '';
	
	}
	
});


