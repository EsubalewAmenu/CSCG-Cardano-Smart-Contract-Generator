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
    $file_path = plugin_dir_path(__FILE__).'templete/mint.txt';
    $file_content = file_get_contents($file_path);
    
    $project_name = $_POST['projectName'];
    $token_name = $_POST['token_name'];
    $inlineable_token_name_checkbox = $_POST['inlineable_token_name_checkbox'];
    $owner_ref_address_checkbox = $_POST['owner_ref_address_checkbox'];
    $owner_ref_address = $_POST['owner_ref_address'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $add_offchain_code = $_POST['add_offchain_code'];

    $file_content = str_replace("{{project_name}}", $project_name, $file_content);

    if($inlineable_token_name_checkbox == "true"){
      $file_content = str_replace("{{inlineable_token_name_checkbox}}", '
-- Creating TokenName
{-# INLINEABLE '.strtolower($token_name).'TokenName #-}
'.strtolower($token_name).'TokenName :: TokenName
'.strtolower($token_name).'TokenName = TokenName "'.$token_name.'"
      ', $file_content);
    } else $file_content = str_replace("{{inlineable_token_name_checkbox}}", '', $file_content);


    if($owner_ref_address_checkbox == "true"){
      $file_content = str_replace("{{inlineable_TxOutRef_checkbox}}", 
'ownerOref :: TxOutRef
ownerOref = TxOutRef "'.$owner_ref_address.'" 0
      ', $file_content);

      $file_content = str_replace("{{TxOutRef}}", 'ownerOref', $file_content);
    } else {
      $file_content = str_replace("{{inlineable_TxOutRef_checkbox}}", '', $file_content);
      $file_content = str_replace("{{TxOutRef}}", 'TxOutRef', $file_content);
    }


if($add_offchain_code == "true"){
  $file_content = str_replace("{{add_offchain_code}}", '
---------------------------------------------------------------------------------------------------
------------------------------------- HELPER FUNCTIONS --------------------------------------------

saveNFTCode :: IO ()
saveNFTCode = writeCodeToFile "assets/nft.plutus" nftCode

saveNFTPolicy :: TxOutRef -> TokenName -> IO ()
saveNFTPolicy oref tn = writePolicyToFile
    (printf "assets/nft-%s#%d-%s.plutus"
        (show $ txOutRefId oref)
        (txOutRefIdx oref) $
        tn\') $
    nftPolicy oref tn
  where
    tn\' :: String
    tn\' = case unTokenName tn of
        (BuiltinByteString bs) -> BS8.unpack $ bytesToHex bs

nftCurrencySymbol :: TxOutRef -> TokenName -> CurrencySymbol
nftCurrencySymbol oref tn = currencySymbol $ nftPolicy oref tn', $file_content);
} else $file_content = str_replace("{{add_offchain_code}}", '', $file_content);



    echo json_encode(
      array(
        'status' => 'success', 'contracts' => array("NFT.hs" => $file_content, "lucid-nft.ts" => "test lucid-nft.ts")
      )
    );
    die();
  }

}
