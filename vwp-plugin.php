<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Chatbot Wookend
 * Plugin URI:        http://vuewp.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           2.1.3
 * Author:            Vue WordPress
 * Author URI:        vuewp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vwp-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}




function chatbot_enqueue_scripts()
{

  wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
  wp_enqueue_style('chatbot-style', plugins_url('assets/css/chatbot-style.css', __FILE__));

  wp_enqueue_script('chatbot-script-counter', plugins_url('./assets/js/chatbot-script.js', __FILE__));
  $selectedOption = get_option('selectedOption', ''); // Get the current value of selectedOption
  wp_localize_script('chatbot-script-counter', 'selectedOptionData', array(
      'selectedOption' => $selectedOption
  ));
 
  wp_enqueue_script('chatbot-script', plugins_url('assets/js/chatbot-script.js', __FILE__), array('jquery'), '1.0', true);
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
  wp_enqueue_script('chatbot-fontawsome', plugins_url('assets/fontawesome/css/fontawesome.css', __FILE__), array('jquery'), '1.0', true);
  wp_enqueue_script('chatbot-fontawsome-brands', plugins_url('assets/fontawesome/css/brands.css', __FILE__), array('jquery'), '1.0', true);
  wp_enqueue_script('chatbot-fontawsome', plugins_url('assets/fontawesome/csssolid.css', __FILE__), array('jquery'), '1.0', true);
  

  // Pass AJAX URL to JavaScript
  wp_localize_script('chatbot-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

  // Add inline script to hide chatbot container initially
  wp_add_inline_script('chatbot-script', 'jQuery(document).ready(function($) { $("#chatbot-container").hide(); });');
  wp_enqueue_script('cropper', 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js', array('jquery'), '1.5.12', true);
  wp_enqueue_style('cropper-style', 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css');
}
add_action('wp_enqueue_scripts', 'chatbot_enqueue_scripts');


function enqueue_plugin_styles() {
  // Only enqueue the stylesheet on the front end.
  if (!is_admin()) {
      wp_enqueue_style('vue-css', plugin_dir_url(__FILE__) . './src/css/index.css');
  }
}
add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');


//vue cdn for php
// function enqueue_vue() {
//   wp_enqueue_script('vue', 'https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js', array(), '2.6.14', true);
// }

// add_action('wp_enqueue_scripts', 'enqueue_vue');

// function enqueue_chatbot_component() {
//   wp_enqueue_script('chatbot-component', plugin_dir_url(__FILE__) . './public/scripts.js', array('vue'), '1.0.0', true);
// }

// add_action('wp_enqueue_scripts', 'enqueue_chatbot_component');

// function enqueue_custom_scripts() {
//   // Enqueue Vue.js
//   wp_enqueue_script('vue', '/src/vue/components/settings-component/ChatbotCounter.vue', array(), '1.0', true);

//   // Enqueue your chatbot script
//   // wp_enqueue_script('chatbot', './assets/js/chatbot-script.js', array(), '1.0', true);
// }
// add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');



















class VwpPlugin
{
  public $plugin;

  function __construct()
  {
    $this->plugin = plugin_basename(__FILE__);
  }

  function register()
  {
    add_action('admin_menu', array($this, 'add_admin_page'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
    add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
    add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));

    add_action('wp_footer', array($this, 'chatbotDisplay')); 
    // add_action('wp_footer', array($this, 'display'));
  }

  public function chatbotDisplay() {
    echo '<div id="vue-chatbot"></div>';
}

 

  public function settings_link($links)
  {
    $settings_link = '<a href="admin.php?page=vwp_plugin">Settings</a>';
    array_push($links, $settings_link);
    return $links;
  }

  function enqueue_assets()
  {
    wp_enqueue_style("$this->plugin-css", plugins_url('/public/styles.css', __FILE__));
    wp_enqueue_script("$this->plugin-js", plugins_url('/public/scripts.js', __FILE__), null, null, true);
  }

  public function add_admin_page()
  {
    add_menu_page("Chatbot Vue", 'Chatbot Vue', 'manage_options', 'vwp_plugin', array($this, 'admin_index'), 'dashicons-format-chat', 5);

    // Add submenu under "Chatbot Vue" menu
    add_submenu_page('vwp_plugin', 'Leads', 'Leads', 'manage_options', 'leads', array($this, 'leads_callback'));
    add_submenu_page('vwp_plugin', 'Conversations', 'Conversations', 'manage_options', 'conversations', array($this, 'conversations_callback'));
    add_submenu_page('vwp_plugin', 'Settings', 'Settings', 'manage_options', 'settings', array($this, 'settings_callback'));

  }

 

  public function admin_index(){

    // echo '<h1>This is Plugin usages Vue Framework</h1>';

    require_once plugin_dir_path(__FILE__) . 'templates/admin/index.php';
  }



  public function leads_callback()
  {
    require_once plugin_dir_path(__FILE__) . 'templates/admin/leads-index.php';
  }

  public function conversations_callback()
  {

    require_once plugin_dir_path(__FILE__) . 'templates/admin/index-conversations.php';

  }

  public function settings_callback()
  {

    require_once plugin_dir_path(__FILE__) . 'templates/admin/index-settings.php';

  }

  public function chatbot_callback()
  {

    require_once plugin_dir_path(__FILE__) . 'templates/admin/chatbot.php';

  }


 


}



if (class_exists('VwpPlugin')) {
  $vwpPlugin = new VwpPlugin();
  $vwpPlugin->register();
}



// function add_vue_chatbot_to_footer() {


//   echo '<div  id="vwp-chatbot"> </div>';


// }

// add_action('wp_footer', 'add_vue_chatbot_to_footer');

// Activation
require_once plugin_dir_path(__FILE__) . 'inc/vwp-plugin-activate.php';
register_activation_hook(__FILE__, array('VwpPluginActivate', 'activate'));

// Deactivation
require_once plugin_dir_path(__FILE__) . 'inc/vwp-plugin-deactivate.php';
register_deactivation_hook(__FILE__, array('VwpPluginDeactivate', 'deactivate'));
// require_once('../../../wp-load.php');
require_once plugin_dir_path(__FILE__) . './inc/ajax-endpoint.php';
require_once plugin_dir_path(__FILE__) . './inc/chatbot-display.php';