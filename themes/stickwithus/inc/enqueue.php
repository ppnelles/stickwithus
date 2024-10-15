<?php /**
 * Enqueue scripts and styles.
 */
function _turbo_scripts() {
	wp_enqueue_style( '_turbo-style', get_stylesheet_uri(), array(), '20241015-4', 'all' );

	//wp_enqueue_script( '_turbo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( '_turbo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'wpml-legacy-dropdown.js', get_template_directory_uri() . '/js/wpml/legacy-dropdown.js', '20200109', true );

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

	wp_enqueue_script( '_turbo-scripts', get_template_directory_uri() . '/js/scripts-min.js', array(), '20241015-4', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


    wp_localize_script( '_turbo-scripts', 'my_ajax_obj', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ), // AJAX URL
        'nonce'    => wp_create_nonce( '8WEJaAMTuBqH' ), // Create a nonce with a unique action name
    ));


}

add_action( 'wp_enqueue_scripts', '_turbo_scripts' );