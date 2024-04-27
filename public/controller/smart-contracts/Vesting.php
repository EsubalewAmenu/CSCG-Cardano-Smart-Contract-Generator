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
        $file_path = plugin_dir_path(__FILE__).'templete/Vesting.hs';
        $file_content = file_get_contents($file_path);
        

    
        $project_name = $_POST['projectName'];

        $file_content = str_replace("{{project_name}}", $project_name, $file_content);

        $policy_generator_code_checkbox = $_POST['policy_generator_code_checkbox'];
        $offchain_code_checkbox = $_POST['offchain_code_checkbox'];


if($policy_generator_code_checkbox == "true"){
$file_content = str_replace("{{policy_generator_code}}", '
---------------------------------------------------------------------------------------------------
------------------------------------- HELPER FUNCTIONS --------------------------------------------

saveVal :: IO ()
saveVal = writeValidatorToFile "./assets/vesting.plutus" validator

vestingAddressBech32 :: Network -> String
vestingAddressBech32 network = validatorAddressBech32 network validator

printVestingDatumJSON :: PubKeyHash -> String -> IO ()
printVestingDatumJSON pkh time = printDataToJSON $ VestingDatum
    { beneficiary = pkh
    , deadline    = fromJust $ posixTimeFromIso8601 time
    }', $file_content);
    } else $file_content = str_replace("{{policy_generator_code}}", '', $file_content);


    $smart_contracts = array();
    $smart_contracts[] = array("Vesting.hs" => $file_content);

    if($offchain_code_checkbox == "true"){

        $file_path = plugin_dir_path(__FILE__).'templete/lucid-vesting.ts';
        $file_content = file_get_contents($file_path);

        $blockfrost_api_key = $_POST['blockfrost_api_key'];
        $vesting_deadline = $_POST['vesting_deadline'];
        $beneficiary = $_POST['beneficiary'];

        if($blockfrost_api_key == ""){
            $file_content = str_replace("{{blockfrost_api_key}}", "insert your own api key here", $file_content);
        }else $file_content = str_replace("{{blockfrost_api_key}}", $blockfrost_api_key, $file_content);

        $file_content = str_replace("{{vesting_deadline}}", $vesting_deadline, $file_content);
        $file_content = str_replace("{{beneficiary}}", $beneficiary, $file_content);

        $smart_contracts[] = array("lucid-vesting.ts" => $file_content);
    }
        return $smart_contracts;
    }
}