<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<link rel="stylesheet" href="<?php echo $theme_path ?>/node_modules/pwstabs/assets/jquery.pwstabs.min.css">
<script src="<?php echo $theme_path ?>/node_modules/pwstabs/assets/jquery.pwstabs.min.js"></script>
<script src="<?php echo $theme_path ?>/js/tabs.js"></script>
<link href="<?php echo $theme_path ?>/css/select2.css" rel="stylesheet" />
<script src="<?php echo $theme_path ?>/js/select2.min.js"></script>
<style>
 .form-check, .form-radio {
        margin-top: 7px !important;
    }
    .input-group-addon .fa { width:10px !important; }
</style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Expenses</h4>
                <div class="tabs">
                    <div class="">
                        <div id="update-field">
                            <form action="<?php echo $this->config->item('base_url') . 'expenses/update_expenses/' . $expense_edit[0]['id']; ?>" enctype="multipart/form-data" name="form" method="post">
                                <?php
                                if (isset($expense_edit) && !empty($expense_edit)) {
                                    $i = 0;
                                    foreach ($expense_edit as $val) {
                                        $i++
                                        ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-sm-12 col-form-label">Company <span style="color:#F00; ">*</span></label>
                                                    <div class="col-sm-12">
                                                        <select  name="firm_id"  class="form-control form-align" id="firm" tabindex="1">
                                                            <?php
                                                            if (isset($firms) && !empty($firms)) {
                                                                foreach ($firms as $firm) {
                                                                    $select = ($firm['firm_id'] == $val['firm_id']) ? 'selected' : '';
                                                                    ?>
                                                                    <option value="<?php echo $firm['firm_id']; ?>" <?php echo $select; ?>> <?php echo $firm['prefix']; ?> </option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <input type="hidden" name="company_amount" id="firm_amt" value="<?php echo $val['company_amount']; ?>" >
                                                        <span id="frim_name_err" class="val"  style="color:#F00; "></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-12 col-form-label">Expense amount<span style="color:#F00; ">*</span></label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <input type="text" name="amount" class=" form-control dot_val" id="ex_amt" value="<?php echo $val['amount']; ?>" tabindex="5"/>
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-money"></i>
                                                            </div>
                                                        </div>
                                                        <span id="ex_amt_err" class="error_msg val"  style="color:#F00; "></span>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-sm-12 col-form-label">Expense Category<span style="color:#F00; ">*</span></label>
                                                    <div class="col-sm-12">
                                                        <select name="cat_id"  class="form-control required" id="ex_category" tabindex="2">
                                                            <option value="">Select</option>
                                                            <?php
                                                            if (isset($category_list) && !empty($category_list)) {
                                                                foreach ($category_list as $cat_list) {
                                                                    $select = ($cat_list['id'] == $val['cat_id']) ? 'selected' : '';
                                                                    ?>
                                                                    <option value="<?php echo $cat_list['id']; ?>" <?php echo $select; ?>> <?php echo $cat_list['category']; ?> </option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <span id="cat_err" class="val"  style="color:#F00; "></span>
                                                    </div>
                                                </div>
												


                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label ">Expense Type<span style="color:#F00;">*</span></label>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input ex_mode" value="fixed"  <?php echo ($val['type'] == 'fixed') ? 'checked' : '' ?> name="type" tabindex="6"/>Fixed
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio"  class="form-check-input ex_mode" value="variable" <?php echo ($val['type'] == 'variable') ? 'checked' : '' ?> name="type" tabindex="6"/> Variable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <span id="type1" class="val"></span>
                                                </div>


                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group ">
                                                    <label class="col-sm-12 col-form-label">Expense Sub Category<span style="color:#F00;">*</span></label>
                                                    <div class="col-sm-12">
                                                        <select name="sub_cat_id"  class="form-control required" id="ex_subcat" tabindex="3">
                                                            <option value="">Select</option>

                                                            <?php
                                                            if (isset($sub_category_list) && !empty($sub_category_list)) {
                                                                foreach ($sub_category_list as $sub_cat_list) {
                                                                    $select = ($sub_cat_list['id'] == $val['sub_cat_id']) ? 'selected' : '';
                                                                    ?>
                                                                    <option value="<?php echo $sub_cat_list['id']; ?>" <?php echo $select; ?>> <?php echo $sub_cat_list['sub_category']; ?> </option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <span id="subcat_err" class="val" style="color:#F00; "></span>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-form-label ">Expense Mode<span style="color:#F00;">*</span></label>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input ex_type" value="credit"<?php echo ($val['mode'] == "credit") ? 'checked' : ''; ?> name="mode" tabindex="7" checked="">
                                                                Credit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input ex_type" value="debit" <?php echo ($val['mode'] == "debit") ? 'checked' : ''; ?> name="mode" tabindex="7" checked="">
                                                                Debit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <span id="mode_err" class="val"></span>
                                                </div>


                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-sm-12 col-form-label">Entry Date<span style="color:#F00; ">*</span></label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <input type="text" name="created_at" value="<?php echo date("d-m-Y", strtotime($val['created_at'])); ?>" class="datepicker form-control" id="entry_date" readonly="" style="background-color:white;" tabindex="4" />
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <span id="entrydate_err" class="val"  style="color:#F00; "></span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-sm-12 col-form-label">Remarks</label>
                                                    <div class="col-sm-12">
                                                        <input name="remarks" type="text" class="form-control remark" value="<?php echo $val['remarks']; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <div class="frameset_table action-btn-align">
                                    <input type="submit" name="submit" class="btn btn-success btn-fw" value="Update" id="submit" tabindex="8">
                                    <input type="reset" value="Clear" class="btn btn-danger btn-fw" id="reset" tabindex="9" >
                                    <a href="<?php echo $this->config->item('base_url') . 'expenses/expenses_list/' ?>" class="btn btn-dark btn-fw">&nbsp;Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $('#reset').on('click', function () {
        $('.val').html("");
        $('#dup').html("");
    });
    $('#firm').change(function () {
        var firm_id = $(this).val();
        $('#ex_amt').val('');
        $.ajax({
            url: BASE_URL + "expenses/get_company_amount",
            method: 'post',
            data: {firm_id: firm_id},
            dataType: 'json',
            success: function (result) {
                if (result[0].company_amount != null && result[0].company_amount > 0) {
                    $("#firm_amt").val(result[0].company_amount);
                } else {
                    $("#firm_amt").val('0');
                }
            }
        });
    });
//    $(document).on('keyup', '#ex_amt', function () {
//        var company_amt = $('#firm_amt').val();
//        var type = "";
//        var selected = $("input[type='radio'][name='type']:checked");
//        if (selected.length > 0) {
//            type = selected.val();
//        }
//        this_val = $.trim($(this).val());
//        if (this_val != '' && (type == '2')) {
//            if (parseInt(this_val) <= parseInt(company_amt)) {
//                $(".error_msg").text("");
//            } else {
//                $(".error_msg").text('This field is more than the Company amount').css('display', 'inline-block');
//            }
//        }
//    });
    $(document).ready(function () {
        // category change
        $('#ex_category').change(function () {
            var category_id = $(this).val();
            $.ajax({
                url: BASE_URL + "expenses/get_subcategory",
                method: 'post',
                data: {category_id: category_id},
                dataType: 'json',
                success: function (response) {
                    // Remove options
                    $('#ex_subcat').find('option').not(':first').remove();
                    // Add options
                    $.each(response, function (index, data) {
                        $('#ex_subcat').append('<option value="' + data['id'] + '">' + data['sub_category'] + '</option>');
                    });
                }
            });
        });
    });

    $("#firm").on('blur', function ()
    {
        var firm = $("#firm").val();
        if (firm == "" || firm == null || firm.trim().length == 0)
        {
            $("#frim_name_err").text("This field is required");
        } else
        {
            $("#frim_name_err").text("");
        }
    });
    $("#ex_category").on('blur', function ()
    {
        var category = $("#ex_category").val();
        if (category == "" || category == null || category.trim().length == 0)
        {
            $("#cat_err").text("This field is required");
        } else
        {
            $("#cat_err").text("");
        }
    });
    $("#ex_subcat").on('blur', function ()
    {
        var sub_category = $("#ex_subcat").val();
        if (sub_category == "" || sub_category == null || sub_category.trim().length == 0)
        {
            $("#subcat_err").text("This field is required");
        } else
        {
            $("#subcat_err").text("");
        }
    });
    $("#ex_amt").on('blur', function ()
    {
        var ex_amt = $("#ex_amt").val();
        if (ex_amt == "" || ex_amt == null || ex_amt.trim().length == 0)
        {
            $("#ex_amt_err").text("This field is required");
        } else
        {
            $("#ex_amt_err").text("");
        }
    });
    $('#submit').on('click', function () {
        var i = 0;
        var firm = $("#firm").val();
        if (firm == "" || firm == null || firm.trim().length == 0)
        {
            $("#frim_name_err").text("This field is required");
            i = 1;
        } else
        {
            $("#frim_name_err").text("");
        }
        var category = $("#ex_category").val();
        if (category == "" || category == null || category.trim().length == 0)
        {
            $("#cat_err").text("This field is required");
            i = 1;
        } else
        {
            $("#cat_err").text("");
        }
        var sub_category = $("#ex_subcat").val();
        if (sub_category == "" || sub_category == null || sub_category.trim().length == 0)
        {
            $("#subcat_err").text("This field is required");
            i = 1;
        } else
        {
            $("#subcat_err").text("");
        }
        var ex_amt = $("#ex_amt").val();
        if (ex_amt == "" || ex_amt == null || ex_amt.trim().length == 0)
        {
            $("#ex_amt_err").text("This field is required");
            i = 1;
        } else
        {
            $("#ex_amt_err").text("");
        }

//        var company_amt = $('#firm_amt').val();
//        var type = "";
//        var selected = $("input[type='radio'][name='type']:checked");
//        if (selected.length > 0) {
//            type = selected.val();
//        }
//        this_val = $.trim($('#ex_amt').val());
//        if (this_val != '' && (type == '2')) {
//            if (parseInt(this_val) <= parseInt(company_amt)) {
//                $(".error_msg").text("");
//            } else {
//                $(".error_msg").text('This field is more than the Company amount').css('display', 'inline-block');
//                i = 1;
//            }
//        }

        if (i == 1) {
            return false;
        } else {
            return true;
        }

    });

</script>
<link rel="stylesheet" href="<?php echo $theme_path ?>/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
<script src="<?php echo $theme_path ?>/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        endDate: "today",
    });
</script>
