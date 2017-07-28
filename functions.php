<?php

/**
 * Globals
 */

if ( !defined( 'WP_CONTENT_URL' ) )
    define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );

if ( !defined( 'WP_CONTENT_DIR' ) )
    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );

if ( !defined( 'WP_PLUGIN_URL' ) )
    define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );

if ( !defined( 'WP_PLUGIN_DIR' ) )
    define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

if ( !defined( 'WP_LANG_DIR') )
    define( 'WP_LANG_DIR', WP_CONTENT_DIR . '/languages' );

if ( !defined( 'DISCIPLE_TOOLS_DIR') )
    define( 'DISCIPLE_TOOLS_DIR', WP_PLUGIN_DIR . '/disciple-tools' );

// Removes the admin bar
add_filter( 'show_admin_bar', '__return_false' );


/**
 * Functions
 */

// Foundations theme configurations
require_once(get_template_directory().'/assets/functions/theme-support.php'); // Theme support options
require_once(get_template_directory().'/assets/functions/cleanup.php'); // WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php'); // Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/sidebar.php'); // Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/comments.php'); // Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/page-navi.php'); // Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/translation/translation.php'); // Adds support for multiple languages
require_once(get_template_directory().'/assets/functions/disable-emoji.php'); // Remove 4.2 Emoji Support

// Adds Disciple Tools Theme General Functions
require_once(get_template_directory().'/assets/functions/private-site.php'); // Sets site to private
require_once(get_template_directory().'/assets/functions/login.php'); // Customize the WordPress login menu
require_once(get_template_directory().'/assets/functions/menu.php'); // Register menus and menu walkers
require_once(get_template_directory().'/assets/functions/admin-dashboard.php'); // Admin Dashboard

// Adds Page Specific Scripts
require_once(get_template_directory().'/assets/functions/page-front-page.php');
require_once(get_template_directory().'/assets/functions/page-reports.php');
require_once(get_template_directory().'/assets/functions/page-profile.php');
require_once(get_template_directory().'/assets/functions/page-prayer-guide.php');

// Load plugin library that "requires plugins" at activation
require_once(get_template_directory().'/assets/functions/config-required-plugins.php');
require_once(get_template_directory().'/assets/functions/class-tgm-plugin-activation.php');



/**
 * Disciple_Tools_Theme Classes
 *
 * @class Disciple_Tools_Theme
 * @version	0.1
 * @since 0.1
 * @package	Disciple_Tools_Theme
 * @author Chasm.Solutions & Kingdom.Training
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Disciple_Tools_Theme {

    /**
     * Disciple_Tools_Theme The single instance of Disciple_Tools_Theme.
     * @var 	object
     * @access  private
     * @since 	0.1
     */
    private static $_instance = null;

    /**
     * Main Disciple_Tools_Theme Instance
     *
     * Ensures only one instance of Disciple_Tools_Admin_Menus is loaded or can be loaded.
     *
     * @since 0.1
     * @static
     * @return Disciple_Tools_Theme instance
     */
    public static function instance () {
        if ( is_null( self::$_instance ) )
            self::$_instance = new self();
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     * @access  public
     * @since   0.1
     */
    public function __construct () {

        require_once(get_template_directory() . '/assets/classes/config-options-admin.php');
        $this->admin_options = Disciple_Tools_Theme_Admin::instance();


    } // End __construct()

}

/**
 * Gets the instance of the `dt_sample_data` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  0.1
 * @access public
 * @return object
    */
function dt_theme() {
    return Disciple_Tools_Theme::instance();
}

// Let's roll!
//add_action( 'after_setup_theme', 'dt_theme' );
dt_theme();






// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/assets/functions/editor-styles.php');

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php');