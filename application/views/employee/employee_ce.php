<script type="text/javascript" src="<?php echo base_url() ?>jqwidgets/globalization/globalize.js"></script>
<?php echo $this->load->view('employee/employee_ce_js', null, true); ?>
<?php echo $this->load->view('employee/education_create_js', null, true); ?>
<?php echo $this->load->view('employee/employee_contract_js', null, true); ?>
<?php echo $this->load->view('employee/experience_ce_js', null, true); ?>
<?php echo $this->load->view('employee/employee_family_ce_js', null, true); ?>
 <?php echo $this->load->view('employee/emergency_contact_ce_js', null, true); ?>
<?php echo $this->load->view('employee/employee_transport_ce_js', null, true); ?>
<?php echo $this->load->view('employee/employee_other_js', null, true); ?>
<style>

.second-column
{
    padding-left: 30px;
}

.image-field
{
    border: 1px solid #c8c8d3;
    -moz-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    -webkit-box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);  
    padding: 10px;  
    cursor: pointer;
}

#clear-image
{
    width: 30px;
    height: 30px;
    background: darkgray;
    /* float: left; */
    position: relative;
    top: -152px;
    left: 120px;
    display: -webkit-inline-box;
    z-index: 100;
}
#clear-image span
{
    font-weight: bold;
    font-size: 12pt;
    color: white;
}


</style>
<input type="hidden" id="prevent-interruption" value="true" />
<input type="hidden" id="is_edit" value="<?php echo (isset($is_edit) ? 'true' : 'false') ?>" />
<input type="hidden" id="id_employee" value="<?php echo (isset($is_edit) ? $data_edit[0]['id_employee'] : '') ?>" />
<input type="hidden" id="id_employee_contract" value="<?php echo (isset($is_edit) ? $employee_contract[0]['id_employee_contract'] : '') ?>" />
<div class="document-action">
    <button id="po-validate">Validate</button>
    <button id="po-validate">Proceed Recruit</button>
    <ul class="document-status">
        <li <?php 
            if(isset($is_edit))
            {
                if($data_edit[0]['employee_status'] == 4)
                {
                    echo 'class="status-active"';
                }
            }
            else
            {
                echo 'class="status-active"';
            }
        ?> >
            <span class="label">Listed</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['employee_status'] == 1 ? 'class="status-active"' : '') ?>>
            <span class="label">Recruitment</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['employee_status'] == 2 ? 'class="status-active"' : '') ?>>
            <span class="label">Hired</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
        <li <?php echo (isset($is_edit) && $data_edit[0]['employee_status'] == 3 ? 'class="status-active"' : '') ?>>
            <span class="label">Resigned</span>
            <span class="arrow">
                <span></span>
            </span>
        </li>
    </ul>
</div>
<div id='form-container' style="font-size: 13px; font-family: Arial, Helvetica, Tahoma">
    <div class="form-center" style="padding: 30px;">
        <div>
            <table class="table-form">
                <tr>
                    <td rowspan="4">
                        <div>
                            <img class="image-field" style="width: 100px;" src="<?php echo base_url() . 'images/user-icon.png' ?>" alt="product-default"/>
                        </div>
                    </td>
                    <td class="label">
                        Employee Number
                    </td>
                    <td colspan="2">
                        <input style="display: inline; width: 83%" class="field" type="text" id="product-code" value="<?php echo (isset($is_edit) ? $data_edit[0]['employee_number'] : '') ?>" /><button style="margin-left: 2px;" id="auto-generate">></button>
                    </td>
                    <td>
                    
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Full Name
                    </td>
                    <td colspan="2">
                        <input style="display: inline;" class="field" type="text" id="fullname" value="<?php echo (isset($is_edit) ? $data_edit[0]['full_name'] : '') ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Employment Type
                    </td>
                    <td colspan="2">
                        <div id="select-employment-type"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Religion
                    </td>
                    <td colspan="2">
                        <div id="select-religion"></div>
                    </td>
                </tr>
                
                <!-- Unsplitted form-->
                <tr>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row-color">
                            <button id="add-address">+</button>
                            <button id="remove-address">-</button>
                            <span>Employee Address</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="address-grid"></div>
                    </td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td class="label">
                        Birth Date
                    </td>
                     <td>
                        <div id="select-birth-date"></div>
                    </td>
                     <td class="label second-column">
                        Birth Place
                    </td>
                     <td >
                        <div id="select-birth-place"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Gender
                    </td>
                     <td class="label">
                        <div id="select-gender"></div>
                    </td>
                     <td class="label second-column">
                        Blood Type
                    </td>
                     <td class="label">
                        <div id="select-blood"></div>
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Height
                    </td>
                     <td>
                        <input type="text" class="field" id="height" value="<?php echo (isset($is_edit) ? $data_edit[0]['height'] : '') ?>"/>
                    </td>
                     <td class="label second-column">
                        Weight
                    </td>
                     <td>
                        <input type="text" class="field" id="weight" value="<?php echo (isset($is_edit) ? $data_edit[0]['weight'] : '') ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">
                        Native
                    </td>
                     <td colspan="3">
                        <input type="text" class="field" style="width: 97%;" id="native" value="<?php echo (isset($is_edit) ? $data_edit[0]['native'] : '') ?>" />
                    </td>
                </tr>                
                <tr>
                    <td colspan="4">
                        <div class="row-color">
                            <button id="add-identification">+</button>
                            <button id="remove-identification">-</button>
                            <span>Employee Identification</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="identification-grid"></div>
                    </td>
                </tr>
            </table>
            <div id='employee-tabs' style="margin-top: 20px;">
                <ul>
                    <li style="margin-left: 30px;">Contract</li>
                    <li>Education & Course</li>
                    <li>Experience</li>
                    <li>Family</li>
                    <li>Emergency Contact</li>
                    <li>Transportation</li>
                    <li>Other Data</li>
                </ul>
                <div>
                    <?php echo $this->load->view('employee/employee_contract', null, true); ?>
                </div>
                <div>
                    <?php echo $this->load->view('employee/education_create', null, true); ?>
                </div>
                <div>
                    <?php echo $this->load->view('employee/experience_ce', null, true); ?>
                </div>
                <div>
                    <?php echo $this->load->view('employee/employee_family_ce', null, true); ?>
                </div>
                <div>
                     <?php echo $this->load->view('employee/emergency_contact_ce', null, true); ?>
                </div>
                <div>
                    <?php echo $this->load->view('employee/employee_transport_ce', null, true); ?>
                </div>
                <div>
					<?php echo $this->load->view('employee/employee_other', null, true); ?>
				</div>
            </div>
        </div>
    </div>
</div>
