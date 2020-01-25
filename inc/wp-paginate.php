<?php
/*
Plugin Name: WP-Paginate
Plugin URI: https://wordpress.org/plugins/wp-paginate/
Description: A simple and flexible pagination plugin for WordPress posts and comments.
Version: 2.0.5
Author: Max Foundry
Author URI: http://maxfoundry.com
Text Domain: 'wp-paginate'
*/

// plugin links
if (!defined('WPP_MAXBUTTONS_LINK'))
    define('WPP_MAXBUTTONS_LINK', 'https://maxbuttons.com/?utm_source=wpp-descv2&utm_medium=wpp-plugin&utm_content=wpp-footer&utm_campaign=wpp-descv2');
if (!defined('WPP_MAXGALLERIA_LINK'))
    define('WPP_MAXGALLERIA_LINK', 'https://maxgalleria.com/?utm_source=wpp-descv2&utm_medium=wpp-plugin&utm_content=wpp-footer&utm_campaign=wpp-descv2');
if (!defined('WPP_MEDIA_LIBRARY_PLUS_PRO_LINK'))
    define('WPP_MEDIA_LIBRARY_PLUS_PRO_LINK', 'https://maxgalleria.com/downloads/media-library-plus-pro/?utm_source=wpp-descv2&utm_medium=wpp-plugin&utm_content=wpp-footer&utm_campaign=wpp-descv2');
if (!defined('WPP_WP_PAGINATE_PRO_LINK'))
    define("WPP_WP_PAGINATE_PRO_LINK", "https://maxgalleria.com/downloads/wp-paginate-pro/");

define("WPP_REVIEW_NOTICE", "wpp_review_notice");
if (!defined("WP_PAGINATE_NONCE"))
    define("WP_PAGINATE_NONCE", "wpp_js_nonce");

/**
 * Set the wp-content and plugin urls/paths
 */
if (!defined('WP_CONTENT_URL'))
    define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if (!defined('WP_CONTENT_DIR'))
    define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if (!defined('WP_PLUGIN_URL'))
    define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins');
if (!defined('WP_PLUGIN_DIR'))
    define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');

