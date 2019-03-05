<?php 
 
/**
 * Class Smartphones
 * @package PostType
 *
 * Use actual name of post type for
 * easy readability.
 *
 * Potential conflicts removed by namespace
 */
class Smartphones 
{
 
    /**
     * @var string
     *
     * Set post type params
     */
    private $type               = 'smartphones';
    private $slug               = 'smartphones';
    private $name               = 'Smartphones';
    private $singular_name      = 'Smartphone';
    /**
     * Register post type
     */
    public function register() 
    {
        $labels = array(
            'name'                  => $this->name,
            'singular_name'         => $this->singular_name,
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New '   . $this->singular_name,
            'edit_item'             => 'Edit '      . $this->singular_name,
            'new_item'              => 'New '       . $this->singular_name,
            'all_items'             => 'All '       . $this->name,
            'view_item'             => 'View '      . $this->name,
            'search_items'          => 'Search '    . $this->name,
            'not_found'             => 'No '        . strtolower($this->name) . ' found',
            'not_found_in_trash'    => 'No '        . strtolower($this->name) . ' found in Trash',
            'parent_item_colon'     => '',
            'menu_name'             => $this->name
        );
 
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => $this->slug ),
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_position'         => 5,
            'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail'),
            'yarpp_support'         => true,
            'taxonomies' => array('smartphones_manufactures', 'smartphones_year', 'smartphones_processor', 'smartphones_ram', 'smartphones_screen'),
            'register_meta_box_cb' => array($this, 'wpse_add_custom_meta_box')
        );
 
        register_post_type( $this->type, $args );
    }
    /**
     * Smartphones constructor.
     *
     * When class is instantiated
     */
    public function __construct() 
    {
 
        // Register the post type
        add_action('init', array($this, 'register'));

        add_action('add_meta_boxes', array($this, 'wpse_add_custom_meta_box'));

        add_action( 'save_post', array($this, 'wpse_save_meta_fields'));

        add_action( 'new_to_publish', array($this, 'wpse_save_meta_fields'));

        // Admin set post columns
        add_filter( 'manage_edit-'.$this->type.'_columns', array($this, 'set_columns'), 10, 1) ;
 
        // Admin edit post columns
        add_action( 'manage_'.$this->type.'_posts_custom_column', array($this, 'edit_columns'), 10, 2 );
 
    }
    public function wpse_add_custom_meta_box() 
    {
        add_meta_box(
       'custom_meta_box',       // $id
       'Set Price',                  // $title
       array($this, 'show_custom_meta_box'),
       $this->type,              // $page
       'normal',                  // $context
       'high'                     // $priority
        );
    }
    //showing custom form fields
   public function show_custom_meta_box() 
   {
        global $post;
    // Nonce field to validate form request came from current site
        wp_nonce_field( basename( __FILE__ ), 'price_field' );
    // Get the price data if it's already been entered
        $price = get_post_meta( $post->ID, 'price', true );
    // Output the field
        echo '<input type="text" name="price" value="' . esc_textarea( $price )  . '" class="widefat">';
    }


    function wpse_save_meta_fields( $post_id )
    {

    // Return if the user doesn't have edit permissions.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
        }
    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
        if ( ! isset( $_POST['price'] ) || ! wp_verify_nonce( $_POST['price_field'], basename(__FILE__) ) ) {
        return $post_id;
        }
    // Now that we're authenticated, time to save the data.
    // This sanitizes the data from the field and saves it into an array $events_meta.
        $events_meta['price'] = esc_textarea( $_POST['price'] );
    // Cycle through the $events_meta array.
    // Note, in this example we just have one item, but this is helpful if you have multiple.
        foreach ( $events_meta as $key => $value ) :
        // Don't store custom data twice
            if ( 'revision' === $post->post_type ) {
            return;
            }
            if ( get_post_meta( $post_id, $key, false ) ) {
            // If the custom field already has a value, update it.
            update_post_meta( $post_id, $key, $value );
            } else {
            // If the custom field doesn't have a value, add it.
            add_post_meta( $post_id, $key, $value);
            }
            if ( ! $value ) {
            // Delete the meta key if there's no value
            delete_post_meta( $post_id, $key );
            }
        endforeach;
    }
    
}
 
/**
 * Instantiate class, creating post type
 */
new Smartphones();

