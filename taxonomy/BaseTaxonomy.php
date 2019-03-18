<?php

namespace Taxonomy;

class BaseTaxonomy {

	/**
	 * @var string
	 *
	 * Set taxonomy params
	 */
	protected $slug;
	protected $name;
	protected $singular_name;
	protected $taxonomy_name;

	/**
	 * Register Smartphones_Manufactures
	 */
	public function register() {
		$labels = array(
			'name'              => $this->name,
			'singular_name'     => $this->singular_name,
			'add_new_item'      => 'Add New ' . $this->singular_name,
			'edit_item'         => 'Edit ' . $this->singular_name,
			'update_item'       => 'Update ' . $this->singular_name,
			'new_item'          => 'New ' . $this->singular_name,
			'all_items'         => 'All ' . $this->name,
			'search_items'      => 'Search ' . $this->name,
			'parent_item'       => 'Parent ' . $this->name,
			'parent_item_colon' => 'Parent ' . $this->name,
			'menu_name'         => $this->name
		);

		register_taxonomy( $this->taxonomy_name, array( 'smartphones' ), array(
			'hierarchical' => true,
			'labels'       => $labels,
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => $this->slug )
		) );
	}


	/**
	 * Smartphones_Manufactures constructor.
	 *
	 * When class is instantiated
	 */
	public function __construct() {

		// Register the taxonomy
		add_action( 'init', array( $this, 'register' ) );
	}

}


