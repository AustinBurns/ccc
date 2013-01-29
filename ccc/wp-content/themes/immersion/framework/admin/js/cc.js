jQuery(document).ready( function($) {


	var layoutType=$('#content_composer_wrap').attr('data-layout');
	$('#layout-type').change(function() {
		
		$('#content_composer_wrap').attr('data-layout', $(this).val());
		layoutType=$(this).val();
		
		//delete all column rows
		$('.content_row').remove();
		
		update_layout_field();
	  
	});

	var $colCount=$('#col-count');
	var $colLayout=$('#col-layout');

	$('#content_composer_wrap').sortable({
	
		placeholder: 'ui-state-highlight-row',
		tolerance: 'pointer',

		update: function(event, ui) { 

			update_layout_field();
			update_textarea_id();
			$('#content').val(generate_layout_code());

		}
	});
	
	function update_col_count(){
	
		$colCount.val($('.content_column').length);
		
	}
	
	function update_textarea_id(){
	
		$('.content_row textarea').each(function(index) {
		
			$(this).attr('name', 'content_textarea_'+(index+1));
		
		
		});
	
	}


	add_sortables();
	function add_sortables(){

		$('.content_row').sortable({
		
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			tolerance: 'pointer',

			update: function(event, ui) { 

				update_layout_field();
				update_textarea_id();
				$('#content').val(generate_layout_code());

			}
		});
	
	}
	
	function update_layout_field(){
	
		var str="";
	
		$('.content_row').each(function(index) {

			$('.content_column',$(this)).each(function(index) {
				
				str+=$(this).attr('data-size')+',';
				
			});
			
			str = str.slice(0,str.length-1);
			str+='|';
			
		});
		
		str = str.slice(0,str.length-1);
		$colLayout.val(str);

	
	}
	
	var $row;
	var remaining;

	$('#add_column').click(function(){
	
		$row=getfreerow();
		remaining=parseInt($row.attr('data-remaining'));
		context=parseInt($row.attr('data-context'));
		
		if(context==12){
		
			if(remaining==1){
			
				$row.append('<li class="content_column one_third_columns" data-size="33"><span>1/3</span><div class="content_button content_close"></div><div class="content_button content_plus"></div><div class="content_button content_left"></div><div class="content_button content_right"></div><textarea class="hidden"></textarea></li>');
		
			}
			else{
			
				$row.append('<li class="content_column two_third_columns" data-size="66"><span>2/3</span><div class="content_button content_close"></div><div class="content_button content_plus"></div><div class="content_button content_left"></div><div class="content_button content_right"></div><textarea class="hidden"></textarea></li>');
		
			}
			
		}
		else{
		
			$row.append('<li class="content_column '+getClassName(remaining)+'_columns" data-size="'+remaining+'"><span>'+remaining+'/'+layoutType+'</span><div class="content_button content_close"></div><div class="content_button content_plus"></div><div class="content_button content_left"></div><div class="content_button content_right"></div><textarea class="hidden"></textarea></li>');
	
		}
		
		update_layout_field();
		update_col_count();
		$('#content').val(generate_layout_code());
		$row.attr('data-remaining', 0 );
		
		add_textarea_ids();
		
	});
	

	
	function generate_layout_code(){
	
		var str="";
		var i=1;
	
		$('.content_row').each(function(index) {

			var columns_count=$(this).children('.content_column').length;
			
			$('.content_column',$(this)).each(function(index) {
							
				switch(index){
				
					case 0:
						parameter=" pos='first'";
					break;
					case (columns_count-1):
						parameter=" pos='last'";
					break;
					default:
						parameter="";
				}
				
				$this=$(this);
				$textarea=$(this).children('textarea');
				size=parseInt($this.attr('data-size'));
				
				if(size==33) col_layout='1/3';
				else if(size==66) col_layout='2/3';
				else col_layout=size+'/16';
				
				if((layoutType==12 && size==12) || (layoutType==16 && size==16)) str+=$textarea.val()+"\n\n";

				else{
				
					str+="[col size='"+col_layout+"'"+parameter+"]\n\n";
					str+=$textarea.val();
					str+="\n\n[/col]\n\n";
				
				}
				
				i++;

				
			});
			

		});
		
		return str;

	}
	
	function getfreerow(){
	
		var i=-1;
		
		$('.content_row').each(function(index) {

			$this=$(this);
			var remaining=parseInt($this.attr('data-remaining'));
			if(remaining!=0) { i=index; return false; }
			
		});
		
		if(i==-1) {
			$('#content_composer_wrap').append('<ul class="content_row" data-context="16" data-remaining="'+$('#content_composer_wrap').attr('data-layout')+'"></ul>'); 
			add_sortables();
			$colLayout.val($colLayout.val()+'|');
			i=$('.content_row').size()-1;
		}
	
		return $('.content_row').eq(i);

	}
	
	
	function getClassName(rem){
	
		switch(rem){
			
			case 1:
				return 'one';
			break;
			case 2:
				return 'two';
			break;
			case 3:
				return 'three';
			break;
			case 4:
				return 'four';
			break;
			case 5:
				return 'five';
			break;
			case 6:
				return 'six';
			break;
			case 7:
				return 'seven';
			break;
			case 8:
				return 'eight';
			break;
			case 9:
				return 'nine';
			break;
			case 10:
				return 'ten';
			break;
			case 11:
				return 'eleven';
			break;
			case 12:
				return 'twelve';
			break;
			case 13:
				return 'thirteen';
			break;
			case 14:
				return 'fourteen';
			break;
			case 15:
				return 'fifteen';
			break;
			case 16:
				return 'sixteen';
			break;


			}

	
	}
	
	function decreaseSize($column){
	

	
		var size=parseInt($column.attr('data-size'));
		if(size==1) return false;
		$row=$column.parent();
		context=parseInt($row.attr('data-context'));

		
		if($row.children('.content_column').length==1){
		
			if(layoutType==12){
			
				$column.removeClass(getClassName(size)+'_columns').addClass(getClassName(size-1)+'_columns').attr('data-size',size-1).children('span').text((size-1)+'/12');
				$row.attr('data-remaining', parseInt($row.attr('data-remaining'))+1 );
			
			}
			else{
			
				switch(size){
		
					case 33:
						$column.removeClass('one_third_columns').addClass('five_columns').attr('data-size',5).children('span').text('5 / 16');
						$row.attr('data-context',16).attr('data-remaining', 11);
					break;
					case 66:
						$column.removeClass('two_third_columns').addClass('ten_columns').attr('data-size',10).children('span').text('10/16');
						$row.attr('data-context',16).attr('data-remaining', 6);
					break;
					case 6:
						$column.removeClass(getClassName(size)+'_columns').addClass('one_third_columns').attr('data-size',33).children('span').text('1/3');
						$row.attr('data-context',12).attr('data-remaining', 2);
					break;
					case 11:
						$column.removeClass(getClassName(size)+'_columns').addClass('two_third_columns').attr('data-size',66).children('span').text('2/3');
						$row.attr('data-context',12).attr('data-remaining', 1);
					break;
					default: 
						$column.removeClass(getClassName(size)+'_columns').addClass(getClassName(size-1)+'_columns').attr('data-size',size-1).children('span').text((size-1)+'/16');
						$row.attr('data-remaining', parseInt($row.attr('data-remaining'))+1 );
					break;

				}
			
			}
		

		
		}
		
		else{
		
			if(layoutType==12){
			
				$column.removeClass(getClassName(size)+'_columns').addClass(getClassName(size-1)+'_columns').attr('data-size',size-1).children('span').text((size-1)+'/12');
				$row.attr('data-remaining', parseInt($row.attr('data-remaining'))+1 );
			
			}
			else{
			
				if(context==12){
				
					if($row.children('.content_column').length==3) return false;
					$column.removeClass('two_third_columns').addClass('one_third_columns').attr('data-size',33).children('span').text('1/3');
					$row.attr('data-remaining', 1);
				
				}
				else{
		
					$column.removeClass(getClassName(size)+'_columns').addClass(getClassName(size-1)+'_columns').attr('data-size',size-1).children('span').text((size-1)+'/16');
					$row.attr('data-remaining', parseInt($row.attr('data-remaining'))+1 );

				}
			
			}
		

		}
		

		update_layout_field();
	
	}
	
	function increaseSize($column){
			
		var size=parseInt($column.attr('data-size'));
		if(size==16) return false;
		$row=$column.parent();
		context=parseInt($row.attr('data-context'));
		if(parseInt($row.attr('data-remaining'))==0) return false;

		
		if($row.children('.content_column').length==1){
		
			if(layoutType==12){
			
				$column.removeClass(getClassName(size)+'_columns').addClass(getClassName(size+1)+'_columns').attr('data-size',size+1).children('span').text((size+1)+'/12');
				$row.attr('data-remaining', parseInt($row.attr('data-remaining'))-1 );
			
			}
			else{
			
				switch(size){
		
				case 33:
					$column.removeClass('one_third_columns').addClass('siv_columns').attr('data-size',6).children('span').text('6 / 16');
					$row.attr('data-context',16).attr('data-remaining', 10);
				break;
				case 66:
					$column.removeClass('two_third_columns').addClass('eleven_columns').attr('data-size',11).children('span').text('11 / 16');
					$row.attr('data-context',16).attr('data-remaining', 5);
				break;
				case 5:
					$column.removeClass(getClassName(size)+'_columns').addClass('one_third_columns').attr('data-size',33).children('span').text('1 / 3');
					$row.attr('data-context',12).attr('data-remaining', 2);
				break;
				case 10:
					$column.removeClass(getClassName(size)+'_columns').addClass('two_third_columns').attr('data-size',66).children('span').text('2 / 3');
					$row.attr('data-context',12).attr('data-remaining', 1);
				break;
				default: 
					$column.removeClass(getClassName(size)+'_columns').addClass(getClassName(size+1)+'_columns').attr('data-size',size+1).children('span').text((size+1)+'/16');
					$row.attr('data-remaining', parseInt($row.attr('data-remaining'))-1 );
				break;

				}
			
			
			}
		
			
		
		}
		
		else{
		
			if(layoutType==12){
			
				$column.removeClass(getClassName(size)+'_columns').addClass(getClassName(size+1)+'_columns').attr('data-size',size+1).children('span').text((size+1)+'/12');
				$row.attr('data-remaining', parseInt($row.attr('data-remaining'))-1 );
			
			}
			
			else{
			
				if(context==12){
				
					$column.removeClass('one_third_columns').addClass('two_third_columns').attr('data-size',66).children('span').text('2 / 3');
					$row.attr('data-remaining', 0);
				
				}
				else{
		
					$column.removeClass(getClassName(size)+'_columns').addClass(getClassName(size+1)+'_columns').attr('data-size',size+1).children('span').text((size+1)+'/16');
					$row.attr('data-remaining', parseInt($row.attr('data-remaining'))-1 );

				}
		
			}
		

		}
		

		update_layout_field();
		
	}
	
	function add_textarea_ids(){
		
		$('.content_row textarea').each(function(index) {
			
			$(this).attr('name','content_textarea_'+(index+1)).attr('id','content_textarea_'+(index+1));
			
		});
	
	
	}
	

	

	
	$(document).delegate('.content_column .content_left', 'click', function() {
	
		decreaseSize($(this).parent());
		$('#content').val(generate_layout_code());
        return false;  
	
	});
	
	$(document).delegate('.content_column .content_right', 'click', function() {
	
		increaseSize($(this).parent());
		$('#content').val(generate_layout_code());
        return false;  
	
	});
	
	$(document).delegate('.content_column .content_plus', 'click', function() {
	
		$this=$(this);
		
		var offsetLeft=$(this).parent().offset().left;
	
		$this.parent().parent().children('.content_column').removeClass('active');
		$this.parent().addClass('active').parent().find('.content_minus').removeClass('content_minus');
		$this.addClass('content_minus');
		id=$this.parent().attr('data-id');
				
	
		
		$this.parent().parent().find('textarea').addClass('hidden');
		
		
		
		$this.siblings('textarea').css({left:-offsetLeft+185}).removeClass('hidden');
		
	});
	
	$(document).delegate('.content_column .content_minus', 'click', function() {
	
		$this=$(this);
		$this.removeClass('content_minus');
		id=$this.parent().attr('data-id');

		
		$this.siblings('textarea').addClass('hidden');

		
	});
	
	$(document).delegate('.content_column .content_close', 'click', function() {
	
		$this=$(this);
		$column=$this.parent();
		$row=$column.parent();
		size=parseInt($column.attr('data-size'));
		context=parseInt($row.attr('data-context'));
		remaining=parseInt($row.attr('data-remaining'));
		

		$column.remove();
		

		if(context==12 ){
		
			if(size==33)  $row.attr('data-remaining',parseInt($row.attr('data-remaining'))+1);
			else $row.attr('data-remaining',parseInt($row.attr('data-remaining'))+2);
		
			if(parseInt($row.attr('data-remaining'))==3) $row.remove();
		
		}
		else{
		
			
		
			$row.attr('data-remaining',parseInt($row.attr('data-remaining'))+parseInt($column.attr('data-size')));
			
			if(layoutType==12 && parseInt($row.attr('data-remaining'))==12) $row.remove();
			if(layoutType==16 && parseInt($row.attr('data-remaining'))==16) $row.remove();
		
		}
		
		update_layout_field();
		$('#content').val(generate_layout_code());
		update_col_count();
		add_textarea_ids();
		
	});
	
	
	$(document).delegate('.content_column textarea', 'keyup', function() {
	
		$('#content').val(generate_layout_code());
	
	});
	
	
		
	
	
	
	
});


