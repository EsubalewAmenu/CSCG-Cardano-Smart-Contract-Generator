<div class="container">
    <form class="form" action="" method="post">
        <div class="form-container">
            <div class="input-parent">
                <label class="form-label" for="project_name">Project Name:</label>
                <input class="form-input" type="text" name="project_name" id="project_name" required>
            </div>
            <div class="input-parent">
                <label class="form-label" for="email">Email:</label>
                <input class="form-input" type="email" name="email" id="email" required>
            </div>
        </div>

        <div>
            <label class="form-label" for="email">URL:</label>
            <input class="form-input" type="email" name="email" id="email" required>
        </div>

        <div class="form-container drop-down-container" style="float: left;width:50%;">
            <div class="input-parent">
                <label class="form-label" for="email">Choose:</label>
                <select id="dropDown" class="form-input">
                    <option value="" selected disabled>select one </option>
                    <?php foreach ($options_variable as $key => $value) { ?>
                        <option value="<?php echo $value ?>"><?php echo $key ?></option>
                    <?php } ?>
                </select>
            </div>

        </div>
            <div class="fetched-value"></div>


        <button id="submit_btn" class="submit-button" type="submit" data-user-id="<?php echo get_current_user_id() ?>">Generate the Smart contract code</button>
    </form>
</div>

<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";
    const dynamicContainer = document.querySelector('.fetched-value')
    const dropDownInput = document.querySelector('#dropDown')


    function fetchContent(selectedValue) {
        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'cscg_fetch_selection',
                selectedValue
            },
            success: function(response) {

                dynamicContainer.innerHTML = response

                // if (data.status = 'success') {
                //     alert(data.message);
                // } else {
                //     console.error(data.message);
                // }
            }
        });
    }
    dropDownInput.addEventListener('change', function(element) {
        fetchContent(element.target.value)
    })
</script>