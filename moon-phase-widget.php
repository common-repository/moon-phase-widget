<?php

/*
  Plugin Name: Moon Phase Widget
  Plugin URI: http://dianagarland.com/wp-moon-phase-widget/
  Description: Sidebar widget to show the moon phase
  Author: Duncan Marshall
  Version: 1.0
  Author URI: http://duncanmarshall.net/

 * *************************************************************************

  Copyright (C) 2010-2012 Duncan Marshall

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.

 * *************************************************************************

 */

class MoonPhase_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'MoonPhase_Widget', // Base ID
			'Moon Phase Widget', // Name
			array( 'description' => __( 'A Moon Phase Widget', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
	
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$links_enabled = apply_filters( 'widget_title', $instance['links_enabled'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			?>
			
				<div id="moon_widget_continer" style="padding:6px;background-color:black;text-align:center;">
					
					<div id="moon_widget_sizer" style="position: relative;padding-bottom: 100%;padding-top: 0px;height: 0;overflow: hidden;">
					
						<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" id="moon_widget_iframe" width="500" height="500" src="https://dianagarland.com/wdget_moon_phase/" frameborder="0" allowfullscreen=""></iframe>
						
					</div><!--#moon_widget_container-->
				
				</div>
				
				<?php if ($links_enabled): ?>
				
					<p style="text-align:center;"><a href="http://dianagarland.com/">Powered by DianaGarland.com</a></p>
				
				<?php endif; ?>

				
			<?php

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['links_enabled'] = $new_instance['links_enabled'];

		return $instance;
	}

	public function form( $instance ) {

		$links_enabled = esc_attr( $instance[ 'links_enabled' ] );
		$title = esc_attr( $instance[ 'title' ] );
		if ($title == ""){$title = "Current Moon Phase:";}
	
		?>
	
			
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>	
		
		<?php if ($links_enabled != "on"){?><span style="color:red;">Please support us by giving us a link.</span><?php } ?>
		
		<p>
		<label for="<?php echo $this->get_field_id('links_enabled'); ?>"><?php _e('"Powered by" link:'); ?></label> 
		<input id="<?php echo $this->get_field_id('links_enabled'); ?>" name="<?php echo $this->get_field_name('links_enabled'); ?>" type="checkbox" value="on" <?php if ($links_enabled=="on") {echo ' checked="yes"'; } ?>>
		</input>
		</p>		
		

		<?php 
	}

} // class MoonPhase_Widget


add_action( 'widgets_init', create_function( '', 'register_widget("MoonPhase_Widget");' ) );



?>