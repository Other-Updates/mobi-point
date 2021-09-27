<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<!-- <link rel="stylesheet" href="<?php echo $theme_path ?>/node_modules/pwstabs/assets/jquery.pwstabs.min.css"> -->
<!-- <script src="<?php echo $theme_path ?>/node_modules/pwstabs/assets/jquery.pwstabs.min.js"></script> -->
<!-- <script src="<?php echo $theme_path ?>/js/tabs.js"></script> -->
<!-- <script src="<?php echo $theme_path; ?>/node_modules/datatables.net/js/jquery.dataTables.js"></script> -->
<!-- <script src="<?php echo $theme_path; ?>/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script> -->
<!-- <link rel="stylesheet" href="<?php echo $theme_path; ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" /> -->
<link href="<?php echo $theme_path ?>/css/select2.css" rel="stylesheet" />
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/css/fixedHeader.dataTables.min.css" /> -->
<!-- <script src="<?php echo $theme_path ?>/js/select2.min.js"></script> -->
<!-- <script type='text/javascript' src='<?php echo $theme_path; ?>/js/fixedheader/dataTables.fixedHeader.min.js'></script> -->
<!-- <link rel="stylesheet" href="<?php echo $theme_path ?>/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" /> -->
<!-- <script src="<?php echo $theme_path ?>/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js/sweetalert.css">
<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Expense Sub Category Details</h4>
                <ul class="nav nav-tabs tab-solid  tab-solid-primary" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-6-1" href="#sub_category-details" aria-controls="home-6-1" role="tab" data-toggle="tab" aria-selected="true"><i class="mdi mdi-table-large"></i>Expense SubCategory List</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-6-2" data-toggle="tab" href="<?php if ($this->user_auth->is_action_allowed('masters', 'manage_sub_category', 'add')) : ?>#sub_category<?php endif ?>" aria-controls="profile-6-2" role="tab" aria-selected="false" class="nav-link <?php if (!$this->user_auth->is_action_allowed('masters', 'manage_sub_category ', 'add')) : ?>alerts<?php endif ?>"><i class="mdi mdi-account-plus"></i><?php echo $language['add_new'] ?></a>
                    </li>
                </ul>
                <div class="tab-content tab-content-solid">
                    <div role="tabpanel" aria-labelledby="tab-6-1" class="tab-pane fade show active" id="sub_category-details">
                        <div class="table-responsive">
                            <table id="basicTable" class="table-striped table responsive dataTable no-footer dtr-inline">
                                <thead>
                                    <tr>
                                        <th><?php echo $language['s_no'] ?></th>
                                        <th><?php echo $language['category'] ?></th>
                                        <th><?php echo $language['sub_category'] ?></th>
                                        <th class="action-btn-align">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($all_list) && !empty($all_list)) {
                                        $i = 1;
                                        foreach ($all_list as $list) {
                                    ?>
                                            <tr class="subcat<?php echo $list['id']; ?>">
                                                <td class="first_td"><?php echo $i; ?></td>
                                                <td><?php echo ucfirst($list['category']); ?></td>
                                                <td><?php echo ucfirst($list['sub_category']); ?></td>
                                                <td class="action-btn-align">
                                                    <a href="<?php if ($this->user_auth->is_action_allowed('masters', 'manage_sub_category', 'edit')) : ?><?php echo $this->config->item('base_url') . 'masters/manage_sub_category/edit/' . $list['id'] ?><?php endif ?>" class="tooltips btn btn-info btn-fw btn-xs <?php if (!$this->user_auth->is_action_allowed('masters', 'manage_category', 'edit')) : ?>alerts<?php endif ?>" title="<?php echo $language['edit'] ?>">
                                                        <span class="fa fa-edit"></span></a>&nbsp;&nbsp;
                                                    <!--<a href="<?php if ($this->user_auth->is_action_allowed('masters', 'manage_sub_category', 'delete')) : ?>#test3_<?php echo $list['id']; ?><?php endif ?>" data-toggle="modal" name="delete" class="tooltips btn btn-danger btn-fw btn-xs <?php if (!$this->user_auth->is_action_allowed('masters', 'manage_category', 'delete')) : ?>alerts<?php endif ?>" title="<?php echo $language['delete'] ?>">
                                                        <span class="icon-trash"></span></a>-->
                                                    <a name="delete" class="tooltips btn btn-danger btn-fw btn-xs <?php
                                                                                                                    if (!$this->user_auth->is_action_allowed('masters', 'manage_category', 'delete')) {
                                                                                                                        echo "alerts";
                                                                                                                    } else {
                                                                                                                        echo "delete_row";
                                                                                                                    }
                                                                                                                    ?>" delete_id="<?php echo $list['id']; ?>" title="<?php echo $language['delete'] ?>">
                                                        <span class="icon-trash"></span></a>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4"><?php echo $language['no_data_available'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div role="tabpanel" aria-labelledby="tab-6-2" class="tab-pane fade" id="sub_category">
                        <form action="<?php echo $this->config->item('base_url'); ?>masters/manage_sub_category/insert_sub_category " name="form" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label"><?php echo $language['category']; ?> <span style="color:#F00; font-style:oblique;">*</span></label>
                                        <div class="col-sm-12">
                                            <div class="">
                                                <select name="category" class="form-control required" id="category_add">
                                                    <option value=""><?php echo $language['select']; ?></option>
                                                    <?php
                                                    if (isset($category_list) && !empty($category_list)) {
                                                        foreach ($category_list as $cat_list) {
                                                    ?>
                                                            <option value="<?php echo $cat_list['id']; ?>"> <?php echo $cat_list['category']; ?> </option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <span id="category_error" class="val" style="color:#F00;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label">Sub Category<span style="color:#F00; font-style:oblique;">*</span></label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <input type="text" name="sub_category" class=" borderra0 form-control" placeholder="<?php echo $language['enter_sub_category'] ?>" id="subcategory_add" />
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <span id="sub_cat_err" class="val" style="color:#F00;"></span>
                                            <span id="dup" class="dup" style="color:#F00;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="frameset_table action-btn-align">
                                <input type="submit" value="<?php echo $language['submit'] ?>" class="submit btn btn-success btn-fw" id="submit">
                                <input type="reset" value="<?php echo $language['clear'] ?>" class=" btn btn-danger btn-fw" id="cancel">
                                <a href="<?php echo $this->config->item('base_url') . 'masters/manage_sub_category' ?>" class="btn btn-dark btn-fw"><span class="glyphicon"></span>&nbsp;<?php echo $language['back'] ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
if (isset($all_list) && !empty($all_list)) {
    foreach ($all_list as $val) {
?>
        <div id="test3_<?php echo $val['id']; ?>" class="modal fade deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modalcolor">
                        <h3 id="myModalLabel" class="modal-title inactivepop">In-Active Sub Category</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you want In-Active This Sub Category? <strong><?= $val['sub_category']; ?></strong>
                        <input type="hidden" value="<?php echo $val['id']; ?>" class="id" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="yesin"><?php echo $language['yes'] ?></button>
                        <button type="button" class="btn btn-danger1 delete_all" data-dismiss="modal" id="no"><?php echo $language['no'] ?></button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>
<script type="text/javascript">
    var language_json = <?php echo json_encode($language); ?>;
    var language = language_json;
    $(document).ready(function() {
        $(".delete_yes").on("click", function() {
            var hidin = $(this).parent().parent().find('.id').val();
            $.ajax({
                url: BASE_URL + "masters/manage_sub_category/delete",
                type: 'POST',
                data: {
                    value1: hidin
                },
                success: function(result) {
                    swal(language["deleted"], language["expsub_cat_delete_success"], language["sucess"]);
                    $('.subcat' + hidin).remove();
                    $('.modal-backdrop').hide();
                    $('.deletemodal').hide();
                    $('.sa-confirm-button-container .confirm').html(language["ok"]);
                }
            });
        });
        $('.modal').css("display", "none");
        $(document).on('click', '.delete_row', function() {
            var hidin = $(this).attr('delete_id');
            swal({
                title: "Are you sure?",
                text: "Do You Want to Delete This Expense Sub Category?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function(result) {
                if (result == true) {
                    $.ajax({
                        url: BASE_URL + "masters/manage_sub_category/delete",
                        type: 'POST',
                        data: {
                            value1: hidin
                        },
                        success: function(result) {
                            //swal(language["deleted"], language["expsub_cat_delete_success"], language["sucess"]);
                            swal("Deleted!", "Expense Sub Category successfully deleted!", "success");
                            $('.subcat' + hidin).remove();
                            $('.sa-confirm-button-container .confirm').html(language["ok"]);
                        }
                    });
                }
            });
        });
        var table = $('#basicTable').DataTable({

            "oLanguage": {
                "sLengthMenu": language["show"] + " _MENU_ " + language["entries"],
                "sInfoEmpty": language["showing"] + ' 0 ' + language["to"] + ' 0 ' + language["of"] + ' 0 ' + language["entries"],
                "sInfo": language["showing"] + ' _START_ ' + language["to"] + ' _END_ ' + language["of"] + ' _TOTAL_ ' + language["entries"],
                "sZeroRecords": language["no_data_available"],
                "sSearch": language["search"],
                "oPaginate": {
                    "sPrevious": language["previous"],
                    "sNext": language["next"],
                }
            },
            "columnDefs": [{
                "targets": [0, 3], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],
        });
        // new $.fn.dataTable.FixedHeader(table);
    });
    $('#subcategory_add').on('blur', function() {

        var sub_category = $('#subcategory_add').val();
        if (sub_category == '' || sub_category == null || sub_category.trim().length == 0) {
            $('#sub_cat_err').html(language["required_field"]);
        } else {
            $('#sub_cat_err').html(" ");
        }
    });

    $("#category_add").on('blur', function() {

        var category = $("#category_add").val();
        if (category == "" || category == null || category.trim().length == 0) {
            $("#category_error").text(language["required_field"]);
        } else {
            $("#category_error").text("");
        }
    });
    $('#subcategory_add').on('blur', function() {
        var subcat_name = $.trim($("#subcategory_add").val());
        var cat_id = $("#category_add").val();
        if ($.trim(subcat_name) != '') {

            $.ajax({
                url: BASE_URL + "masters/manage_sub_category/add_duplicate_subcategory",
                type: 'POST',
                async: false,
                data: {
                    sub_category: subcat_name,
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

        var subcat_name = $.trim($("#subcategory_add").val());
        var cat_id = $("#category_add").val();
        if ($.trim(subcat_name) != '') {
            $.ajax({
                url: BASE_URL + "masters/manage_sub_category/add_duplicate_subcategory",
                type: 'POST',
                async: false,
                data: {
                    sub_category: subcat_name,
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

        var sub_category = $('#subcategory_add').val();
        if (sub_category == '' || sub_category == null || sub_category.trim().length == 0) {
            $('#sub_cat_err').html(language["required_field"]);
            i = 1;
        } else {
            $('#sub_cat_err').html(" ");
        }

        var category = $("#category_add").val();
        if (category == "" || category == null || category.trim().length == 0) {
            $("#category_error").text(language["required_field"]);
            i = 1;
        } else {
            $("#category_error").text("");
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