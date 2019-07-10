<?php


if (!file_exists(get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php')) {
    return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
} else {
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

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
//        add_theme_support('post-thumbnails');


        //Imagem Destacada

        // Add Thumb Column
        if (!function_exists('fb_AddThumbColumn') && function_exists('add_theme_support')) {
            // for post and page
            add_theme_support('post-thumbnails', array('post', 'page'));
            set_post_thumbnail_size(1568, 9999);

            function fb_AddThumbColumn($cols)
            {
                $cols['thumbnail'] = __('Thumbnail');
                return $cols;
            }

            function fb_AddThumbValue($column_name, $post_id)
            {
                $width = (int)35;
                $height = (int)35;
                if ('thumbnail' == $column_name) {
                    // thumbnail of WP 2.9
                    $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
                    // image from gallery
                    $attachments = get_children(array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image'));
                    if ($thumbnail_id)
                        $thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
                    elseif ($attachments) {
                        foreach ($attachments as $attachment_id => $attachment) {
                            $thumb = wp_get_attachment_image($attachment_id, array($width, $height), true);
                        }
                    }
                    if (isset($thumb) && $thumb) {
                        echo $thumb;
                    } else {
                        echo __('None');
                    }
                }
            }

            // for posts
            add_filter('manage_posts_columns', 'fb_AddThumbColumn');
            add_action('manage_posts_custom_column', 'fb_AddThumbValue', 10, 2);
            // for pages
            add_filter('manage_pages_columns', 'fb_AddThumbColumn');
            add_action('manage_pages_custom_column', 'fb_AddThumbValue', 10, 2);
        }


        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'menu' => 'Menu Principal',
                'menu_top_right' => 'Menu Topo Direita',
                'footer' => 'Rodapé',
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
    wp_enqueue_style('all', get_theme_file_uri('/css/all.css'), array(), '1.0');
    wp_enqueue_style('font-awesome', get_theme_file_uri('/assets/font-awesome/css/font-awesome.min.css'), array(), '1.0');
    wp_enqueue_style('iconmoon', get_theme_file_uri('/assets/iconmoon/css/iconmoon.css'), array(), '1.0');
    wp_enqueue_style('app', get_theme_file_uri('/css/app.css'), array('all'), '1.0');
    wp_enqueue_style('custom', get_theme_file_uri('/css/custom.css'), array('app'), '1.0');


//    wp_enqueue_script('jquery', get_theme_file_uri('/js/jquery.min.js'), array(), '1.1', true);
    wp_enqueue_script('all', get_theme_file_uri('/js/all.js'), array('jquery'), '1.1', true);
    wp_enqueue_script('app', get_theme_file_uri('/js/app.js'), array('jquery'), '1.1', true);
}

add_action('wp_enqueue_scripts', 'sua_formatura_scripts');

function the_logo_site($class_logo = '', $class_link = '')
{
    if (has_custom_logo()) {
        $logo = sprintf('<img src="%s" alt="%s" class="img-fluid %s" >',
            esc_url(wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full')), get_bloginfo('name'), $class_logo);
    } else {
        $logo = '<h2>' . get_bloginfo('name') . '</h2>';
    }
    echo sprintf(' <a class="%s" href="%s" title="%s">%s</a>', $class_link, get_home_url(), get_bloginfo('name'), $logo);
}

//remove wp version
function theme_remove_version()
{
    return '';
}

add_filter('the_generator', 'theme_remove_version');

//remove default footer text
function remove_footer_admin()
{
    echo "";
}

add_filter('admin_footer_text', 'remove_footer_admin');

//remove wordpress logo from adminbar
function wp_logo_admin_bar_remove()
{
    global $wp_admin_bar;
    /* Remove their stuff */
    $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);


// Remove default Dashboard widgets
function disable_default_dashboard_widgets()
{
    //remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_activity', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');

    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}

add_action('admin_menu', 'disable_default_dashboard_widgets');

remove_action('welcome_panel', 'wp_welcome_panel');

/**
 * Custom callback for outputting comments
 *
 * @return void
 * @author Keir Whitaker
 */
function bootstrap_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

    if ($comment->comment_approved == '1'):
        $media_left = sprintf('<div class="media-left">%s</div>', get_avatar($comment, 32));
        $time = sprintf('<time><a href="#comment-%s">%s às %s</a></time>', get_comment_ID(), get_comment_date(), get_comment_time());
        $media_body = sprintf('<div class="media-body"><h4 class="media-heading">%s</h4>%s', get_comment_author(), $time);
        echo sprintf('<li class="media">%s%s', $media_left, $media_body);
        comment_text();
        echo "</div></li>";
    endif;
}

