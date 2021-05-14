<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?><script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script><script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script><script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script><link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" /><script type="text/javascript" src="<?= $theme_path; ?>/js/department.js"></script><style>    .req { color:#FF0000; }    .wid { width:100%; }</style><div class="mainpanel">    <div class="media mt--20">        <h4>Department Add </h4>    </div>    <div class="widgetcontent">        <?php        $result = validation_errors();        $my_array = array();        $errors = explode("</p>", $result);        if (isset($errors) && !empty($errors)) {            $my_array = array_filter(array_unique(array_map('trim', $errors)));            // print_r($my_array);        }        if (trim($result) != ""):            ?>            <div class="alert alert-error">                <button data-dismiss="alert" class="close" type="button">&times;</button>                <?php echo implode("</p>", $my_array); ?>            </div>        <?php endif; ?>        <?php        //echo "<pre>";        //print_r($post);        $attributes = array('class' => 'stdform editprofileform', 'method' => 'post');        echo form_open('', $attributes);        ?>        <div class="contentpanel">            <div class="panel-body mt-top5">                <table  id="basicTable_call_back" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline">                    <thead>                        <tr>                            <th class="action-btn-align">S.No</th>                            <th class="action-btn-align">Department Name<span class='req'>*</span></th>                            <th class="action-btn-align">Head</th>                            <th class="action-btn-align">Status<span class='req'>*</span></th>                            <th><a href="javascript:void(0);" class="btn btn-danger add_row"><i class="fa fa-plus"></i></a></th>                        </tr>                    </thead>                    <tbody id='result_div'>                        <?php                        if (!isset($dept_length))                            $dept_length = 1;                        for ($i = 0; $i < $dept_length; $i++) {                            ?>                            <tr>                                <td class="first_td action-btn-align">1</td>                                <td class=""><?php                                    $data = array(                                        'name' => 'dept[name][]',                                        'value' => isset($_POST['save']) ? $post["name"][$i] : '',                                        'class' => 'required wid',                                    );                                    echo form_input($data);                                    ?> </td>                                <td class="action-btn-align">                                    <?php                                    $options = array('' => 'Select');                                    if (isset($users) && !empty($users)) {                                        foreach ($users as $user) {                                            $options[$user["id"]] = ucwords($user["first_name"]);                                        }                                    }                                    if (isset($_POST['save']))                                        $default = $post["department_head"][$i];                                    else                                        $default = '';                                    echo form_dropdown('dept[department_head][]', $options, $default, 'class="required uniformselect wid"')                                    ?>                                </td>                                <td class="action-btn-align">                                    <?php                                    $enable = FALSE;                                    $disable = FALSE;                                    if (isset($_POST['save'])) {                                        if (isset($post["status"][$i])) {                                            if ($post["status"][$i] == "") {                                                $enable = FALSE;                                                $disable = FALSE;                                            } elseif ($post["status"][$i] == 0) {                                                $disable = TRUE;                                            } else if ($post["status"][$i] == 1) {                                                $enable = TRUE;                                            }                                        }                                    }                                    $data = array(                                        'name' => 'dept[status][' . $i . ']',                                        'type' => 'radio',                                        'value' => '1',                                        'class' => 'required-radio status',                                        'checked' => $enable                                    );                                    echo form_checkbox($data);                                    ?> Enable &nbsp; &nbsp;                                    <?php                                    $data = array(                                        'name' => 'dept[status][' . $i . ']',                                        'type' => 'radio',                                        'value' => '0',                                        'class' => 'required-radio status',                                        'checked' => $disable                                    );                                    echo form_checkbox($data);                                    ?> Disable &nbsp; &nbsp;                                </td>                                <?php                                if ($i == 0)                                    $style = "visibility:hidden;";                                else                                    $style = "visibility:visible;";                                ?>                                <td class="action-btn-align"><a href="javascript:void(0);" class="btn btn-danger remove_row" style="<?php echo $style; ?>"><i class="fa fa-minus fa-black"></i></a></td>                            </tr>                        <?php } ?>                    </tbody>                </table>                <div class="action-btn-align">                    <?php                    $data = array(                        'name' => 'save',                        'value' => 'Save',                        'class' => 'btn btn-success border4 submit',                        'title' => 'Save'                    );                    echo form_submit($data);                    ?>                    <a href="<?= $this->config->item('base_url') . "masters/biometric/departments/" ?>" title="Cancel"><input type="button" class="btn btn-danger border4" value="Cancel" /></a>                </div>            </div>        </div>    </div></div><script>    $(".remove_row").live('click', function () {        $(this).closest("tr").remove();        tr = $("tbody").children("tr");        $(tr).each(function (i) {            $(this).find("td.sno").text(i + 1);        });    });</script>