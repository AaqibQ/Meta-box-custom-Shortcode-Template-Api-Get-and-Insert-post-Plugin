<?php 


/**
 * Plugin Name:       Lecture PG
 * Description:       Lecture PG
 * Plugin Uri:        http://google.com
 * Author:            Aaqib Ali   
 * Author Uri:        http://google.com
 * Domain Path:       /languages
 */


if ( ! defined( 'ABSPATH' ) ) { 
	exit; // Exit if accessed directly
}


// hooks to add table and update and delete value 

                register_activation_hook( __FILE__ , 'create_db_table' );
                function create_db_table (){
                    // echo 'tttttttt';
                    // die();
                    global $wpdb;
                    // $prifix = $wpdb->prefix;
                    $collate = $wpdb->get_charset_collate();
                    
                    
                    $sql = "CREATE TABLE `{$wpdb->prefix}likesdislikes` (
                        `id` int(255) NOT NULL AUTO_INCREMENT,
                        `post_id` int(255) NOT NULL,
                        `like` int(255) NOT NULL,
                        `dislike` int(255) NOT NULL,
                        `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                        PRIMARY KEY (`id`)
                    )" . $collate . ';';

                        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                        dbDelta($sql);

                }
                register_activation_hook( __FILE__ , 'update_db_table' );
                function update_db_table (){


                    global $wpdb;
                    $prifix = $wpdb->prefix;
                    $table = $prifix."likesdislikes";
                    $data = array(
                        'post_id' => 1,
                        'like' => 1,
                        'dislike' => 0,
                        'date' => current_time('mysql'),
                    );
                    $wpdb-> insert($table , $data);

                }



                    register_deactivation_hook( __FILE__ , 'delete_db_table' );
                    function delete_db_table (){ 

                        // global $wpdb;
                        // $sql_drop = "DROP TABLE IF EXISTS `{$wpdb->prefix}likesdislikes`;";
                        // $wpdb->query($sql_drop);

                        global $wpdb;
                        $prifix = $wpdb->prefix;
                        $table = $prifix."likesdislikes";
                        $sql_drop = "TRUNCATE TABLE `{$table}`;";
                        $wpdb->query($sql_drop);

                    }

// hooks end 

class Lecture_Pg { 

    public function __construct() {
		$this->display_custom_posts_constants();
        add_action( 'init', array($this, 'display_blog_posts_text_domain')); // for text domain
		add_action( 'admin_menu', array($this, 'addMyAdminMenu' ));
        add_action( 'admin_menu', array($this, 'lecture_pg_process_form_setting' ));
        add_action( 'admin_menu', array($this, 'addSubMenu' ));
        add_action( 'admin_menu', array($this, 'addSubMenu2' ));
        include( CUSTOMPOST_PLUGIN_DIR . 'connection/connection.php');    
        include( CUSTOMPOST_PLUGIN_DIR . 'inc/shortcodes.php');
        include( CUSTOMPOST_PLUGIN_DIR . 'inc/metabox.php');        
        include( CUSTOMPOST_PLUGIN_DIR . 'inc/add_custom_post.php');
        // include( CUSTOMPOST_PLUGIN_DIR . 'inc/db.php');
		// if (is_admin()) {
		// include( CUSTOMPOST_PLUGIN_DIR . 'admin/create_post_type.php');
		// }



    }

    public function display_blog_posts_text_domain() {
		load_plugin_textdomain('display-custom-posts', false, dirname(plugin_basename(__FILE__)) . '/languages/');

	}

    function display_custom_posts_constants() {
		if ( !defined( 'CUSTOMPOST_URL' ) ) {
			define( 'CUSTOMPOST_URL', plugin_dir_url( __FILE__ ) );
		}

		if ( ! defined( 'CUSTOMPOST_PLUGIN_DIR' ) ) {
			define( 'CUSTOMPOST_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}
        if ( ! defined( 'PLUGIN_FILE' ) ) {
			define( 'PLUGIN_FILE',  __FILE__  );
		}
	}


// register a new value 

// hooks call out of the class 


// to display save menu in field
    function lecture_pg_process_form_setting(){

        register_setting('lg_option_group' , 'lg_option_name');
        if(isset($_POST['action']) && current_user_can('manage_options')){
            // print_r($_POST);
            // exit;
            update_option('lecture_pg' , sanitize_text_field($_POST['lecture_pg']));
        }

    }
    // main menu 

    function inside_html() { ?>
        <h1> Add Custom Fields on Options.php </h1>
        <?php settings_errors();?>
        <form action="options.php" method="POST">    
           <?php settings_fields('lg_option_group') ?>
             <label> Enter Field </label>
            <input type = "text" name="lecture_pg" value="<?php esc_html(get_option('lecture_pg'));?>"></label>
            <?php submit_button('Save Changes');  ?>
        </form>
     <?php



    }

    function addMyAdminMenu(){
           
            add_menu_page(
                'New Menu Page',
                'New Menu',
                'manage_options',
                'my-menu-page-slug',
                array($this, 'inside_html'),
                'dashicons-welcome-widgets-menus',
                90
            );
           


    }


    // sub menu  1
    
    function submenu_page_callback(){
            echo 'Echo the html here...';
        }
            
    function addSubMenu() {
        add_submenu_page( 
            'my-menu-page-slug', 
            'Submenu title', 
            'Submenu title', 
            'manage_options', 
            'submenu-page', 
            array($this, 'submenu_page_callback')
        );
    }


    // sub menu  aa on setting page 

    function submenu_page_callback2(){
        echo 'Echo the html here...';
    }
        
    function addSubMenu2() {
        add_options_page( 
            'Theme Options', 
            'Submenu title', 
            'manage_options',
            'lecture_pg-theme-settings',
            'submenu-page', 
            array($this, 'submenu_page_callback2')
        );
    }

      




}

new Lecture_Pg();




