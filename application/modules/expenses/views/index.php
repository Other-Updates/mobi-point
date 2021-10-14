<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>

<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>

<link href="<?php echo $theme_path ?>/css/select2.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/css/fSelect.css" />

<script src="<?php echo $theme_path ?>/js/select2.min.js"></script>

<script type='text/javascript' src='<?php echo $theme_path; ?>/js/jquery.table2excel.min.js'></script>


<script type='text/javascript' src='<?= $theme_path; ?>/js/fSelect.js'></script>

<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js/sweetalert.css">

<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>

<style>
    .form-check,
    .form-radio {
        margin-top: 7px !important;
    }

    .input-group-addon .fa {
        width: 10px !important;
    }
</style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">New Expense Form
                </h4>
                <div class="tab-content tab-content-solid">
                    <form action="<?php echo $this->config->item('base_url'); ?>expenses/insert_expense" enctype="multipart/form-data" name="form" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group" style="display: none;">
                                    <label class="col-sm-12 col-form-label">Company <span style="color:#F00; ">*</span></label>
                                    <div class="col-sm-12">
                                        <select name="firm_id" class="form-control required" id="firm" tabindex="1">
                                            <!-- <option value="">Select</option> -->
                                            <?php
                                            if (isset($firms) && !empty($firms)) {
                                                foreach ($firms as $firm) {
                                            ?>
                                                    <option value="<?php echo $firm['firm_id']; ?>"> <?php echo $firm['firm_name']; ?> </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="company_amount" id="firm_amt" value="0">
                                        <span id="frim_name_err" class="val" style="color:#F00; "></span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Expense amount<span style="color:#F00; ">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" name="amount" class=" form-control dot_val" id="ex_amt" tabindex="5" />
                                            <div class="input-group-addon">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div>
                                        <span id="ex_amt_err" class="error_msg val" style="color:#F00; "></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label ">Expense Type<span style="color:#F00;">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="form-radio">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input " value="fixed" tabindex="6" name="type" checked="">
                                                Fixed
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-radio">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input " value="variable" tabindex="6" name="type">
                                                Variable
                                            </label>
                                        </div>
                                    </div>
                                    <span id="type_err" class="val"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Expense Category<span style="color:#F00; ">*</span></label>
                                    <div class="col-sm-12">
                                        <select name="cat_id" class="form-control required" id="ex_category" tabindex="2">
                                            <option value="">Select</option>
                                            <?php
                                            if (isset($category_list) && !empty($category_list)) {
                                                foreach ($category_list as $cat_list) {
                                            ?>
                                                    <option value="<?php echo $cat_list['id']; ?>" <?php echo ($cat_list['id'] == $get_category[0]['category_id']) ? 'selected' : ''; ?>> <?php echo $cat_list['category']; ?> </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span id="cat_err" class="val" style="color:#F00; "></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label ">Expense Mode<span style="color:#F00;">*</span></label>
                                    <div class="col-sm-6">
                                        <div class="form-radio">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input " value="credit" name="mode" tabindex="7">
                                                Credit
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-radio">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input " value="debit" name="mode" tabindex="7" checked="">
                                                Debit
                                            </label>
                                        </div>
                                    </div>
                                    <span id="mode_err" class="val"></span>
                                </div>


                            </div>
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="col-sm-12 col-form-label">Expense Sub Category<span style="color:#F00;">*</span></label>
                                    <div class="col-sm-12">
                                        <select name="sub_cat_id" class="form-control required" id="ex_subcat" tabindex="3">
                                            <option value="">Select</option>
                                            <?php
                                            if (isset($sub_category_list) && !empty($sub_category_list)) {
                                                foreach ($sub_category_list as $sub_cat_list) {
                                            ?>
                                                    <option value="<?php echo $sub_cat_list['id']; ?>" <?php echo ($sub_cat_list['id'] == $get_category[0]['category_id']) ? 'selected' : ''; ?>> <?php echo $sub_cat_list['sub_category']; ?> </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <span id="subcat_err" class="val" style="color:#F00; "></span>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-12 col-form-label">Remarks</label>
                                    <div class="col-sm-12">
                                        <input name="remarks" type="text" class="form-control remark" value="" />
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Entry Date<span style="color:#F00; ">*</span></label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" name="created_at" value="<?php echo date('d-m-Y'); ?>" class="datepicker form-control" id="entry_date" style="background-color:white;" tabindex="4" />
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <span id="entrydate_err" class="val" style="color:#F00; "></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="frameset_table action-btn-align">
                            <input type="submit" name="submit" class="btn btn-success btn-fw" value="Save" id="submit" tabindex="8">
                            <input type="reset" value="Clear" class=" btn btn-danger btn-fw" id="reset">
                            <td><a href="<?php echo $this->config->item('base_url') . 'expenses/expenses_list' ?>" class="btn btn-dark btn-fw">&nbsp;Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- <link rel="stylesheet" href="<?php echo $theme_path ?>/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" /> -->
<!-- <script src="<?php echo $theme_path ?>/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<script>
    // $('.datepicker').datepicker({
    //     format: 'dd-mm-yyyy',
    //     endDate: "today",
    // });

    $(document).ready(function() {
        // category change
        $('#ex_category').change(function() {
            var category_id = $(this).val();
            $.ajax({
                url: BASE_URL + "expenses/get_subcategory",
                method: 'post',
                data: {
                    category_id: category_id
                },
                dataType: 'json',
                success: function(response) {
                    // Remove options
                    // $('#ex_subcat').find('option').not(':first').remove();
                    // Add options
                    $.each(response, function(index, data) {
                        $('#ex_subcat').append('<option value="' + data['id'] + '">' + data['sub_category'] + '</option>');
                    });
                }
            });
        });
    });
    $('#firm').change(function() {
        var firm_id = $(this).val();
        $('#ex_amt').val('');
        $.ajax({
            url: BASE_URL + "expenses/get_company_amount",
            method: 'post',
            data: {
                firm_id: firm_id
            },
            dataType: 'json',
            success: function(result) {
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
    //        var firm = $("#firm").val();
    //        this_val = $.trim($(this).val());
    //        if (this_val != '' && (type == '2') && firm != '') {
    //            if (parseInt(this_val) <= parseInt(company_amt)) {
    //                $(".error_msg").text("");
    //            } else {
    //                $(".error_msg").text('This field is more than the Company amount').css('display', 'inline-block');
    //            }
    //        }
    //    });

    $("#firm").on('blur', function() {
        var firm = $("#firm").val();
        if (firm == "" || firm == null || firm.trim().length == 0) {
            $("#frim_name_err").text("This field is required");
        } else {
            $("#frim_name_err").text("");
        }
    });
    $("#ex_category").on('blur', function() {
        var category = $("#ex_category").val();
        if (category == "" || category == null || category.trim().length == 0) {
            $("#cat_err").text("This field is required");
        } else {
            $("#cat_err").text("");
        }
    });
    $("#ex_subcat").on('blur', function() {
        var sub_category = $("#ex_subcat").val();
        if (sub_category == "" || sub_category == null || sub_category.trim().length == 0) {
            $("#subcat_err").text("This field is required");
        } else {
            $("#subcat_err").text("");
        }
    });
    $("#ex_amt").on('blur', function() {
        var ex_amt = $("#ex_amt").val();
        if (ex_amt == "" || ex_amt == null || ex_amt.trim().length == 0) {
            $("#ex_amt_err").text("This field is required");
        } else {
            $("#ex_amt_err").text("");
        }
    });
    $("#entry_date").datepicker({

        format: 'dd-mm-yyyy',

        autoclose: true,

    }).on('changeDate', function(selected) {

        var startDate = new Date(selected.date.valueOf());

        $('#to_date').datepicker('setStartDate', startDate);

    }).on('clearDate', function(selected) {

        $('#to_date').datepicker('setStartDate', null);

    });



    $('#submit').on('click', function() {
        var i = 0;
        // var firm = $("#firm").val();
        // if (firm == "" || firm == null || firm.trim().length == 0) {
        //     $("#frim_name_err").text("This field is required");
        //     i = 1;

        // } else {
        //     $("#frim_name_err").text("");
        // }
        var category = $("#ex_category").val();
        if (category == "" || category == null || category.trim().length == 0) {
            $("#cat_err").text("This field is required");
            i = 1;
            // console.log('cat');

        } else {
            $("#cat_err").text("");
        }
        var sub_category = $("#ex_subcat").val();
        if (sub_category == "" || sub_category == null || sub_category.trim().length == 0) {
            $("#subcat_err").text("This field is required");
            i = 1;
            // console.log('sub');
        } else {
            $("#subcat_err").text("");
        }
        var ex_amt = $("#ex_amt").val();
        if (ex_amt == "" || ex_amt == null || ex_amt.trim().length == 0) {
            $("#ex_amt_err").text("This field is required");
            i = 1;
            // console.log('amt');
        } else {
            $("#ex_amt_err").text("");
        }

        //        var company_amt = $('#firm_amt').val();
        //
        //        var type = "";
        //        var selected = $("input[type='radio'][name='type']:checked");
        //        if (selected.length > 0) {
        //            type = selected.val();
        //        }
        //        this_val = $.trim($('#ex_amt').val());
        //        if (this_val != '' && (type == '2') && firm != '') {
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