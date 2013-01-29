<?php



class Theme_Widget_Portfolio extends WP_Widget {

	function Theme_Widget_Portfolio() {
		$widget_ops = array('classname' => 'widget_portfolio', 'description' => "displays recent portfolio projects" );
		$this->WP_Widget('Portfolio', THEME_SLUG.' - '.'Portfolio', $widget_ops);
		$this->alt_option_name = 'widget_portfolio';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
	
		$cache = wp_cache_get('widget_portfolio', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = $instance['title'];

		
		$cat=$instance['cat'];
		
		$number=$instance['number'];
		

		$query = array(
			"posts_per_page" => $number,
			"post_type" => "portfolio",
			"tax_query" => array(
				array(
				"taxonomy" => "portfolio_category",
				"field" => "id",
				"terms" => $cat
				)
			)
		);
		
	
		
		$r = new WP_Query($query);
		
		if ($r->have_posts()) : ?>
		
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		
		<ul class="clearfix">
		
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
					
			<li>

				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				
					<?php the_post_thumbnail('thumb'); ?>
				
				</a>

			</li>
			
		<?php endwhile; ?>
		</ul>
		
		<?php echo $after_widget; ?>	
		
		<?php
		wp_reset_query();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_portfolio', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_portfolio']) ) delete_option('widget_portfolio');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_portfolio', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$cat = isset($instance['cat']) ? $instance['cat'] : array();
		$number = isset($instance['number']) ? absint($instance['number']) : 3;

		$categories = get_categories(array('type'=>'portfolio', 'taxonomy' => 'portfolio_category','hide_empty'=>0));

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>">Number of portfolio projects to show</label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

			<label for="<?php echo $this->get_field_id('cat'); ?>">Categories</label>
			<select style="height:200px" name="<?php echo $this->get_field_name('cat'); ?>[]" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat" multiple="multiple">
				<?php foreach($categories as $category):?>
				<option value="<?php echo $category->term_id;?>"<?php echo in_array($category->term_id, $cat)? ' selected="selected"':'';?>><?php echo $category->cat_name;?></option>
				<?php endforeach;?>
			</select>
		</p>
<?php
	}
}

