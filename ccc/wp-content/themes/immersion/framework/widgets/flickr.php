<?php



class Theme_Widget_Flickr extends WP_Widget {

	function Theme_Widget_Flickr() {
		$widget_ops = array('classname' => 'widget_flickr', 'description' => 'displays a list of photos from the selected flickr ID');
		$this->WP_Widget('flickr', THEME_SLUG.' - '.'Flickr', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Photos on flickr' : $instance['title'], $instance, $this->id_base);
		$flickr_id = $instance['flickr_id'];
		$count = (int) $instance['count'];


		if($count < 1) $count = 1;
		
		if ( !empty( $flickr_id ) ) {
			echo $before_widget;
			if ($title)
				echo $before_title . $title . $after_title;
		?>
		<div class="flickr_wrap clearfix" data-count="<?php echo $count; ?>" data-id="<?php echo $flickr_id; ?>"></div>

		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['count'] = (int) $new_instance['count'];

		
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$flickr_id = isset($instance['flickr_id']) ? esc_attr($instance['flickr_id']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		$display = isset( $instance['display'] ) ? $instance['display'] : 'latest';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>)</label>
		<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('count'); ?>">Number of photos to show</label>
		<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
		

<?php
	}
}

