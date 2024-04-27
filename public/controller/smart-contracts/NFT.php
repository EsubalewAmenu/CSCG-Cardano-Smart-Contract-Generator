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
class CSCG_public_NFT
{
public function content_generator(){
    $file_path = plugin_dir_path(__FILE__).'templete/NFT.hs';
    $file_content = file_get_contents($file_path);
    
    $project_name = $_POST['projectName'];
    $token_name = $_POST['token_name'];
    $inlineable_token_name_checkbox = $_POST['inlineable_token_name_checkbox'];
    $owner_ref_address_checkbox = $_POST['owner_ref_address_checkbox'];
    $owner_ref_address = $_POST['owner_ref_address'];
    $offchain_code_checkbox = $_POST['offchain_code_checkbox'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    $add_offchain_code = $_POST['add_offchain_code'];
    $burn_code = $_POST['burn_code'];

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
$smart_contracts = array();
$smart_contracts[] = array("NFT.hs" => $file_content);



if($offchain_code_checkbox == "true"){

  $file_path = plugin_dir_path(__FILE__).'templete/lucid-nft.ts';
  $file_content = file_get_contents($file_path);
  
  $file_content = str_replace("{{token_name}}", $token_name, $file_content);

  $smart_contracts[] = array("lucid-nft.ts" => $file_content);

}

if($burn_code == "true"){

  $file_path = plugin_dir_path(__FILE__).'templete/Burn.hs';
  $file_content = file_get_contents($file_path);
  

  $smart_contracts[] = array("Burn.hs" => $file_content);

}

  return $smart_contracts;
}
}