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
class CSCG_public_common
{
    public function section_direction(){
        include_once plugin_dir_path(dirname(__FILE__)) . '/partials/common/section-direction.php';
    }
    public function section_showcase(){
        include_once plugin_dir_path(dirname(__FILE__)) . '/partials/common/section-showcase.php';
    }
}