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
