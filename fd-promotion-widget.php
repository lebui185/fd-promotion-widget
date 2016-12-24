<?php 
	
/*
Plugin Name: FD Promotion Widget
Description: Create image with hyperlink
Version: 1.0
Author: Le Bui
License: GPL2
*/

//Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

class FD_Promotion_Widget extends WP_Widget {
	public function __construct() {
		$widget_options = array(
			'classname' => 'fd_promotion_widget',
			'description' => 'Create an image with hyperlink',
		);

		parent::__construct( 
			'fd_promotion_widget',
			'FD Promotion Widget', 
			$widget_options 
		);

		add_action('admin_enqueue_scripts', array($this, 'load_admin_scripts'));
		add_action('admin_enqueue_styles', array($this, 'load_admin_styles'));
		//add_action('wp_enqueue_scripts', array($this, 'load_frontend_scripts'));
		//add_action('wp_enqueue_scripts', array($this, 'load_frontend_styles'));
	}

	public function load_admin_scripts()
	{
		$assets_path = plugins_url('assets/js', __FILE__);

	    wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
	    wp_enqueue_script('fd-upload_media_widget', $assets_path . '/upload-media.js');
	}


	public function load_admin_styles()
    {
        wp_enqueue_style('thickbox');
    }


	// public function load_frontend_scripts()
	// {
	// 	$assets_path = plugins_url('assets/js', __FILE__);
	//    	wp_enqueue_script('fd-frontend-script', $assets_path . '/fd-frontend.js');
	// }

	// public function load_frontend_styles()
	// {
	// 	$assets_path = plugins_url('assets/css', __FILE__);
	// }

	public function widget($args, $instance) {
		echo $args['before_widget'];
		?>
			<a href="<?php echo $instance['link'] ?>">
				<img src="<?php echo $instance['image'] ?>">
			</a>
		<?php
		echo $args['after_widget']; 
	}

	public function form($instance) {

		$image = '';
        if(isset($instance['image']))
        {
            $image = $instance['image'];
        }

		$link = '';
        if(isset($instance['link']))
        {
            $link = $instance['link'];
        }

		?>
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>">Image</label>
			<input type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo esc_attr($image); ?>" class="widefat" />
			<input class="upload_image_button button" type="button" value="Upload Image" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>">Link</label>
			<input type="text" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo esc_attr($link); ?>" class="widefat" />	
		</p>		
		<?php 
	}

	public function update($new_instance, $old_instance) {
		return $new_instance;
	}
}

function register_fd_promotion_widget() { 
	register_widget( 'FD_Promotion_Widget' );
}

add_action( 'widgets_init', 'register_fd_promotion_widget' );

 ?>

