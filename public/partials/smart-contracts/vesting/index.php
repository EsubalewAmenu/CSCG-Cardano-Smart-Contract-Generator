
<div class="form-container">
    <div class="checkbox-parent">
        <input class="form-input form-checkbox" type="checkbox" name="policy_generator_code_checkbox" id="policy_generator_code_checkbox">
        <label class="form-label" for="policy_generator_code_checkbox">Do You Want Policy Generator Code</label>
    </div>
</div>

<div class="form-container checkbox-container owner-ref-address-ckeckbox">
    <div class="checkbox-parent">
        <input class="form-input form-checkbox owner-ref-address-ckeckbox" type="checkbox" name="offchain_code_checkbox" id="offchain_code_checkbox" checked>
        <label class="form-label" for="offchain_code_checkbox">Do you want offchain (lucid) code?</label>
    
</div>

<div class="blockfrost_api_key_div">
    <label class="form-label" for="blockfrost_api_key">Blockfrost Preprod api key</label>
    <input class="form-input" type="text" name="blockfrost_api_key" id="blockfrost_api_key" placeholder="If not filled placeholder will be 'insert your own api key here'">
</div>
<div class="vesting_deadline_div">
    <label class="form-label" for="vesting_deadline">Choose a vesting Deadline</label>
    <input class="form-input" type="datetime-local" name="vesting_deadline" id="vesting_deadline">
</div>


<script>

    offchainCodeCheckbox = document.querySelector('#offchain_code_checkbox')
    blockfrost_api_key_div = document.querySelector('.blockfrost_api_key_div')
    vesting_deadline_div = document.querySelector('.vesting_deadline_div')
    offchainCodeCheckbox.addEventListener('change',function(){
        if(this.checked){
            blockfrost_api_key_div.classList.remove('hidden')
            vesting_deadline_div.classList.remove('hidden')
        }
        else{
            blockfrost_api_key_div.classList.add('hidden')
            vesting_deadline_div.classList.add('hidden')

        }
    })
    function getFormData() {
    return {
        blockfrost_api_key: document.querySelector('#blockfrost_api_key').value,
        vesting_deadline: document.querySelector('#vesting_deadline').value,
        policy_generator_code_checkbox: document.querySelector('#policy_generator_code_checkbox').checked,
        offchain_code_checkbox: document.querySelector('#offchain_code_checkbox').checked,
    };
}


</script> 
