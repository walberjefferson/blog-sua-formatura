<?php


if (!function_exists('sua_formatura_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function sua_formatura_setup()
    {
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1568, 9999);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'menu-1' => __('Primary', 'twentynineteen'),
                'footer' => __('Footer Menu', 'twentynineteen'),
                'social' => __('Social Links Menu', 'twentynineteen'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        add_theme_support(
            'custom-logo',
            array(
                'height' => 29,
                'width' => 210,
                'flex-width' => false,
                'flex-height' => false,
            )
        );
    }
endif;
add_action('after_setup_theme', 'sua_formatura_setup');


function twentynineteen_widgets_init()
{

    register_sidebar(
        array(
            'name' => __('Footer', 'twentynineteen'),
            'id' => 'sidebar-1',
            'description' => __('Add widgets here to appear in your footer.', 'twentynineteen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );

}

//add_action('widgets_init', 'twentynineteen_widgets_init');


/**
 * Enqueue scripts and styles.
 */
function sua_formatura_scripts()
{
//    wp_enqueue_style('sf-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('all', get_theme_file_uri('/css/all.css'), array(), '1.0');
//    wp_enqueue_style('bootstrap', get_theme_file_uri('/assets/bootstrap/css/bootstrap.min.css'), array(), '1.0');
//    wp_enqueue_style('select2', get_theme_file_uri('/assets/select2/css/select2.min.css'), array(), '1.0');
    wp_enqueue_style('font-awesome', get_theme_file_uri('/assets/font-awesome/css/font-awesome.min.css'), array(), '1.0');
    wp_enqueue_style('iconmoon', get_theme_file_uri('/assets/iconmoon/css/iconmoon.css'), array(), '1.0');
//    wp_enqueue_style('owl_carousel', get_theme_file_uri('/assets/owl-carousel/css/owl.carousel.min.css'), array(), '1.0');
//    wp_enqueue_style('magnific-popup', get_theme_file_uri('/assets/magnific-popup/css/magnific-popup.css'), array(), '1.0');
//    wp_enqueue_style('animate', get_theme_file_uri('/css/animate.css'), array(), '1.0');
    wp_enqueue_style('app', get_theme_file_uri('/css/app.css'), array('all'), '1.0');
    wp_enqueue_style('custom', get_theme_file_uri('/css/custom.css'), array('app'), '1.0');


    wp_enqueue_script('jquery', get_theme_file_uri('/js/jquery.min.js'), array(), '1.1', true);
    wp_enqueue_script('all', get_theme_file_uri('/js/all.js'), array('jquery'), '1.1', true);
//    wp_enqueue_script('bootstrap', get_theme_file_uri('/assets/bootstrap/js/bootstrap.min.js'), array('jquery', 'popper'), '1.1', true);
//    wp_enqueue_script('select2', get_theme_file_uri('/assets/select2/js/select2.min.js'), array('jquery'), '1.1', true);
    wp_enqueue_script('bxslider', get_theme_file_uri('/assets/bxslider/js/bxslider.min.js'), array('jquery'), '1.1', true);
    wp_enqueue_script('owl-carousel', get_theme_file_uri('/assets/owl-carousel/js/owl.carousel.min.js'), array('jquery'), '1.1', true);
//    wp_enqueue_script('masonry', get_theme_file_uri('/assets/masonry/js/masonry.min.js'), array('jquery'), '1.1', true);
    wp_enqueue_script('magnific-popup', get_theme_file_uri('/assets/magnific-popup/js/magnific-popup.min.js'), array('jquery'), '1.1', true);
    wp_enqueue_script('app', get_theme_file_uri('/js/app.js'), array('jquery'), '1.1', true);
}

add_action('wp_enqueue_scripts', 'sua_formatura_scripts');