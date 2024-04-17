
<div class="form-container">
    <div class="input-parent">
        <label class="form-label" for="token_name">Project Token name:</label>
        <input class="form-input" type="text" name="token_name" id="token_name" required>
    </div>
</div>
<div class="form-container checkbox-container owner-ref-address-ckeckbox">
    <div class="checkbox-parent">
        <input class="form-input form-checkbox owner-ref-address-ckeckbox" type="checkbox" name="owner_ref_address" id="owner_ref_address" required>
        <label class="form-label" for="owner_ref_address">Is Owner Ref Address static:</label>
    
</div>

<div class="form-container owner-ref-address-container hidden">
    <div class="input-parent">
               <label class="form-label" for="owner_ref_address">Owner Ref Address:</label>
        <input class="form-input" type="text" name="owner_ref_address" id="owner_ref_address" required>
    </div>
</div>

<div class="form-container">
    <div class="checkbox-parent">
        <input class="form-input form-checkbox" type="checkbox" name="add_offchain_code" id="add_offchain_code" required>
        <label class="form-label" for="add_offchain_code">Add offchain code:</label>
    </div>
</div>

<script>
    console.log(document.querySelector('#owner_ref_address'));
    console.log('hello');
</script>