if (!class_exists('WPPaginate')) {
    class WPPaginate
    {
        /**
         * @var string The plugin version
         */
        public $version = '2.0.5';

        /**
         * @var string The options string name for this plugin
         */
        public $optionsName = 'wp_paginate_options';

        /**
         * @var string $localizationDomain Domain used for localization
         */
        public $localizationDomain = 'wp-paginate';

        /**
         * @var string $pluginurl The url to this plugin
         */
        public $pluginurl = '';
        /**
         * @var string $pluginpath The path to this plugin
         */
        public $pluginpath = '';

        /**
         * @var array $options Stores the options for this plugin
         */
        public $options = array();

        public $type = 'posts';

        public $positions = array();

        public $fonts = array();

        public $presets = array();

        /**
         * Constructor
         */
        function __construct()
        {
            $name = dirname(plugin_basename(__FILE__));
            $this->set_activation_hooks();

            //Language Setup
            load_plugin_textdomain('wp-paginate', false, "$name/I18n/");

            //"Constants" setup
            $this->pluginurl = plugins_url($name) . "/";
            $this->pluginpath = WP_PLUGIN_DIR . "/$name/";

            //Initialize the options
            $this->get_options();

            //Actions
            add_action('init', array(&$this, 'init_pagination'));
            add_action('admin_menu', array(&$this, 'admin_menu_link'));
            add_action('admin_enqueue_scripts', array($this, 'wpp_admin_head'));
            add_action('wp_enqueue_scripts', array($this, 'wpp_enqueue_custom_css'), 20);


            //add_action('admin_notices', array($this, 'show_wpp_admin_notice'));

            //add_action('wp_ajax_nopriv_wpp_dismiss_notice', array($this, 'wpp_dismiss_notice'));
            //add_action('wp_ajax_wpp_dismiss_notice', array($this, 'wpp_dismiss_notice'));

            add_action('wp_ajax_nopriv_wpp_set_review_later', array($this, 'wpp_set_review_later'));
            add_action('wp_ajax_wpp_set_review_later', array($this, 'wpp_set_review_later'));

            $this->positions = array(
                'none' => __('Function only', 'wp-paginate'),
                'below' => __('Below the Content', 'wp-paginate'),
                'above' => __('Above the Content', 'wp-paginate'),
                'both' => __('Above and Below the Content', 'wp-paginate')
            );

            $this->fonts = array(
                'font-inherit' => __('inherit', 'wp-paginate'),
                'font-initial' => __('initial', 'wp-paginate'),
                'font-arial' => __('Arial', 'wp-paginate'),
                'font-georgia' => __('Georgia', 'wp-paginate'),
                'font-tahoma' => __('Tahoma', 'wp-paginate'),
                'font-times' => __('Times New Roman', 'wp-paginate'),
                'font-trebuchet' => __('Trebuchet MS', 'wp-paginate'),
                'font-verdana' => __('Verdana', 'wp-paginate')
            );

            $this->presets = array(
                array('default', __('Grey Buttons', 'wp-paginate'), 'default.jpg'),
                array('wpp-blue-cta', __('Blue Buttons', 'wp-paginate'), 'blue-cta-buttons.jpg'),
                array('wpp-modern-grey', __('Modern Grey Buttons', 'wp-paginate'), 'modern-grey-buttons.jpg'),
                array('wpp-neon-pink', __('Neon Pink Buttons', 'wp-paginate'), 'neon-pink-buttons.png'),
            );

            if ($this->options['css'])
                add_action('wp_print_styles', array(&$this, 'wp_paginate_css'));
        }

        public function set_activation_hooks()
        {
            register_activation_hook(__FILE__, array($this, 'do_activation'));
            register_deactivation_hook(__FILE__, array($this, 'do_deactivation'));
        }

        public function do_activation()
        {
            $this->activate();
        }

        public function do_deactivation()
        {
            $this->deactivate();
        }

        public function activate()
        {
            $current_user_id = get_current_user_id();

            if (get_user_meta($current_user_id, WPP_REVIEW_NOTICE, true) !== "off") {
                $review_date = date('Y-m-d', strtotime("+2 days"));
                update_user_meta($current_user_id, WPP_REVIEW_NOTICE, $review_date);
            }
        }

        public function deactivate()
        {
        }

        public function init_pagination()
        {

            if (isset($this->options['everywhere']) && isset($this->options['position'])) {

                if ($this->options['position'] === 'above' || $this->options['position'] === 'both')
                    add_filter('loop_start', array($this, 'add_pagination_to_page_top'));

                if ($this->options['position'] === 'below' || $this->options['position'] === 'both')
                    add_filter('loop_end', array($this, 'add_pagination_to_page_bottom'));

                if ($this->options['everywhere'] && ($this->options['position'] === 'below' || $this->options['position'] === 'both'))
                    add_filter('wp_link_pages', array($this, 'add_pagination_to_page_bottom'), 10, 2);

                if ($this->options['everywhere'] && ($this->options['position'] === 'above' || $this->options['position'] === 'both'))
                    add_filter('wp_link_pages', array($this, 'add_pagination_to_page_top'), 10, 2);

            }

        }

        function add_pagination_to_page_bottom($content)
        {

            $this->get_options();
            if (defined('WPP-DEBUG')) {
                $output = print_r($this->options, true);
                error_log($output);
            }
            if (($this->options['home-page'] && is_front_page()) ||
                ($this->options['blog-page'] && is_home()) ||
                ($this->options['search-page'] && is_search()) ||
                ($this->options['category-page'] && is_category()) ||
                ($this->options['archive-page'] && is_archive()) ||
                ($this->options['everywhere'])
            ) {

                if (is_feed())
                    return $content;
                global $wp_query, $wp_paginate_display_bottom;
                if (is_main_query() && $content === $wp_query && !$wp_paginate_display_bottom) {
                    $wp_paginate_display_bottom = true;
                    wp_paginate();
                }
            }
        }

        function add_pagination_to_page_top($content)
        {

            $this->get_options();
            if (defined('WPP-DEBUG')) {
                $output = print_r($this->options, true);
                error_log($output);
            }
            if (($this->options['home-page'] && is_front_page()) ||
                ($this->options['blog-page'] && is_home()) ||
                ($this->options['search-page'] && is_search()) ||
                ($this->options['category-page'] && is_category()) ||
                ($this->options['archive-page'] && is_archive()) ||
                ($this->options['everywhere'])
            ) {

                if (is_feed())
                    return $content;
                global $wp_query, $wp_paginate_display_top;
                if (is_main_query() && $content === $wp_query && !$wp_paginate_display_top) {
                    $wp_paginate_display_top = true;
                    wp_paginate();
                }
            }
        }

        function wpp_admin_head($hook)
        {
            if (isset($_REQUEST['page']) && 'wp-paginate.php' == $_REQUEST['page']) {
                //wp_enqueue_style( 'bootstrap', plugins_url( '/css/bootstrap/bootstrap.min.css', __FILE__ ));
                if (isset($_GET['action']) && 'custom_css' == $_GET['action'])
                    $this->wpp_include_codemirror();
            }
            wp_enqueue_style('wp-paginate-admin', plugins_url('/css/wp-paginate-admin.css', __FILE__));

            wp_enqueue_script('jquery');
            wp_register_script('wpp-script', $this->pluginurl . 'js/wp-paginate.js', array('jquery'), '', true);

            wp_localize_script('wpp-script', 'wpp_ajax',
                array('ajaxurl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce(WP_PAGINATE_NONCE))
            );

            wp_enqueue_script('wpp-script');

        }

        function wpp_enqueue_custom_css()
        {
            $wpp_custom_css_active = get_option('wpp_custom_css_active', 'off');
            if ($wpp_custom_css_active === 'on') {
                $upload_dir = wp_upload_dir();
                $wpp_css_file = $upload_dir['baseurl'] . '/wpp-custom-code/wpp-custom-code.css';
                wp_enqueue_style('wpp-custom-style', $wpp_css_file, array('wp-paginate'));
            }
        }

        /**
         * Pagination based on options/args
         */
        function paginate($args = false)
        {
            if ($this->type === 'comments' && !get_option('page_comments'))
                return;

            $r = wp_parse_args($args, $this->options);
            extract($r, EXTR_SKIP);

            if (isset($this->options['preset']))
                $preset = $this->options['preset'];
            else
                $preset = 'default';

            if (isset($this->options['font']))
                $font = $this->options['font'];
            else
                $font = 'font-inherit';

            if (isset($this->options['before']))
                $before_option = $this->options['before'];
            else
                $before_option = '<div class="navigation">';

            if (isset($this->options['after']))
                $after_option = $this->options['after'];
            else
                $after_option = '</div>';

            if (isset($this->options['slash']))
                $slash_option = $this->options['slash'];
            else
                $slash_option = false;

            $before = stripslashes(html_entity_decode($before_option));
            $after = stripslashes(html_entity_decode($after_option));

            if (!isset($page) && !isset($pages)) {
                global $wp_query;

                if ($this->type === 'posts') {
                    $page = get_query_var('paged');
                    $posts_per_page = intval(get_query_var('posts_per_page'));
                    $pages = intval(ceil($wp_query->found_posts / $posts_per_page));
                } else {
                    $page = get_query_var('cpage');
                    $comments_per_page = get_option('comments_per_page');
                    $pages = get_comment_pages_count();
                }
                $page = !empty($page) ? intval($page) : 1;
            }

            $prevlink = ($this->type === 'posts')
                ? rtrim(esc_url(get_pagenum_link($page - 1)), '/')
                : get_comments_pagenum_link($page - 1);
            $nextlink = ($this->type === 'posts')
                ? rtrim(esc_url(get_pagenum_link($page + 1)), '/')
                : get_comments_pagenum_link($page + 1);

            if ($slash_option == true) {
                $prevlink . '/';
                $nextlink . '/';
            }

            $output = stripslashes(wp_kses_decode_entities($before));
            if ($pages > 1) {

                if ($preset === 'default')
                    $output .= sprintf('<ul>');
                else
                    $output .= sprintf('<ul>');

                $ellipsis = "<li><a href='#' class='dots'><span class='icon-paging-dots'></span></a></li>";

                if ($page > 1 && !empty($previouspage)) {
                    if ($slash_option)
                        $output .= sprintf('<li><a href="%s/" class="prev">%s</a></li>', $prevlink, '<span class="icon-left-arrow"></span>');
                    else
                        $output .= sprintf('<li><a href="%s" class="prev">%s</a></li>', $prevlink, '<span class="icon-left-arrow"></span>');
                }

                $min_links = $range * 2 + 1;
                $block_min = min($page - $range, $pages - $min_links);
                $block_high = max($page + $range, $min_links);
                $left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
                $right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

                if ($left_gap && !$right_gap) {
                    $output .= sprintf('%s%s%s',
                        $this->paginate_loop(1, $anchor, 0, $slash_option),
                        $ellipsis,
                        $this->paginate_loop($block_min, $pages, $page, $slash_option)
                    );
                } else if ($left_gap && $right_gap) {
                    $output .= sprintf('%s%s%s%s%s',
                        $this->paginate_loop(1, $anchor, 0, $slash_option),
                        $ellipsis,
                        $this->paginate_loop($block_min, $block_high, $page, $slash_option),
                        $ellipsis,
                        $this->paginate_loop(($pages - $anchor + 1), $pages, 0, $slash_option)
                    );
                } else if ($right_gap && !$left_gap) {
                    $output .= sprintf('%s%s%s',
                        $this->paginate_loop(1, $block_high, $page, $slash_option),
                        $ellipsis,
                        $this->paginate_loop(($pages - $anchor + 1), $pages, 0, $slash_option)
                    );
                } else {
                    $output .= $this->paginate_loop(1, $pages, $page, $slash_option);
                }

                if ($page < $pages && !empty($nextpage)) {
                    if ($slash_option)
                        $output .= sprintf('<li><a href="%s/" class="next">%s</a></li>', $nextlink, '<span class="icon-right-arrow"></span>');
                    else
                        $output .= sprintf('<li><a href="%s" class="next">%s</a></li>', $nextlink, '<span class="icon-right-arrow"></span>');
                }
                $output .= "</ol>";
            }
            $output .= stripslashes(wp_kses_decode_entities($after));

            if ($pages > 1 || $empty) {
                echo $output;
            }
        }

        /**
         * Helper function for pagination which builds the page links.
         */
        function paginate_loop($start, $max, $page = 0, $slash = false)
        {
            $output = "";
            for ($i = $start; $i <= $max; $i++) {
                if ($slash)
                    $p = ($this->type === 'posts') ? esc_url(get_pagenum_link($i)) : get_comments_pagenum_link($i);
                else
                    $p = ($this->type === 'posts') ? rtrim(esc_url(get_pagenum_link($i)), '/') : get_comments_pagenum_link($i);
                $output .= ($page == intval($i))
                    ? "<li class='active'><a href='#'>$i</a></li>"
                    : "<li><a href='$p'>$i</a></li>";
            }
            return $output;
        }

        function wp_paginate_css()
        {
            $name = "css/wp-paginate.css";

            if (false !== @file_exists(STYLESHEETPATH . "/$name")) {
                $css = get_stylesheet_directory_uri() . "/$name";
            } else {
                $css = $this->pluginurl . $name;
            }
            // wp_enqueue_style('wp-paginate', $css, false, $this->version, 'screen');

            if (function_exists('is_rtl') && is_rtl()) {
                $name = "css/wp-paginate-rtl.css";
                if (false !== @file_exists(STYLESHEETPATH . "/$name")) {
                    $css = get_stylesheet_directory_uri() . "/$name";
                } else {
                    $css = $this->pluginurl . $name;
                }
                // wp_enqueue_style('wp-paginate-rtl', $css, false, $this->version, 'screen');
            }

            //  wp_enqueue_style( 'wpp-advanced-styles', $this->wpp_print_style() );

        }

        /**
         * Retrieves the plugin options from the database.
         * @return array
         */
        function get_options()
        {
            if (!$options = get_option($this->optionsName)) {
                $options = array(
                    'title' => 'Pages:',
                    'nextpage' => '&raquo;',
                    'previouspage' => '&laquo;',
                    'css' => true,
                    'slash' => false,
                    'before' => '<div class="paging-block">',
                    'after' => '</div>',
                    'empty' => true,
                    'range' => 3,
                    'anchor' => 1,
                    'gap' => 3,
                    'everywhere' => false,
                    'home-page' => false,
                    'blog-page' => false,
                    'search-page' => false,
                    'category-page' => false,
                    'archive-page' => false,
                    'position' => 'none',
                    'hide-standard-pagination' => false,
                    'font' => 'font-inherit',
                    'preset' => 'default'
                );
                update_option($this->optionsName, $options);
            }
            $this->options = $options;
        }

        /**
         * Saves the admin options to the database.
         */
        function save_admin_options()
        {

            if (defined('WPP-DEBUG')) {
                $output = print_r($this->options, true);
                error_log($output);
            }

            return update_option($this->optionsName, $this->options);
        }

        /**
         * @desc Adds the options subpanel
         */
        function admin_menu_link()
        {
            add_options_page('WP-Paginate', 'WP-Paginate', 'manage_options', basename(__FILE__), array(&$this, 'admin_options_page'));
            add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'filter_plugin_actions'), 10, 2);
        }

        /**
         * @desc Adds the Settings link to the plugin activate/deactivate page
         */
        function filter_plugin_actions($links, $file)
        {
            $settings_link = '<a href="options-general.php?page=' . basename(__FILE__) . '">' . __('Settings', 'wp-paginate') . '</a>';
            array_unshift($links, $settings_link); // before other links

            return $links;
        }

        /**
         * Adds settings/options page
         */
        function admin_options_page()
        {
            if (isset($_POST['wp_paginate_save'])) {
                if (wp_verify_nonce($_POST['_wpnonce'], 'wp-paginate-update-options')) {

                    if (defined('WPP-DEBUG')) {
                        error_log("wp_paginate_save");
                    }

                    $this->options['title'] = trim(stripslashes(strip_tags($_POST['title'])));
                    $this->options['previouspage'] = trim(stripslashes(strip_tags($_POST['previouspage'])));
                    $this->options['nextpage'] = trim(stripslashes(strip_tags($_POST['nextpage'])));
                    $this->options['after'] = esc_attr($_POST['after']);
                    $this->options['empty'] = (isset($_POST['empty']) && $_POST['empty'] === 'on') ? true : false;
                    $this->options['css'] = (isset($_POST['css']) && $_POST['css'] === 'on') ? true : false;
                    $this->options['slash'] = (isset($_POST['slash']) && $_POST['slash'] === 'on') ? true : false;
                    $this->options['range'] = intval($_POST['range']);
                    $this->options['anchor'] = intval($_POST['anchor']);
                    $this->options['gap'] = intval($_POST['gap']);
                    $this->options['everywhere'] = (isset($_POST['everywhere']) && $_POST['everywhere'] === 'on') ? true : false;
                    $this->options['home-page'] = (isset($_POST['home-page']) && $_POST['home-page'] === 'on') ? true : false;
                    $this->options['blog-page'] = (isset($_POST['blog-page']) && $_POST['blog-page'] === 'on') ? true : false;
                    $this->options['search-page'] = (isset($_POST['search-page']) && $_POST['search-page'] === 'on') ? true : false;
                    $this->options['category-page'] = (isset($_POST['category-page']) && $_POST['category-page'] === 'on') ? true : false;
                    $this->options['archive-page'] = (isset($_POST['archive-page']) && $_POST['archive-page'] === 'on') ? true : false;
                    if (isset($_POST['position']))
                        $this->options['position'] = $_POST['position'];
                    $this->options['hide-standard-pagination'] = (isset($_POST['hide-standard-pagination']) && $_POST['hide-standard-pagination'] === 'on') ? true : false;
                    if (isset($_POST['font']))
                        $this->options['font'] = $_POST['font'];
                    if (isset($_POST['preset']))
                        $this->options['preset'] = $_POST['preset'];

                    $this->save_admin_options();

                    echo '<div class="updated"><p>' . __('Success! Your changes were successfully saved!', 'wp-paginate') . '</p></div>';
                } else {
                    echo '<div class="error"><p>' . __('Whoops! There was a problem with the data you posted. Please try again.', 'wp-paginate') . '</p></div>';
                }
            }

            ?>

            <div class="wrap">
                <div class="icon32" id="icon-options-general"><br/></div>
                <h1>WP-Paginate</h1>
                <h2 class="nav-tab-wrapper">
                    <a class="nav-tab<?php if (!isset($_GET['action'])) echo ' nav-tab-active'; ?>"
                       href="options-general.php?page=wp-paginate.php"><?php _e('Settings'); ?></a>
                </h2>

                <?php if (!isset($_GET['action']) || $_GET['action'] == 'appearance') { ?>

                    <form method="post" id="wp_paginate_options">
                        <?php wp_nonce_field('wp-paginate-update-options'); ?>

                        <h3><?php _e('General'); ?></h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">Etiqueta de Paginação:</th>
                                <td><input name="title" type="text" id="title" size="40"
                                           value="<?php echo esc_attr(stripslashes(htmlspecialchars($this->options['title']))); ?>"/>
                                    <span class="description"><?php _e('The optional text/HTML to display before the list of pages.', 'wp-paginate'); ?></span>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">Página Anterior:</th>
                                <td><input name="previouspage" type="text" id="previouspage" size="40"
                                           value="<?php echo esc_attr(stripslashes(htmlspecialchars($this->options['previouspage']))); ?>"/>
                                    <span class="description"><?php _e('The text/HTML to display for the previous page link.', 'wp-paginate'); ?></span>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">Próxima Página:</th>
                                <td><input name="nextpage" type="text" id="nextpage" size="40"
                                           value="<?php echo esc_attr(stripslashes(htmlspecialchars($this->options['nextpage']))); ?>"/>
                                    <span class="description"><?php _e('The text/HTML to display for the next page link.', 'wp-paginate'); ?></span>
                                </td>
                            </tr>
                        </table>
                        <p>&nbsp;</p>

                        <h3>Configurações Avançadas</h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">Intervalo de Páginas:</th>
                                <td>
                                    <select name="range" id="range">
                                        <?php for ($i = 1; $i <= 10; $i++) : ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($i == $this->options['range']) ? "selected='selected'" : ""; ?>><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <span class="description"><?php _e('The number of page links to show before and after the current page. Recommended value: 3', 'wp-paginate'); ?></span>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">Âncoras de Página:</th>
                                <td>
                                    <select name="anchor" id="anchor">
                                        <?php for ($i = 0; $i <= 10; $i++) : ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($i == $this->options['anchor']) ? "selected='selected'" : ""; ?>><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <span class="description"><?php _e('The number of links to always show at beginning and end of pagination. Recommended value: 1', 'wp-paginate'); ?></span>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">Gap de Página:</th>
                                <td>
                                    <select name="gap" id="gap">
                                        <?php for ($i = 1; $i <= 10; $i++) : ?>
                                            <option value="<?php echo $i; ?>" <?php echo ($i == $this->options['gap']) ? "selected='selected'" : ""; ?>><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <span class="description"><?php _e('The minimum number of pages in a gap before an ellipsis (...) is added. Recommended value: 3', 'wp-paginate'); ?></span>
                                </td>
                            </tr>
                        </table>
                        <p class="submit">
                            <input type="submit" id="wpp-save-changes" value="Save Changes" name="wp_paginate_save"
                                   class="button-primary"/>
                        </p>
                    </form>
                    <p>&nbsp;</p>
                <hr>
                    <script>
                        jQuery(document).ready(function () {

                            jQuery("#wpp-save-changes").click(function () {
                                unsaved = false;
                            });

                            var unsaved = false;

                            jQuery(":input").change(function () { //trigers change in all input fields including text type
                                unsaved = true;
                            });

                            function unloadPage() {
                                if (unsaved) {
                                    return "Do you want to leave this page and discard your changes or stay on this page?";
                                }
                            }

                            window.onbeforeunload = unloadPage;

                        });


                    </script>


                <?php } ?>


            </div>

            <?php
        }

        function wpp_include_codemirror()
        {
            wp_enqueue_style('codemirror.css', plugins_url('lib/codemirror.css', __FILE__));
            wp_enqueue_script('codemirror.js', plugins_url('lib/codemirror.js', __FILE__), array('jquery'));
        }

        function wpp_custom_code_tab()
        {
            if (!current_user_can('edit_plugins'))
                wp_die(__('You do not have sufficient permissions to edit plugins for this site.', 'wp-paginate'));

            $message = $content = '';
            $extension = 'css';
            $wpp_custom_css_active = get_option('wpp_custom_css_active', 'off');

            $upload_dir = wp_upload_dir();
            $folder = $upload_dir['basedir'] . '/wpp-custom-code';
            if (!$upload_dir["error"]) {
                if (!is_dir($folder))
                    wp_mkdir_p($folder, 0755);

                $index_file = $upload_dir['basedir'] . '/wpp-custom-code/index.php';
                if (!file_exists($index_file)) {
                    if ($f = fopen($index_file, 'w+'))
                        fclose($f);
                }
            }

            $css_file = 'wpp-custom-code.css';
            $real_css_file = $folder . '/' . $css_file;

            if (isset($_REQUEST['wpp_update_custom_code']) && check_admin_referer('wpp_update_nonce' . $css_file)) {

                /* CSS */
                $newcontent_css = wp_unslash($_POST['wpp_newcontent_css']);
                if ($f = fopen($real_css_file, 'w+')) {
                    fwrite($f, $newcontent_css);
                    fclose($f);
                    $message .= sprintf(__('File %s edited successfully.', 'wp-paginate'), '<i>' . $css_file . '</i>') . ' ';
                } else {
                    $error .= __('Not enough permissions to create or update the file', 'wp-paginate') . ' ' . $real_css_file . '. ';
                }

                if (isset($_REQUEST['wpp_custom_css_active']))
                    $wpp_custom_css_active = 'on';
                else
                    $wpp_custom_css_active = 'off';

                update_option('wpp_custom_css_active', $wpp_custom_css_active, true);

                if (!empty($error))
                    $error .= ' <a href="https://codex.wordpress.org/Changing_File_Permissions" target="_blank">' . __('Learn more', 'wp-paginate') . '</a>';
            }

            if (file_exists($real_css_file)) {
                update_recently_edited($real_css_file);
                $content_css = esc_textarea(file_get_contents($real_css_file));
                //$is_css_active = true;
            } else
                $content_css = "";

            if (!empty($message)) { ?>
                <div id="message" class="below-h2 updated notice is-dismissible"><p><?php echo $message; ?></p></div>
            <?php } ?>
            <form action="" method="post">
                <p>
                    <?php _e('These styles will be added to the header on all pages of your site.', 'wp-paginate'); ?>
                </p>
                <p><big>
                        <?php if (!file_exists($real_css_file) || (is_writeable($real_css_file))) {
                            echo __('Editing', 'wp-paginate') . ' <strong>' . $css_file . '</strong>';
                        } else {
                            echo __('Browsing', 'wp-paginate') . ' <strong>' . $css_file . '</strong>';
                        } ?>
                    </big></p>
                <p><label><input type="checkbox" name="wpp_custom_css_active"
                                 value="1" <?php checked($wpp_custom_css_active, 'on'); ?> /> <?php _e('Activate', 'wp-paginate'); ?>
                    </label></p>
                <textarea cols="70" rows="25" name="wpp_newcontent_css"
                          id="wpp_newcontent_css"><?php if (isset($content_css)) echo $content_css; ?></textarea>
                <?php if (!file_exists($real_css_file) || is_writeable($real_css_file)) { ?>
                    <p class="submit">
                        <input type="hidden" name="wpp_update_custom_code" value="submit"/>
                        <?php submit_button(__('Save Changes', 'wp-paginate'), 'primary', 'submit', false);
                        wp_nonce_field('wpp_update_nonce' . $css_file); ?>
                    </p>
                <?php } else { ?>
                    <p>
                        <em><?php printf(__('You need to make this files writable before you can save your changes. See %s the Codex %s for more information.', 'wp-paginate'),
                                '<a href="https://codex.wordpress.org/Changing_File_Permissions" target="_blank">',
                                '</a>'); ?></em></p>
                <?php } ?>
            </form>
            <script>
                jQuery(document).ready(function () {

                    if (typeof CodeMirror == 'function') {
                        if (jQuery('#wpp_newcontent_css').length > 0) {
                            var editor = CodeMirror.fromTextArea(document.getElementById('wpp_newcontent_css'), {
                                mode: "css",
                                theme: "default",
                                styleActiveLine: true,
                                matchBrackets: true,
                                lineNumbers: true,
                            });
                        }
                    }

                    jQuery("#submit").click(function () {
                        unsaved = false;
                    });

                    var unsaved = false;

                    jQuery(":input").change(function () { //trigers change in all input fields including text type
                        unsaved = true;
                    });

                    function unloadPage() {
                        if (unsaved) {
                            return "Do you want to leave this page and discard your changes or stay on this page?";
                        }
                    }

                    window.onbeforeunload = unloadPage;

                });


            </script>
        <?php }

        function wpp_print_style()
        {
            $this->get_options();
            //global $pgntn_options;
            ?>
            <style type="text/css">
                <?php
                    $classes = '';
                    if(isset($this->options['hide-standard-pagination']) && $this->options['hide-standard-pagination']) {
                        //$hide_comments
                        $classes .=
                            '.archive #nav-above,
                            .archive #nav-below,
                            .search #nav-above,
                            .search #nav-below,
                            .blog #nav-below, 
                            .blog #nav-above, 
                            .navigation.paging-navigation, 
                            .navigation.pagination,
                            .pagination.paging-pagination, 
                            .pagination.pagination, 
                            .pagination.loop-pagination, 
                            .bicubic-nav-link, 
                            #page-nav, 
                            .camp-paging, 
                            #reposter_nav-pages, 
                            .unity-post-pagination, 
                            .wordpost_content .nav_post_link';
                    }
                    if ( ( ! empty( $pgntn_options['additional_pagination_style'] ) ) && '1' == $pgntn_options['display_custom_pagination'] ) {
                        $classes .= ! empty( $classes ) ? ',' : '';
                        $classes .= $pgntn_options['additional_pagination_style'];
                    }
                    if ( ! empty( $classes ) ) {
                        echo $classes . ' { 
                                display: none !important; 
                            }
                            .single-gallery .pagination.gllrpr_pagination {
                                display: block !important; 
                            }';
                    } ?>
            </style>
        <?php }

        public function wpp_set_review_later()
        {

            if (!wp_verify_nonce($_POST['nonce'], WP_PAGINATE_NONCE)) {
                exit(__('missing nonce!', 'wp-paginate'));
            }

            $current_user_id = get_current_user_id();

            $review_date = date('Y-m-d', strtotime("+7 days"));


            update_user_meta($current_user_id, WPP_REVIEW_NOTICE, $review_date);

            exit();

        }

        function wpp_upgrade_to_pro_tab()
        {
            ?>
            <div id="utp-content">
                <div id="mf-logo">
                    <img alt="<?php _e('maxfoundry logo', 'wp-paginate'); ?>"
                         src="<?php echo $this->pluginurl . '/images/max-foundry.png'; ?>" width="172" height="32">
                </div>
                <div style="clear:both"></div>
                <div id="utp-banner">
                    <div id="utp-title-wrap">
                        <div id="utp-title"><?php _e('WP PAGINATE PRO', 'wp-paginate'); ?></div>
                    </div>
                    <a href="<?php echo WPP_WP_PAGINATE_PRO_LINK; ?>" target="_blank">
                        <img class="buy-now-button" alt="<?php _e('buy now button', 'wp-paginate'); ?>"
                             src="<?php echo $this->pluginurl . "/images/buy-now-btn.png" ?>" width="205" height="68">
                    </a>
                </div>
                <img id='wppp-logo' alt="<?php _e('wp-pagination pro logo', 'wp-paginate'); ?>"
                     src="<?php echo $this->pluginurl . '/images/wpp-pro-logo-2.png'; ?>" width="169" height="61">

                <div class="utp-text">
                    <?php _e('WP-Paginate Pro come with 11 Beautiful<br>Preset Layouts and Multi Site support!', 'wp-paginate'); ?>
                </div>

                <div id="wppp-buttons">
                    <img alt="<?php _e('WP Pagination Pro buttons styles', 'wp-paginate'); ?>"
                         src="<?php echo $this->pluginurl . '/images/wppp-buttons.png'; ?>" width="646" height="713">
                </div>

                <div class="utp-text">
                    <?php _e('Use These Customizer Settings to Get the<br>Exact Look and Feel You Want', 'wp-paginate'); ?>
                </div>

                <div id="wppp-customizer">
                    <img alt="<?php _e('WP Pagination Por button Style customizer', 'wp-paginate'); ?>"
                         src="<?php echo $this->pluginurl . '/images/wppp-customizer.png'; ?>" width="650" height="380">
                </div>

                <a href="<?php echo WPP_WP_PAGINATE_PRO_LINK; ?>" target="_blank">
                    <img class="buy-now-button" alt="<?php _e('buy now button', 'wp-paginate'); ?>"
                         src="<?php echo $this->pluginurl . "/images/buy-now-btn.png" ?>" width="205" height="68">
                </a>

            </div>


            <div>

            </div>


            <?php
        }


    }
}

//instantiate the class
if (class_exists('WPPaginate')) {
    $wp_paginate = new WPPaginate();
}

/**
 * Pagination function to use for posts
 */
function wp_paginate($args = false)
{

    if (!is_active_widget()) {
        global $wp_paginate;
        $wp_paginate->type = 'posts';
        return $wp_paginate->paginate($args);
    }
}

/**
 * Pagination function to use for post comments
 */
function wp_paginate_comments($args = false)
{
    global $wp_paginate;
    $wp_paginate->type = 'comments';
    return $wp_paginate->paginate($args);
}


/*
 * The format of this plugin is based on the following plugin template:
 * http://pressography.com/plugins/wordpress-plugin-template/
 */
