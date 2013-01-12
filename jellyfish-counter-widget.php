<?php 
/*
  Plugin Name: Jellyfish Counter Widget
  Plugin URI: http://strawberryjellyfish.com/jellyfish-counter-widget/
  Description: Creates a widget with an odometer style counter that displays either a static number or animates up to a predefined value.
  Author: Rob Miller
  Version: 0.3
  Author URI: http://strawberryjellyfish.com/
 */
?>
<?php
// Register function to be called when widget initialization occurs

add_action( 'widgets_init', 'jellyfish_cw_create_widgets' );

// Create new widget
function jellyfish_cw_create_widgets() {
    register_widget( 'Jellyfish_Counter_Widget' );
}

// Widget implementation class
class Jellyfish_Counter_Widget extends WP_Widget {
    
    // Constructor function
    function __construct() {
        // Widget creation function
	parent::__construct( 
                'counter_widget', 
                'Counter Widget', 
                array( 'description' => 'Show an odometer style counter' ) 
        );
    }

    // Code to render options form
    function form( $instance ) {
        
                // Retrieve previous values from instance
        // or set default values if not present
	$show_title = ( !empty( $instance['show_title'] ) ?
                  $instance['show_title'] : 'true' );
	
        $widget_title = ( !empty( $instance['widget_title'] ) ? 
					esc_attr( $instance['widget_title'] ) :
							'Counter' );
		
        $display_tenths = ( !empty( $instance['display_tenths'] ) ?
					  $instance['display_tenths'] : 'true' );
		
        $number_of_digits = ( !empty( $instance['number_of_digits'] ) ? 
					esc_attr( $instance['number_of_digits'] ) :
							'6' );
		
        $digit_height = ( !empty( $instance['digit_height'] ) ? 
					esc_attr( $instance['digit_height'] ) :
							'40' );
		
        $digit_width = ( !empty( $instance['digit_width'] ) ? 
					esc_attr( $instance['digit_width'] ) :
							'30' );
		
        $digit_padding = ( !empty( $instance['digit_padding'] ) ? 
					esc_attr( $instance['digit_padding'] ) :
							'0' );
		
        $digit_bustedness = ( !empty( $instance['digit_bustedness'] ) ? 
					esc_attr( $instance['digit_bustedness'] ) :
							'2' );
		
        $digit_style = ( !empty( $instance['digit_style'] ) ? 
					esc_attr( $instance['digit_style'] ) :
							'font-family: Courier New, Courier, monospace; font-weight: 900;' );
		
        $start_value = ( !empty( $instance['start_value'] ) ? 
					esc_attr( $instance['start_value'] ) :
							'0' );
		
        $end_value = ( !empty( $instance['end_value'] ) ? 
					esc_attr( $instance['end_value'] ) :
							'100' );
       $animate_speed = ( !empty( $instance['animate_speed'] ) ? 
					esc_attr( $instance['animate_speed'] ) :
							'50' );
                
	?>
	<p>
                   <label for="<?php echo 
						$this->get_field_id( 'widget_title' ); ?>">
			<?php echo 'Title:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'widget_title' ); ?>"
					name="<?php echo $this->get_field_name( 'widget_title' ); ?>"
					value="<?php echo $widget_title; ?>" />			
                    </label>
		</p>
                <p>
                    <label for="<?php echo 
						$this->get_field_id( 'show_title' ); ?>">
			<?php echo 'Show Title'; ?>			
			<select id="<?php echo $this->get_field_id( 'show_title' ); ?>"
					name="<?php echo $this->get_field_name( 'show_title' ); ?>">
				<option value="true"
					<?php selected( $show_title, 'true' ); ?>>
					Yes</option>
				<option value="false"
					<?php selected( $show_title, 'false' ); ?>>
					No</option>
			</select>
                    </label>
		</p>
		<p>
                    <label for="<?php echo 
						$this->get_field_id( 'number_of_digits' ); ?>">
			<?php echo 'Number of Digits:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'number_of_digits' ); ?>"
					name="<?php echo $this->get_field_name( 'number_of_digits' ); ?>"
					value="<?php echo $number_of_digits; ?>" />			
                    </label>
		</p> 
		<p>
                    <label for="<?php echo 
						$this->get_field_id( 'display_tenths' ); ?>">
			<?php echo 'Display Tenths'; ?>			
			<select id="<?php echo $this->get_field_id( 'display_tenths' ); ?>"
					name="<?php echo $this->get_field_name( 'display_tenths' ); ?>">
				<option value="true"
					<?php selected( $display_tenths, 'true' ); ?>>
					Yes</option>
				<option value="false"
					<?php selected( $display_tenths, 'false' ); ?>>
					No</option>
			</select>
                    </label>
		</p>
		<p>
                    <label for="<?php echo 
						$this->get_field_id( 'start_value' ); ?>">
			<?php echo 'Start Value:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'start_value' ); ?>"
					name="<?php echo $this->get_field_name( 'start_value' ); ?>"
					value="<?php echo $start_value; ?>" />			
                    </label>
		</p>
                <p>
                    <label for="<?php echo 
						$this->get_field_id( 'end_value' ); ?>">
			<?php echo 'End Value:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'end_value' ); ?>"
					name="<?php echo $this->get_field_name( 'end_value' ); ?>"
					value="<?php echo $end_value; ?>" />			
                    </label>
		</p> 
               <p>
                    <label for="<?php echo 
						$this->get_field_id( 'animate_speed' ); ?>">
			<?php echo 'Animation Speed (1-100):'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'animate_speed' ); ?>"
					name="<?php echo $this->get_field_name( 'animate_speed' ); ?>"
					value="<?php echo $animate_speed; ?>" />			
                    </label>
		</p> 
		<p>
                    <label for="<?php echo 
						$this->get_field_id( 'digit_height' ); ?>">
			<?php echo 'Digit Height:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'digit_height' ); ?>"
					name="<?php echo $this->get_field_name( 'digit_height' ); ?>"
					value="<?php echo $digit_height; ?>" />			
                    </label>
		</p>		
                <p>
                    <label for="<?php echo 
						$this->get_field_id( 'digit_width' ); ?>">
			<?php echo 'Digit Width:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'digit_width' ); ?>"
					name="<?php echo $this->get_field_name( 'digit_width' ); ?>"
					value="<?php echo $digit_width; ?>" />			
                    </label>
		</p>		
                <p>
                    <label for="<?php echo 
						$this->get_field_id( 'digit_padding' ); ?>">
			<?php echo 'Digit Padding:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'digit_padding' ); ?>"
					name="<?php echo $this->get_field_name( 'digit_padding' ); ?>"
					value="<?php echo $digit_padding; ?>" />			
                    </label>
		</p>		
                <p>
                    <label for="<?php echo 
						$this->get_field_id( 'digit_bustedness' ); ?>">
			<?php echo 'Digit Bustedness:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'digit_bustedness' ); ?>"
					name="<?php echo $this->get_field_name( 'digit_bustedness' ); ?>"
					value="<?php echo $digit_bustedness; ?>" />			
                    </label>
		</p>		
                <p>
                    <label for="<?php echo 
						$this->get_field_id( 'digit_style' ); ?>">
			<?php echo 'Digit Style:'; ?>			
			<input type="text" 
					id="<?php echo $this->get_field_id( 'digit_style' ); ?>"
					name="<?php echo $this->get_field_name( 'digit_style' ); ?>"
					value="<?php echo $digit_style; ?>" />			
                    </label>
		</p>
<?php
        
    }


    function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
                // validate inputs
                
		// Only numeric values
                if ( is_numeric ( $new_instance['number_of_digits'] ) ) {
                    $instance['number_of_digits'] = intval( $new_instance['number_of_digits'] );
                } else {
                    $instance['number_of_digits'] = $instance['number_of_digits'];
                }

                if ( is_numeric ( $new_instance['digit_height'] ) ) {
                    $instance['digit_height'] = intval( $new_instance['digit_height'] );
                } else {
                    $instance['digit_height'] = $instance['digit_height'];
                }

                if ( is_numeric ( $new_instance['digit_width'] ) ) {
                    $instance['digit_width'] = intval( $new_instance['digit_width'] );
                } else {
                    $instance['digit_width'] = $instance['digit_width'];
                }
                
                if ( is_numeric ( $new_instance['digit_padding'] ) ) {
                    $instance['digit_padding'] = intval( $new_instance['digit_padding'] );
                } else {
                    $instance['digit_padding'] = $instance['digit_padding'];
                }

                if ( is_numeric ( $new_instance['digit_bustedness'] ) ) {
                    $instance['digit_bustedness'] = intval( $new_instance['digit_bustedness'] );
                } else {
                    $instance['digit_bustedness'] = $instance['digit_bustedness'];
                }

                if ( is_numeric ( $new_instance['start_value'] ) ) {
                    $instance['start_value'] = floatval( $new_instance['start_value'] );
                } else {
                    $instance['start_value'] = $instance['start_value'];
                }

                if ( is_numeric ( $new_instance['end_value'] ) ) {
                    $instance['end_value'] = floatval( $new_instance['end_value'] );
                } else {
                    $instance['end_value'] = $instance['end_value'];
                }
                if ( is_numeric ( $new_instance['animate_speed'] ) ) {
                    $instance['animate_speed'] = intval( $new_instance['animate_speed'] );
                    if ($instance['animate_speed'] >100) {
                        $instance['animate_speed']=100;
                    }
                } else {
                    $instance['end_value'] = $instance['end_value'];
                }
                // string values
		$instance['digit_style'] =
			strip_tags( $new_instance['digit_style'] );

                $instance['widget_title'] =
			strip_tags( $new_instance['widget_title'] );
                // boolean values
		$instance['show_title'] =
			strip_tags( $new_instance['show_title'] );

                $instance['display_tenths'] =
			strip_tags( $new_instance['display_tenths'] );

		return $instance;
    }

    function widget( $args, $instance ) {
            // queue javascript if widget is used
    if ( is_active_widget(false, false, $this->id_base) )
            wp_enqueue_script('odometer', plugins_url( 'js/odometer.js', __FILE__ ), array('jquery'), '', true );

        // Extract members of args array as individual variables
        extract( $args );
        $widget_title = $instance['widget_title'];
        $show_title = $instance['show_title'];
        $number_of_digits = $instance['number_of_digits'];
        $start_value = $instance['start_value'];
        $end_value = $instance['end_value'];
        $display_tenths = $instance['display_tenths'];
        $animate_speed = $instance['animate_speed'];
        $digit_height = $instance['digit_height'];
        $digit_width = $instance['digit_width'];
        $digit_padding = $instance['digit_padding'];
        $digit_bustedness = $instance['digit_bustedness'];
        $digit_style = $instance['digit_style'];
        // Display widget title
        echo $before_widget;
        if ($show_title == 'true') {
            echo $before_title;
            echo apply_filters( 'widget_title', $widget_title);
            echo $after_title;
        }
        
        // output counter div
        echo '<div id="odometer-'.$args['widget_id'] .'" class="odometer"></div>';
        // output javascript
        echo "<script type='text/javascript'>
                jQuery(document).ready(function() {
                        var waitTime = 100 - $animate_speed;
                        var counterStartValue = $start_value;
                        var counterEndValue = $end_value;
                        var counterNow = $start_value;
                        var div = document.getElementById('odometer-".$args['widget_id'] ."');
                        var myOdometer = new Odometer(div, {
                                       digits: $number_of_digits, 
                                       tenths: $display_tenths,
                                       digitHeight: $digit_height,
                                       digitWidth: $digit_width,
                                       digitPadding: $digit_padding,
                                       fontStyle: '$digit_style',
                                       bustedness: $digit_bustedness
                                       });
                        
                         function updateOdometer() {
				counterNow=counterNow+0.005;
                                if (counterNow < counterEndValue) {
                                    myOdometer.set(counterNow);
                                    window.setTimeout(function() {
                                        updateOdometer();
                                    }, waitTime);
                                }
			}
                        
                        if ( counterEndValue != counterStartValue) {
                            // animate counter 
                            myOdometer.set(counterStartValue);
                            updateOdometer();
                        } else {
                            // just set to a static value
                            myOdometer.set(counterStartValue);
                        }
                    }
                );
	</script>";
        
        // finish off widget
        echo $after_widget;
    }    
}
?>