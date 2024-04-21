<div class="container">
    <form class="form" action="" method="post">
        <div class="form-container">
            <div class="input-parent">
                <label class="form-label" for="project_name">Module Name:</label>
                <input class="form-input" type="text" name="project_name" id="project_name" required>
            </div>
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

        <button id="submit_btn" disabled="true" class="submit-button btn-disabled" type="submit" data-user-id="<?php echo get_current_user_id() ?>">Generate the Smart contract code</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";
    const dynamicContainer = document.querySelector('.fetched-value')
    const dropDownInput = document.querySelector('#dropDown')
    const generateToken = document.querySelector('#submit_btn')
    let ownerRefCheckbox;
    let ownerRefContainer;
    let btnStatus = false
    let option = ''



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
                generateToken.classList.remove('btn-disabled')
                generateToken.disabled = false


            // Find and execute scripts
            Array.from(dynamicContainer.querySelectorAll('script')).forEach(oldScript => {
                const newScript = document.createElement('script');
                newScript.text = oldScript.text;
                oldScript.parentNode.replaceChild(newScript, oldScript);
            });

            }
        });
    }
    dropDownInput.addEventListener('change', function(element) {
        option = element.target.value
        fetchContent(element.target.value)
    })
    
    // Function to generate a zip file
    function generateZip(contracts, filename) {
        var zip = new JSZip();

        for (let key in contracts) {
                if (contracts.hasOwnProperty(key)) { // This check isn't strictly necessary in modern JavaScript environments
            zip.file(key, contracts[key]);
                }
            }
    
        // Generate the zip file
        zip.generateAsync({type:"blob"}).then(function(content) {
        // Save the zip file
        saveAs(content, `${filename}.zip`);
        });
    }
    generateToken.addEventListener('click', function(element) {
        // event.preventDefault();  // This stops the form from submitting normally

        const projectName = document.querySelector('#project_name')
        if(!projectName.value || projectName.value == ''){
            alert("Please Enter Your project name!")
        }
        else{
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'cscg_generate_token',
                    projectName:projectName.value,
                    
                    ...getFormData()
                    
                },
                success: function(response) {
                    const res = JSON.parse(response)
                    if(res.status == 'success'){
                        generateZip(res.contracts,projectName.value)
                    } 
                }
            });
        }

    })

</script>