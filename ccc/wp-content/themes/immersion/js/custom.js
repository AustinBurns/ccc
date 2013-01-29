jQuery(document).ready(function($) {

	//preload images
	if(!$.browser.msie) $(window).preloader();

	
	//create menu select
	$('header #nav').mobileMenu();
	
	$('header #nav > li >.sub-menu').append('<span></span>');
	
	
	$('header #nav').superfish({	
		autoArrows:    false
	}); 

	
		
	if(!$.browser.msie) $('#social_icons li a').tipTip({defaultPosition:'top'});
	
	
	//change margin top of main wrap
	$(window).resize(function() {
	
		$('#main-wrap').css({marginTop:$(window).height()});
		
	}).trigger('resize');

	

	//portfolio filter
	$('.portfolio-categories li a').click(function(){
	
		$this=$(this);
		
		$this.parent().parent().find('a').removeClass('current');
		$this.addClass('current');
		
		var cat=$this.attr('data-cat');
		var $list=$this.parent().parent().next();
		
		$list.children('li').children('span').fadeIn(200);
		$list.children('.cat-'+cat).children('span').fadeOut(200);
		
		if(cat=='all') $list.children('li').children('span').fadeOut(200);
	
	});

	//lighbox
	$('a.lightbox[href*="http://vimeo.com/"]').each(function() {
		$(this).attr('href',this.href.replace('vimeo.com/', 'player.vimeo.com/video/')).removeClass('lightbox').addClass('lightbox-video');
	});
	$('a.lightbox[href*="http://www.youtube.com/watch?"]').each(function() {
		$(this).attr('href',this.href.replace('watch?v=', 'embed/')).removeClass('lightbox').addClass('lightbox-video');
	});
	
	
	function lightbox_init(){

		$("a.lightbox").colorbox({
			rel:'lightbox',
			fixed:true,
			opacity :0.8,
			maxWidth:	'90%',
			maxHeight: '90%',
		});
		
		$("a.lightbox-video").colorbox({
		
			fixed:true,
			opacity :0.8,
			iframe:true,			
			innerWidth:'60%', innerHeight:'60%'
		
		});
	}
	lightbox_init();
	
	
	$('#down_arrow').click(function(e){
	
		$('#main-wrap').css({display:'block'});		
		$.scrollTo('#main-wrap',600, {easing:'easeInOutExpo'});
		
	});
	
	


	//flickr images
	$(".flickr_wrap").each(function(index){
	
		var $this=$(this);
		var count=$this.attr('data-count');
		var id=$this.attr('data-id');

		$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id="+id+"&lang=en-us&format=json&jsoncallback=?", function(data){

			$.each(data.items, function(i,item){

				if(i<count) $("<img/>").attr("src", item.media.m.replace('_m.jpg','_s.jpg')).attr("title",item.title).appendTo($this).wrap("<a title="+item.title+" class='lightbox' href='" + (item.media.m).replace("_m.jpg", "_b.jpg") + "'></a>");

			});
			
			lightbox_init();

		});
	
	});
	

	
	
	
 
});