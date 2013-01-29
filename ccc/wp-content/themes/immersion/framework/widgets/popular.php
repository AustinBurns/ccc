<?php



class Theme_Widget_Popular_Posts extends WP_Widget {

	function Theme_Widget_Popular_Posts() {
		$widget_ops = array('classname' => 'widget_popular_posts', 'description' => "displays popular posts" );
		$this->WP_Widget('popular_posts', THEME_SLUG.' - '.'Popular Posts', $widget_ops);
		$this->alt_option_name = 'widget_popular_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
	
		$cache = wp_cache_get('widget_popular_posts', 'widget');

		if ( !is_array($cache) ) $cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Popular Posts' : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] ) $number = 3;
		elseif ( $number < 1 ) $number = 1;
		else if ( $number > 10 ) $number = 10;
	
		$query = array('posts_per_page' => $number, 'nopaging' => 0, 'orderby'=> 'comment_count', 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		
		if(!empty($instance['cat'])) $query['cat'] = implode(',', $instance['cat']);
		
		$r = new WP_Query($query);
		if ($r->have_posts()) : ?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="posts">
		
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		
			<li>

				<a class="post_title" href="<?php the_permalink() ?>" title="<?php the_title();?>"><?php the_title(); ?></a>
				<div class="post_meta"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date('j M');?></a> - <?php comments_popup_link(__( '0 comments', THEME_SLUG ), __( '1 comment', THEME_SLUG ), __( '% comments', THEME_SLUG )); ?></div>
				<div class="post_excerpt"><?php echo tf_the_excerpt_max_charlength(70); ?></div>


			</li>
			
		<?php endwhile; ?>
		</ul>
		
		<?php echo $after_widget; ?>	
		
		<?php
		wp_reset_query();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_popular_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_popular_posts']) ) delete_option('widget_popular_posts');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_popular_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$cat = isset($instance['cat']) ? $instance['cat'] : array();
		$number = isset($instance['number']) ? absint($instance['number']) : 3;

		$categories = get_categories('orderby=name&hide_empty=0');

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>">Number of posts to show</label>
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

