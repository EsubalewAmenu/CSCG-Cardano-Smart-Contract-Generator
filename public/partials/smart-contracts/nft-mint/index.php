
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

    ownerRefCheckbox = document.querySelector('#owner_ref_address_checkbox')
    ownerRefContainer = document.querySelector('.owner-ref-address-container')
    ownerRefCheckbox.addEventListener('change',function(){
        if(this.checked){
            ownerRefContainer.classList.remove('hidden')
        }
        else{
            ownerRefContainer.classList.add('hidden')

        }
    })

    function getFormData() {
    return {
        token_name: document.querySelector('#token_name').value,
        inlineable_token_name_checkbox: document.querySelector('#inlineable_token_name_checkbox').checked,
        owner_ref_address_checkbox: document.querySelector('#owner_ref_address_checkbox').checked,
        owner_ref_address: document.querySelector('#owner_ref_address').value,
        image_url: document.querySelector('#image_url').value,
        description: document.querySelector('#description').value,
        add_offchain_code: document.querySelector('#add_offchain_code').checked,
    };
}


</script> 
