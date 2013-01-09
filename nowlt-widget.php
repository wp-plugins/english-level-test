<?php
/**
 * Plugin Name: English level test
 * Plugin URI: http://www.englishleveltest.com/widget/wp/nowlt-widget.zip
 * Description: English level test according to the CEFR.
 * Version: 1.0
 * Author: Roberto Ladd
 * Author URI: http://www.englishleveltest.com
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'now_load_widgets' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function now_load_widgets() {
	register_widget( 'NowLt_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class NowLt_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function NowLt_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'nowlt', 'description' => __('English level test according to the CEFR', 'nowlt') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'nowlt-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'nowlt-widget', __('English Level Test', 'nowlt'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		$theme = $instance['theme'];
                $hidelink = $instance['hidelink'];

		/* Before widget (defined by themes). */
		echo $before_widget;
                
                /* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display the widget iframe */
		?>
                <iframe src="http://www.englishleveltest.com/widget-level-test/<?php echo $theme;?>" width="100%" height="370" allowtransparency="true"></iframe>
                <?php
                if($hidelink != 'yes') echo '<span style="font-size:10px;">Powered by <a target="_blank" href="http://www.englishleveltest.com">The English level test</a></span>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['theme'] = $new_instance['theme'];
                $instance['hidelink'] = $new_instance['hidelink'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array('title' => __('English level test', 'nowlt'), 'theme' => 'bright', 'hidelink', 'no');
		$instance = wp_parse_args( (array) $instance, $defaults );?>
                
                <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title'] ? $instance['title'] : 'English level test'; ?>" style="width:100%;" />
		</p>
		<!-- Theme: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'theme' ); ?>"><?php _e('Theme:', 'nowlt'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'bright' == $instance['theme'] ) echo 'selected="selected"'; ?> >bright</option>
				<option <?php if ( 'dark' == $instance['theme'] ) echo 'selected="selected"'; ?> >dark</option>
			</select>
		</p>
                <!-- Link: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'hidelink' ); ?>"><?php _e('Hide powered by link:', 'nowlt'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'hidelink' ); ?>" name="<?php echo $this->get_field_name( 'hidelink' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'no' == $instance['hidelink'] ) echo 'selected="selected"'; ?> >no</option>
				<option <?php if ( 'yes' == $instance['hidelink'] ) echo 'selected="selected"'; ?> >yes</option>
			</select>
		</p>

	<?php
	}
}

?>