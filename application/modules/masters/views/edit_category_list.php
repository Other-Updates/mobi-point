<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<link rel="stylesheet" href="<?php echo $theme_path ?>/node_modules/pwstabs/assets/jquery.pwstabs.min.css">
<script src="<?php echo $theme_path ?>/node_modules/pwstabs/assets/jquery.pwstabs.min.js"></script>
<script src="<?php echo $theme_path ?>/js/tabs.js"></script>
<link href="<?php echo $theme_path ?>/css/select2.css" rel="stylesheet" />
<script src="<?php echo $theme_path ?>/js/select2.min.js"></script>
<style>
    .input-group-addon .fa {
        width: 10px !important;
    }
</style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Expense Category
                </h4>
                <div class="tabs">
                    <div class="">
                        <div id="update-field">
                            <form action="<?php echo $this->config->item('base_url') . 'masters/manage_category/update_category/' . $get_category[0]['id']; ?>" enctype="multipart/form-data" name="form" method="post">
                                <?php
                                if (isset($get_category) && !empty($get_category)) {
                                    $i = 0;
                                    foreach ($get_category as $val) {
                                        $i++
                                ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="col-sm-12 col-form-label">Type <span style="color:#F00; ">*</span></label>
                                                    <div class="col-sm-12">
                                                        <select name="comments" class="form-control required" id="comments" tabindex="1">
                                                            <option value="">Select</option>
                                                            <option value="1" <?php echo ($val['comments'] == 1) ? 'selected="selected"' : ''; ?>>Sales</option>
                                                            <option value="2" <?php echo ($val['comments'] == 2) ? 'selected="selected"' : ''; ?>>Purchase</option>
                                                            <option value="3" <?php echo ($val['comments'] == 3) ? 'selected="selected"' : ''; ?>>Others</option>
                                                        </select>
                                                        <span id="comments_err" class="val" style="color:#F00; "></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="col-sm-12 col-form-label">Category<span style="color:#F00; ">*</span></label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <input type="text" name="category" class="form-control" id="category_edit" value="<?php echo $val['category']; ?>" tabindex="2" />
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-fw fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <span id="category_err" class="val" style="color:#F00; font-size: 14px;"></span>
                                                        <span id="duplicatecategory" class="duplicatecategory" style="color:#F00;font-size: 14px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" class="id form-control id_update" id="category_id" value="<?php echo $val['id']; ?>" />
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <div class="frameset_table action-btn-align">
                                    <input type="submit" name="submit" class="btn btn-success btn-fw" value="Update" id="submit" tabindex="3">
                                    <input type="reset" value=" Clear" class="btn btn-danger btn-fw" id="reset" tabindex="4">
                                    <a href="<?php echo $this->config->item('base_url') . 'masters/manage_category/' ?>" class="btn btn-dark btn-fw">&nbsp;Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var language_json = <?php echo json_encode($language); ?>;
    var language = language_json;
    $('#reset').on('click', function() {
        $('.val').html("");
        $('#duplicatecategory').html("");
    });
    $("#category_edit").on('blur', function() {
        var category_edit = $("#category_edit").val();
        if (category_edit == "" || category_edit == null || category_edit.trim().length == 0) {
            $("#category_err").html(language["required_field"]);
        } else {
            $("#category_err").html("");
        }
    });

    $('#comments').on('blur', function() {
        var comments = $('#comments').val();
        if (comments == '' || comments == null || comments.trim().length == 0) {
            $('#comments_err').html(language["required_field"]);
        } else {
            $('#comments_err').html(" ");
        }
    });

    $('#category_edit').on('blur', function() {
        var cat_name = $.trim($('#category_edit').val());
        var id = $('#category_id').val();
        var comments = $.trim($("#comments").val());
        if ((cat_name) != '') {

            $.ajax({
                url: BASE_URL + "masters/manage_category/update_duplicate_category",
                type: 'get',
                async: false,
                data: {
                    value1: cat_name,
                    value2: id,
                    comments: comments
                },
                success: function(result) {
                    $('#duplicatecategory').html(result);
                }
            });
        } else {
            $('#duplicatecategory').html('');
        }
    });
    $('#submit').on('click', function() {
        var cat_name = $.trim($('#category_edit').val());
        var id = $('#category_id').val();
        var comments = $('#comments').val();
        if (cat_name != '') {

            $.ajax({
                url: BASE_URL + "masters/manage_category/update_duplicate_category",
                type: 'get',
                async: false,
                data: {
                    value1: cat_name,
                    value2: id,
                    comments: comments
                },
                success: function(result) {
                    $('#duplicatecategory').html(result);
                }
            });
        } else {
            $('#duplicatecategory').html('');
        }
        var i = 0;
        if (comments == '' || comments == null || comments.trim().length == 0) {

            $('#comments_err').html(language["required_field"]);
            i = 1;
            console.log(3);
        } else {

            $('#comments_err').html(" ");
        }

        var category_edit = $("#category_edit").val();
        if (category_edit == "" || category_edit == null || category_edit.trim().length == 0) {

            $("#category_err").html(language["required_field"]);
            i = 1;
            console.log(2);
        } else {
            $("#category_err").html("");
        }
        var m = $('#duplicatecategory').html();
        if ((m.trim()).length > 0) {
            i = 1;
            console.log(1);
        }
        if (i == 1) {
            return false;
        } else {
            return true;
        }

    });
</script>