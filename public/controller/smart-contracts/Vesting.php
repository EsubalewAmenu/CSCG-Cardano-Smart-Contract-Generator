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
class CSCG_public_Vesting
{
    public function content_generator(){
        $file_path = plugin_dir_path(__FILE__).'templete/lucid-vesting.ts';
        $file_content = file_get_contents($file_path);
        
        $blockfrost_api_key = $_POST['blockfrost_api_key'];
        $vesting_deadline = $_POST['vesting_deadline'];

        if($blockfrost_api_key == ""){
            $file_content = str_replace("{{blockfrost_api_key}}", "insert your own api key here", $file_content);
        }else $file_content = str_replace("{{blockfrost_api_key}}", $blockfrost_api_key, $file_content);

        $file_content = str_replace("{{vesting_deadline}}", $vesting_deadline, $file_content);

        $smart_contracts = array();
        $smart_contracts[] = array("lucid-vesting.ts" => $file_content);
        
        return $smart_contracts;
    }
}