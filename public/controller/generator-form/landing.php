<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    CSCG
 * @subpackage CSCG/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    CSCG
 * @subpackage CSCG/public
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class CSCG_public_landing
{

  public function CSCG_form()
  {


    $options_variable = cscg_active_sc;
    ob_start();
    wp_enqueue_style('cscg-form-style', plugin_dir_url(__FILE__) . '../../css/cscg-public-form.css', false, '1.0', 'all');
    include_once plugin_dir_path(dirname(__FILE__)) . '../partials/generator-form/index.php';

    return ob_get_clean();
  }

  public function wp_ajax_cscg_fetch_selection()
  {
    $select_name = $_POST['selectedValue'];
     include_once plugin_dir_path(dirname(__FILE__)) . '../partials/smart-contracts/' . $select_name . '/index.php';
    die();
  }

  public function wp_ajax_cscg_generate_token(){
    $file_path = plugin_dir_path(__FILE__).'file/sample.txt';
    $file_content = file_get_contents($file_path);
    $project_name = $_POST['projectName'];

    $file_content = str_replace("{{project_name}}", $project_name, $file_content);
    echo json_encode(
      array(
        'status' => 'success', 'message' => $file_content
      )
    );
    die();
  }

}
