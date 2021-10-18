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
                <h4 class="card-title">Update Sub Category </h4>
                <div class="tabs">
                    <div class="">
                        <div id="update-field">
                            <form action="<?php echo $this->config->item('base_url') . 'masters/manage_sub_category/update_subcategory/' . $get_category[0]['id']; ?>" enctype="multipart/form-data" name="form" method="post">
                                <?php
                                if (isset($get_category) && !empty($get_category)) {
                                    $i = 0;
                                    foreach ($get_category as $val) {
                                        $i++
                                ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="col-sm-12 col-form-label"><?php echo $language['category']; ?> <span style="color:#F00; ">*</span></label>
                                                    <div class="col-sm-12">
                                                        <select name="category" class="form-control required" id="category_edit">
                                                            <option value=""><?php echo $language['select']; ?></option>
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
                                                        <span id="category_err" class="val" style="color:#F00; "></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-12 col-form-label">Sub Category<span style="color:#F00;">*</span></label>
                                                    <div class="col-sm-12">
                                                        <div class="input-group">
                                                            <input type="text" name="sub_category" class=" borderra0 form-control" value="<?php echo $val['sub_category']; ?>" id="subcategory_edit" />
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <span id="sub_cat_err" class="val" style="color:#F00; font-size:14px;"></span>
                                                        <span id="dup" class="dup" style="color:#F00; font-size:14px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="subcategory_id" name="id" value="<?php echo $get_category[0]['id']; ?>">
                                <?php
                                    }
                                }
                                ?>
                                <div class="frameset_table action-btn-align">
                                    <input type="submit" name="submit" class="btn btn-success btn-fw" value=" Update" id="submit" tabindex="1">
                                    <input type="reset" value="Clear" class="btn btn-danger btn-fw" id="reset" tabindex="1">
                                    <a href="<?php echo $this->config->item('base_url') . 'masters/manage_sub_category/' ?>" class="btn btn-dark btn-fw"> &nbsp;Back</a>
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
    var language_json = <?php echo json_encode($language); ?>;
    var language = language_json;
    $('#subcategory_edit').on('blur', function() {

        var sub_category = $('#subcategory_edit').val();
        if (sub_category == '' || sub_category == null || sub_category.trim().length == 0) {
            $('#sub_cat_err').html(language["required_field"]);
        } else {
            $('#sub_cat_err').html(" ");
        }
    });

    $("#category_edit").on('blur', function() {
        var category = $("#category_edit").val();
        if (category == "" || category == null || category.trim().length == 0) {
            $("#category_err").text(language["required_field"]);
        } else {
            $("#category_err").text("");
        }
    });
    $('#subcategory_edit').on('blur', function() {
        var subcat_name = $.trim($('#subcategory_edit').val());
        var id = $('#subcategory_id').val();
        var cat_id = $('#category_edit').val();
        if ($.trim(subcat_name) != '') {
            $.ajax({
                url: BASE_URL + "masters/manage_sub_category/update_duplicate_subcategory",
                type: 'POST',
                async: false,
                data: {
                    sub_category: subcat_name,
                    id: id,
                    category_id: cat_id
                },
                success: function(result) {
                    $("#dup").html(result);
                }
            });
        } else {
            $("#dup").html('');
        }
    });
    $('#submit').on('click', function() {

        var subcat_name = $.trim($('#subcategory_edit').val());
        var id = $('#subcategory_id').val();
        var cat_id = $('#category_edit').val();
        if ($.trim(subcat_name) != '') {

            $.ajax({
                url: BASE_URL + "masters/manage_sub_category/update_duplicate_subcategory",
                type: 'POST',
                async: false,
                data: {
                    sub_category: subcat_name,
                    id: id,
                    category_id: cat_id
                },
                success: function(result) {
                    $("#dup").html(result);
                }
            });
        } else {
            $("#dup").html('');
        }


        var i = 0;

        var sub_category = $('#subcategory_edit').val();
        if (sub_category == '' || sub_category == null || sub_category.trim().length == 0) {
            $('#sub_cat_err').html(language["required_field"]);
            i = 1;
        } else {
            $('#sub_cat_err').html(" ");
        }

        var category = $("#category_edit").val();
        if (category == "" || category == null || category.trim().length == 0) {
            $("#category_err").text(language["required_field"]);
            i = 1;
        } else {
            $("#category_err").text("");
        }

        var m = $('#dup').html();
        if ((m.trim()).length > 0) {
            i = 1;
        }
        if (i == 1) {
            return false;
        } else {
            return true;

        }
    });
    $('#cancel').on('click', function() {
        $('.val').html("");
        $('#dup').html("");
    });
</script>