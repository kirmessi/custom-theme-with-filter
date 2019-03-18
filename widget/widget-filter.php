<?php

/**
 * Adds Foo_Widget widget.
 */
class Filter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'filter_widget', // Base ID
			esc_html__( 'Widget Filter', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'display taxonomeis filter', 'text_domain' ), ) // Args
		);
		add_action( 'widgets_init', array( $this, 'register_filter_widget' ) );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @param   array  $args      Widget arguments.
	 * @param   array  $instance  Saved values from database.
	 *
	 * @see WP_Widget::widget()
	 *
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$price = $instance['price'] ? 'true' : 'false';
		if ( 'on' == $instance['price'] ) :
			echo Filter_Widget_Content::get_price();
		endif;
		$text       = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$args       = array(
			'public'   => true,
			'_builtin' => false
		);
		$taxonomeis = get_taxonomies( $args, 'objects' );

		echo '<div class="white-block white-projects"><div class="wrapper filter-line">';

		foreach ( $taxonomeis as $taxonomy ):
			$is_visual_text_widget = ( ! empty( $instance[ $taxonomy->name ] ) );
			if ( $is_visual_text_widget ) {

				$instance[ $taxonomy->name ] = true;

				if ( $instance[ $taxonomy->name ] == true and $taxonomy->name == 'smartphones_manufactures' ) {
					echo Filter_Widget_Content::get_select_manufacture();
				}

				if ( $instance[ $taxonomy->name ] == true and $taxonomy->name == 'smartphones_ram' ) {
					echo Filter_Widget_Content::get_ram();
				}

				if ( $instance[ $taxonomy->name ] == true and $taxonomy->name == 'smartphones_screen' ) {
					echo Filter_Widget_Content::get_screen();
				}

				if ( $instance[ $taxonomy->name ] == true and $taxonomy->name == 'smartphones_processor' ) {
					echo Filter_Widget_Content::get_processor();
				}

				if ( $instance[ $taxonomy->name ] == true and $taxonomy->name == 'smartphones_year' ) {
					echo Filter_Widget_Content::get_year();
				}
			}
		endforeach;
		echo '</div></div>';


	}

	/**
	 * Back-end widget form.
	 *
	 * @param   array  $instance  Previously saved values from database.
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>">
        </p>
		<?php

		$args       = array(
			'public'   => true,
			'_builtin' => false
		);
		$taxonomeis = get_taxonomies( $args, 'objects' );
		foreach ( $taxonomeis as $taxonomy ):?>
            <p>
                <input id="<?php echo $this->get_field_id( $taxonomy->name ); ?>"
                       name="<?php echo $this->get_field_name( $taxonomy->name ); ?>"
                       type="checkbox"<?php checked( ! empty( $instance[ $taxonomy->name ] ) ); ?> />&nbsp;<label
                        for="<?php echo $this->get_field_id( $taxonomy->name ); ?>"><?php echo $taxonomy->labels->name; ?></label>
            </p>
		<?php endforeach; ?>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['price'], 'on' ); ?>
                   id="<?php echo $this->get_field_id( 'price' ); ?>"
                   name="<?php echo $this->get_field_name( 'price' ); ?>"/>
            <label for="<?php echo $this->get_field_id( 'price' ); ?>">Show Price</label>
        </p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param   array  $new_instance  Values just sent to be saved.
	 * @param   array  $old_instance  Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 * @see WP_Widget::update()
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['price'] = $new_instance['price'];
		$args              = array(
			'public'   => true,
			'_builtin' => false
		);
		$taxonomeis        = get_taxonomies( $args, 'objects' );
		foreach ( $taxonomeis as $taxonomy ):

			$instance[ $taxonomy->name ] = ! empty( $new_instance[ $taxonomy->name ] );
			if ( isset( $new_instance[ $taxonomy->name ] ) ) {
				$instance[ $taxonomy->name ] = ! empty( $new_instance[ $taxonomy->name ] );
			}
			if ( ! empty( $instance[ $taxonomy->name ] ) ) {
				$instance[ $taxonomy->name ] = true;
			}

		endforeach;

		return $instance;
	}

	function register_filter_widget() {

		register_widget( 'Filter_Widget' );

	}


} // class Foo_Widget


new Filter_Widget();
