<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?><script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script><script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script><script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script><link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" /><style>    .req { color:#FF0000; }	.wid { width:100%; }</style><div class="mainpanel">    <div class="media mt--20">        <h4>Department Edit </h4>    </div>    <div class="widgetcontent">        <?php        $result = validation_errors();        if (trim($result) != ""):            ?>            <div class="alert alert-error">                <button data-dismiss="alert" class="close" type="button">&times;</button>                <?php echo implode("</p>", array_unique(explode("</p>", validation_errors()))); ?>            </div>        <?php endif; ?>        <?php        $attributes = array('class' => 'stdform editprofileform', 'method' => 'post');        echo form_open('', $attributes);        ?>        <div class="contentpanel">            <div class="panel-body mt-top5">                <table  id="basicTable_call_back" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline">                    <thead>                        <tr>                            <th class="action-btn-align">S.No</th>                            <th class="action-btn-align">Department Name<span class='req'>*</span></th>                            <th class="action-btn-align">Head</th>                            <th class="action-btn-align">Status<span class='req'>*</span></th>                        </tr>                    </thead>                    <tbody id='result_div'>                        <tr>                            <td class="first_td action-btn-align">1</td>                            <td class="action-btn-align"><?php                                $data = array(                                    'name' => 'dept[name]',                                    'value' => isset($_POST['save']) ? $dept["name"] : $dept[0]["dep_name"],                                    'class' => 'required input-large wid',                                );                                echo form_input($data);                                ?> </td>                            <td class="action-btn-align">                                <?php                                $options = array('' => 'Select');                                if (isset($users) && !empty($users)) {                                    foreach ($users as $user) {                                        $options[$user["id"]] = $user["first_name"];                                    }                                }                                if (isset($_POST['save']))                                    $default = $dept["department_head"];                                else                                    $default = $dept[0]["department_head"];                                //print_r($dept);                                echo form_dropdown('dept[department_head]', $options, $default, 'class="required uniformselect input-small wid"')                                ?>                                <input type="hidden" name="department_id" id="department_id" value="<?php echo $department_id; ?>">                            </td>                            <td class="action-btn-align">                                <?php                                $enable = FALSE;                                $disable = FALSE;                                if (isset($_POST['save'])) {                                    if ($dept["status"] == 0) {                                        $disable = TRUE;                                    } else if ($dept["status"] == 1) {                                        $enable = TRUE;                                    }                                } else {                                    if ($dept[0]["status"] == 0) {                                        $disable = TRUE;                                    } else if ($dept[0]["status"] == 1) {                                        $enable = TRUE;                                    }                                }                                $data = array(                                    'name' => 'dept[status]',                                    'type' => 'radio',                                    'value' => '1',                                    'class' => 'required-radio',                                    'checked' => $enable                                );                                echo form_checkbox($data);                                ?> Enable &nbsp; &nbsp;                                <?php                                $data = array(                                    'name' => 'dept[status]',                                    'type' => 'radio',                                    'value' => '0',                                    'class' => 'required-radio',                                    'checked' => $disable                                );                                echo form_checkbox($data);                                ?> Disable &nbsp; &nbsp;                            </td>                        </tr>                    </tbody>                </table>                <div class="action-btn-align">                    <?php                    $data = array(                        'name' => 'save',                        'value' => 'Update',                        'class' => 'btn btn-info border4 submit',                        'title' => 'Update'                    );                    echo form_submit($data);                    ?>                    <a href="<?= $this->config->item('base_url') . "masters/biometric/departments/" ?>" title="Cancel"><input type="button" class="btn btn-danger border4" value="Cancel" /></a>                </div>            </div>        </div>    </div></div>