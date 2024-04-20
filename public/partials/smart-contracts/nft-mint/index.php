
<div class="form-container">
    <div class="input-parent">
        <label class="form-label" for="token_name">Project Token name:</label>
        <input class="form-input" type="text" name="token_name" id="token_name">
    </div>
</div>

<div class="form-container checkbox-container inlineable-token-name-ckeckbox">
    <div class="checkbox-parent">
        <input class="form-input form-checkbox inlineable-token-name-ckeckbox" type="checkbox" name="inlineable_token_name_checkbox" id="inlineable_token_name_checkbox">
        <label class="form-label" for="inlineable_token_name_checkbox">Inlineable token name?</label>
    
</div>

<div class="form-container checkbox-container owner-ref-address-ckeckbox">
    <div class="checkbox-parent">
        <input class="form-input form-checkbox owner-ref-address-ckeckbox" type="checkbox" name="owner_ref_address_checkbox" id="owner_ref_address_checkbox">
        <label class="form-label" for="owner_ref_address_checkbox">Is Owner Ref Address static:</label>
    
</div>

<div class="form-container owner-ref-address-container hidden">
    <div class="input-parent">
               <label class="form-label" for="owner_ref_address">Owner Ref Address:</label>
        <input class="form-input" type="text" name="owner_ref_address" id="owner_ref_address">
    </div>
</div> 
<div>
            <label class="form-label" for="image_url">Image URL:</label>
            <input class="form-input" type="text" name="image_url" id="image_url">
        </div>

        <div class="form-container ">
    <div class="input-parent">
               <label class="form-label" for="description">Description:</label>
               <textarea  name="description" id="description"  cols="77" rows="3"></textarea>
    </div>
           </div>

        
<div class="form-container">
    <div class="checkbox-parent">
        <input class="form-input form-checkbox" type="checkbox" name="add_offchain_code" id="add_offchain_code">
        <label class="form-label" for="add_offchain_code">Do You Want Policy Generator Code</label>
    </div>
</div>

<script>
    console.log(document.querySelector('#owner_ref_address'));
    console.log('hello');
</script> 
