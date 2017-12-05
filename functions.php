<?php
/**
 * Created by PhpStorm.
 * User: Biven Toma
 * Date: 8/31/2016
 * Time: 4:01 PM
 */


/*----------------auto-year----------------*/
function bt_date(){
    return date('Y');
}
add_shortcode('year','bt_date');



/*-----------------add class to enfold---------------*/

add_theme_support('avia_template_builder_custom_css');

/*---------------------------------------------------------*/

function bt_page_class(){
    global $wp_query;
    $page ='';
    
    if(is_front_page()){
        $page = 'home';
    }elseif (is_page()){
        $page = "page_name". $wp_query->query_vars["pagename"];
    }
    return $page;
}

// add parent class to child page
function bt_body_class( $classes ) {
    global $post;
    if ( is_page() ) {
        // Has parent / is sub-page
        if ( $post->post_parent ) {
            # Parent post name/slug
            $parent = get_post( $post->post_parent );
            $classes[] = 'parent-slug-'.$parent->post_name;
            // Parent template name
            $parent_template = get_post_meta( $parent->ID, '_wp_page_template', true);
            if ( !empty($parent_template) )
                $classes[] = 'parent-template-'.sanitize_html_class( str_replace( '.', '-', $parent_template ) );
        }
    }
    return $classes;
}
add_filter( 'body_class', 'bt_body_class' );
/*------------------------------------------------------*/
include_once(dirname(__FILE__) . "/avia_breadcrumb_shortcode.php");
function our_breadcrumbs_shortcode($args)
{
    $breadcrumbs = new avia_breadcrumb_shortcode();
    return $breadcrumbs->avia_breadcrumb();
}

add_shortcode('bread_crumb', 'our_breadcrumbs_shortcode');

/*-------------------------------------------------------*/

function custom_scripts(){
    
    wp_enqueue_script('animations',get_stylesheet_directory_uri().'/js/animations.js',['jquery']);
    wp_enqueue_script('aos-js',get_stylesheet_directory_uri().'/aos-master/dist/aos.js',['jquery']);
    wp_enqueue_style('aos-style',get_stylesheet_directory_uri().'/aos-master/dist/aos.css');
}
add_action('wp_enqueue_scripts','custom_scripts');