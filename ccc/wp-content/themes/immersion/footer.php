

<?php if(get_meta_option('display_footer')!='off'): ?>

	<div id="bottom_wrap">
	
		<footer class="container">
		
		
			<?php
	
			$footer=get_post_meta(get_the_id(),'custom_footer_value' ,true);

			if(!isset($footer) || $footer!=''){
			
				$footer=explode(',',$footer);	
				$footer_name=$footer[0];
				$layout=$footer[1];

			}

			else{

				$footer=get_theme_option("adm_custom_footers_name");
				$layout=get_theme_option("adm_custom_footers_layout");

				$footer=explode(',',$footer);	
				$layout=explode(',',$layout);

				$footer_name=$footer[0];
				$layout=$layout[0];
			}


			switch($layout):

			case 1: ?>

				<div class="sixteen columns"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>


			<?php
			break;

			case 2: ?>

				<div class="eight columns"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="eight columns"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>

			<?php
			break;

			case 3: ?>

				<div class="one-third column"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="one-third column"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>
				<div class="one-third column"><?php dynamic_sidebar($footer_name.' 3 column'); ?></div>

			<?php
			break;

			case 4: ?>

				<div class="one-third column"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="two-thirds column"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>

			<?php
			break;

			case 5: ?>

				<div class="two-thirds column"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="one-third column"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>

			<?php
			break;

			case 6: ?>

				<div class="four columns"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="four columns"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>
				<div class="four columns"><?php dynamic_sidebar($footer_name.' 3 column'); ?></div>
				<div class="four columns"><?php dynamic_sidebar($footer_name.' 4 column'); ?></div>

			<?php
			break;

			case 7: ?>

				<div class="eight columns"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="four columns"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>
				<div class="four columns"><?php dynamic_sidebar($footer_name.' 3 column'); ?></div>

			<?php
			break;

			case 8: ?>

				<div class="four columns"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="eight columns"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>
				<div class="four columns"><?php dynamic_sidebar($footer_name.' 3 column'); ?></div>

			<?php
			break;

			case 9: ?>

				<div class="four columns"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="four columns"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>
				<div class="eight columns"><?php dynamic_sidebar($footer_name.' 3 column'); ?></div>

			<?php
			break;

			case 10: ?>

				<div class="twelve columns"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="four columns"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>

			<?php
			break;

			case 11: ?>

				<div class="four columns"><?php dynamic_sidebar($footer_name.' 1 column'); ?></div>
				<div class="twelve columns"><?php dynamic_sidebar($footer_name.' 2 column'); ?></div>

			<?php
			break;

			endswitch;
			?>
		
		</footer>
		
			<footer id="subfooter_wrap" class="container">
			
				<div class="sixteen columns">
			
					<div class="eight columns alpha">	
					
						<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => false,'theme_location' =>'footer_nav', 'menu_id' => 'footer_nav', 'menu_class' => '')); ?>
		
					</div>
					
					<div class="eight columns omega copyright">	
						
						<?php echo get_theme_option('copyright_text'); ?>
						
							
					</div>
					
				</div>
			
		
		</footer>
	
	
	</div>
	
	<div class="container">
	
		<div class="sixteen columns">
		
			<ul id="social_icons" class="clearfix">

				<?php $social_icons=explode(',',get_theme_option("social_icons")); ?>

				<?php foreach($social_icons as $icon): ?>
				
					<li>
						<a target="_blank" href="<?php echo get_theme_option("social_icons_".$icon); ?>" title="<?php _e('follow us on',THEME_SLUG); ?> <?php echo $icon; ?>">
						
							<img class="active" src="<?php echo THEME_IMG; ?>/social_icons/<?php echo $icon; ?>.png" />
							<img class="grayscale" src="<?php echo THEME_IMG; ?>/social_icons_gray/<?php echo $icon; ?>.png" />
							
							
						</a>
					</li>
							
				<?php endforeach; ?>

			</ul>
		
		</div>
	
	</div>
	
	
<?php endif; ?>
		
	
	


</section><!-- main-wrap -->


<?php

wp_footer();
if(get_theme_option('google_analytics')!='')  echo '<div class="hidden">'.stripslashes(get_theme_option('google_analytics')).'</div>';

?>

</body>
</html>
