
<div>
    <label class="form-label" for="blockfrost_api_key">Blockfrost Preprod api key</label>
    <input class="form-input" type="text" name="blockfrost_api_key" id="blockfrost_api_key" placeholder="If not filled placeholder will be 'insert your own api key here'">
</div>
<div>
    <label class="form-label" for="vesting_deadline">Choose a vesting Deadline</label>
    <input class="form-input" type="datetime-local" name="vesting_deadline" id="vesting_deadline">
</div>


<script>

    function getFormData() {
    return {
        blockfrost_api_key: document.querySelector('#blockfrost_api_key').value,
        vesting_deadline: document.querySelector('#vesting_deadline').value,
    };
}


</script> 
