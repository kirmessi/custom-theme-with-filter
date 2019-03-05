<?php

/**
 * front display Widget
 */
class Filter_Widget_Content {

	public function __construct() {
		add_action('wp_ajax_get_smartphones', array($this, 'get_smartphones')); // наши хуки
		add_action('wp_ajax_nopriv_get_smartphones', array($this, 'get_smartphones'));
		add_action('wp_ajax_get_smartphones', array($this, 'my_action_callback'));
		add_action('wp_ajax_nopriv_get_smartphones', array($this, 'my_action_callback'));
	}

	public function my_action_callback() {
		echo 'Hello!';
		wp_die();
	}

	public function get_smartphones() {
		global $post;
		$paged = $_POST['paged'] ? $_POST['paged'] : 1;
		$manufacture_id = $_POST['manufacture_id'] ? $_POST['manufacture_id'] : '';

		$year_id = $_POST['year_id'];
		$screen_id = $_POST['screen_id'];
		$ram_id = $_POST['ram_id'];
		$processor_id = $_POST['processor_id'];
		$args = array(
			'post_type' => 'smartphones',
			'paged' => $paged,
		);
		$relation = 'OR';
		if (!empty($manufacture_id) && !empty($year_id) && !empty($screen_id) && !empty($ram_id) && !empty($processor_id)) {
			$args['relation'] = 'AND';
		}
		if (!empty($year_id)) {
			$args['tax_query'][] = array(
				'taxonomy' => 'smartphones_year',
				'terms' => array_values($year_id),
			);
		}
		if (!empty($screen_id)) {
			$args['tax_query'][] = array(
				'taxonomy' => 'smartphones_screen',
				'terms' => array_values($screen_id),
			);
		}
		if (!empty($ram_id)) {
			$args['tax_query'][] = array(
				'taxonomy' => 'smartphones_ram',
				'terms' => array_values($ram_id),
			);
		}
		if (!empty($processor_id)) {
			$args['tax_query'][] = array(
				'taxonomy' => 'smartphones_processor',
				'terms' => array_values($processor_id),
			);
		}
		if (!empty($manufacture_id)) {
			$args['tax_query'][] = array(
				'taxonomy' => 'smartphones_manufactures',
				'terms' => $manufacture_id,
			);
		}

		if (!empty($_POST['cena_min']) and !empty($_POST['cena_max']) and $_POST['cena_max'] >= $_POST['cena_min']) {
			$args['meta_query'] = array('relation' => 'AND');
		} else {
			$args['meta_query'] = array('relation' => 'OR');
		}

		if (!empty($_POST['cena_min'])) {
			$args['meta_query'][] = array(
				'key' => 'price',
				'value' => $_POST['cena_min'],
				'compare' => '>=',
				'type' => 'NUMERIC',
			);
		}
		if (!empty($_POST['cena_max'])) {
			$args['meta_query'][] = array(
				'key' => 'price',
				'value' => $_POST['cena_max'],
				'compare' => '<=',
				'type' => 'NUMERIC',
			);
		}
		$data = [];
		$smartphones = new WP_Query($args);
		$max_pages = $smartphones->max_num_pages; // получаем общее число страниц с выбранными постами
		if ($smartphones->have_posts()):
			while ($smartphones->have_posts()): $smartphones->the_post();
				$thumbnail = get_the_post_thumbnail_url($post->ID, 'project-thumb');
				$title = get_the_title();
				$decsription = get_the_excerpt();
				$permalink = get_the_permalink();
				$price = get_post_meta($post->ID, 'price', true).' $';
     			$data[] = [
					'thumbnail' => $thumbnail,
					'title' => $title,
					'decsription' => $decsription,
					'permalink' => $permalink,
					'price' => $price,
				];
			endwhile;
		else:
			$data[] = [
				'error' => 'Sorry, phones with such parameters are not found.',
			];	
		endif;

		echo json_encode($data);
		wp_reset_postdata();
		wp_die(); 
	}

	public static function get_price() {
		$html = '';
		$html .= '<div class="price-block">';
		$html .= '<p class="input-line"><input type="text" name="cena_min" id="min" placeholder="Min price" /></p>';
		$html .= '<p class="input-line"><input type="text" name="cena_max" value="" id="max" placeholder="Max price" /></p';
		$html .= '</div>';

		return $html;
	}

	public static function get_select_manufacture() {
		$html = '';
		$html .= '<div class="select-block">';
		$html .= '<select name="manufacture" class="manufacture" id="manufacture-select"><option selected>Manufacture</option>';
		$manufactures = get_terms('smartphones_manufactures');
		foreach ($manufactures as $manufacture):
			$html .= '<option value="' . $manufacture->slug . '" data-manufacture-id="' . $manufacture->term_id . '">' . $manufacture->name . '</option>';
		endforeach;
		$html .= '</select></div>';

		return $html;
	}

	public static function get_year() {
		$html = '';
		$html .= '<div class="filter-year">';
		$html .= '<p class="head">Year of issue</p>';
		$tax = 'smartphones_year';
		$args = array(
			'taxonomy' => $tax,
			'hide_empty' => false,
		);

		$terms = get_terms($args);

		foreach ($terms as $term):
			$html .= '<p class="wrap"><input type="checkbox" id="' . $term->name . '" name="selector[]" value="' . $term->name . '" data-year-id="' . $term->term_id . '"><label for="' . $term->name . '">' . $term->name . '</label></p>';
		endforeach;

		$html .= '</div>';
		return $html;
	}

	public static function get_screen() {
		$html = '';
		$html .= '<div class="filter-screen">';
		$html .= '<p class="head">Screen size</p>';
		$tax = 'smartphones_screen';
		$args = array(
			'taxonomy' => $tax,
			'hide_empty' => false,
		);

		$terms = get_terms($args);

		foreach ($terms as $term):
			$html .= '<p class="wrap"><input type="checkbox" id="' . $term->name . '" name="selector[]" value="' . $term->name . '" data-screen-id="' . $term->term_id . '"><label for="' . $term->name . '">' . $term->name . '</label></p>';
		endforeach;

		$html .= '</div>';

		return $html;
	}

	public static function get_ram() {
		$html = '';
		$html .= '<div class="filter-ram">';
		$html .= '<p class="head">RAM, GB</p>';
		$tax = 'smartphones_ram';
		$args = array(
			'taxonomy' => $tax,
			'hide_empty' => false,
		);

		$terms = get_terms($args);

		foreach ($terms as $term):
			$html .= '<p class="wrap"><input type="checkbox" id="' . $term->name . '" name="selector[]" value="' . $term->name . '" data-ram-id="' . $term->term_id . '"><label for="' . $term->name . '">' . $term->name . '</label></p>';
		endforeach;

		$html .= '</div>';

		return $html;
	}

	public static function get_processor() {
		$html = '';
		$html .= '<div class="filter-processor">';
		$html .= '<p class="head">CPU</p>';
		$tax = 'smartphones_processor';
		$args = array(
			'taxonomy' => $tax,
			'hide_empty' => false,
		);

		$terms = get_terms($args);

		foreach ($terms as $term):
			$html .= '<p class="wrap"><input type="checkbox" id="' . $term->name . '" name="selector[]" value="' . $term->name . '" data-processor-id="' . $term->term_id . '"><label for="' . $term->name . '">' . $term->name . '</label></p>';
		endforeach;

		$html .= '</div>';

		return $html;
	}

}

new Filter_Widget_Content();
