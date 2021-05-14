<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<link rel="stylesheet" href="<?php echo $theme_path ?>/node_modules/pwstabs/assets/jquery.pwstabs.min.css">
<script src="<?php echo $theme_path ?>/node_modules/pwstabs/assets/jquery.pwstabs.min.js"></script>
<script src="<?php echo $theme_path ?>/js/tabs.js"></script>
<script src="<?php echo $theme_path; ?>/node_modules/datatables.net/js/jquery.dataTables.js"></script>
<script src="<?php echo $theme_path; ?>/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<link rel="stylesheet" href="<?php echo $theme_path; ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" />
<link href="<?php echo $theme_path ?>/css/select2.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/css/fixedHeader.dataTables.min.css"/>
<script src="<?php echo $theme_path ?>/js/select2.min.js"></script>
<script type='text/javascript' src='<?php echo $theme_path; ?>/js/fixedheader/dataTables.fixedHeader.min.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js/sweetalert.css">
<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Expense Category Details</h4>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-solid  tab-solid-primary" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-6-1" data-toggle="tab" href="#category-details"role="tab" aria-controls="home-6-1" aria-selected="true"><i class="mdi mdi-table-large"></i>Expense Category List</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-6-2" data-toggle="tab" href="<?php if ($this->user_auth->is_action_allowed('masters', 'user_roles', 'add')): ?>#addcategory<?php endif ?>" role="tab" aria-controls="profile-6-2" aria-selected="false" class="nav-link <?php if (!$this->user_auth->is_action_allowed('masters', 'user_roles', 'add')): ?>alerts<?php endif ?>"><i class="mdi mdi-account-plus"></i><?php echo $language['add_new'] ?></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tab-content-solid">
                    <div role="tabpanel" aria-labelledby="tab-6-1" class="tab-pane fade show active" id="category-details">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="basicTable" class="table-striped table responsive dataTable no-footer dtr-inline" >
                                        <thead>
                                            <tr>
                                                <th><?php echo $language['s_no'] ?></th>
                                                <th><?php echo $language['category'] ?></th>
                                                <th class="action-btn-align"><?php echo $language['action'] ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($category_list) && !empty($category_list)) {
                                                $i = 1;
                                                foreach ($category_list as $list) {
                                                    ?>
                                                    <tr class="category<?php echo $list['id']; ?>"><td class="first_td"><?php echo $i; ?></td>
                                                        <td><?php echo ucfirst($list['category']); ?></td>
                                                        <td class="action-btn-align">
                                                            <a href="<?php if ($this->user_auth->is_action_allowed('masters', 'manage_category', 'edit')): ?><?php echo $this->config->item('base_url') . 'masters/manage_category/edit/' . $list['id'] ?><?php endif ?>" class="tooltips btn btn-info btn-fw btn-xs <?php if (!$this->user_auth->is_action_allowed('masters', 'manage_category', 'edit')): ?>alerts<?php endif ?>" title="<?php echo $language['edit']; ?>">
                                                                <span class="fa fa-edit"></span></a>&nbsp;&nbsp;
                                                            <!--<a href="<?php if ($this->user_auth->is_action_allowed('masters', 'manage_category', 'delete')): ?>#test3_<?php echo $list['id']; ?><?php endif ?>" data-toggle="modal" name="delete" class="tooltips btn btn-danger btn-fw btn-xs <?php if (!$this->user_auth->is_action_allowed('masters', 'manage_category', 'delete')): ?>alerts<?php endif ?>" title="<?php echo $language['delete']; ?>">
                                                                <span class="icon-trash"></span></a>-->
                                                            <a name="delete" class="tooltips btn btn-danger btn-fw btn-xs <?php
                                                            if (!$this->user_auth->is_action_allowed('masters', 'manage_category', 'delete')) {
                                                                echo "alerts";
                                                            } else {
                                                                echo "delete_row";
                                                            }
                                                            ?>" delete_id="<?php echo $list['id']; ?>" title="<?php echo $language['delete']; ?>">
                                                                <span class="icon-trash"></span></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="3"><?php echo $language['no_data_available'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="view"></div>
                        </div>
                    </div>
                    <div role="tabpanel" aria-labelledby="tab-6-2" class="tab-pane fade" id="addcategory">
                        <form name="myform" method="post" action="<?php echo $this->config->item('base_url'); ?>masters/manage_category/add/">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label">Type  <span style="color:#F00; font-style:oblique;">*</span></label>
                                        <div class="col-sm-12">
                                            <select name="comments"  class="form-control required" id="comments" >
                                                <option value=""><?php echo $language['select'] ?></option>
                                                <option value="1">Sales</option>
                                                <option value="2">Purchase</option>
                                                <option value="3">Others</option>
                                            </select>
                                            <span id="comments_err" class="val" style="color:#F00;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label">Add category <span style="color:#F00; font-style:oblique;">*</span></label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <input type="text" name="category" id="manage_category" class="borderra0 form-control" placeholder="<?php echo $language['enter_category'] ?>" />
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <span id="category_error" class="val" style="color:#F00;font-size: 14px;"></span>
                                            <span id="duplica_category" class="duplica_category"  style="color:#F00;font-size: 14px;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="frameset_table action-btn-align">
                                <input type="submit" value="<?php echo $language['submit'] ?>" class="submit btn btn-success btn-fw " id="submit" >
                                <input type="reset" value="<?php echo $language['clear'] ?>" class="btn  btn-danger btn-fw" id="cancel" >
                                <a href="<?php echo $this->config->item('base_url') . 'masters/manage_category' ?>" class="btn btn-dark btn-fw"><span class="glyphicon"></span>&nbsp;<?php echo $language['back'] ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
if (isset($category_list) && !empty($category_list)) {
    foreach ($category_list as $val) {
        ?>
        <div id="test3_<?php echo $val['id']; ?>" class="modal fade deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modalcolor">
                        <h3 id="myModalLabel" class="modal-title inactivepop">In-Active Category
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you want delete this category <strong><?= $val['category']; ?>?</strong>
                        <input type="hidden" value="<?php echo $val['id']; ?>" class="id" />
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary delete_yes" id="yesin"><?php echo $language['yes'] ?></button>
                        <button type="button" class="btn btn-danger1 delete_all"  data-dismiss="modal" id="no"><?php echo $language['no'] ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<script>
    var language_json = <?php echo json_encode($language); ?>;
    var language = language_json;
    $(document).ready(function () {
        var table = $('#basicTable').DataTable({
            "searchDelay": 500,
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
            "columnDefs": [
                {
                    "targets": [0, 2], //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
        });
        $(".delete_yes").on("click", function () {
            $("#yesin").html("Processing");
            var hidin = $(this).parent().parent().find('.id').val();
            $.ajax({
                url: BASE_URL + "masters/manage_category/delete",
                type: 'POST',
                data: {value1: hidin},
                success: function (result) {
                    swal(language["deleted"], language["exp_cat_delete_success"], language["sucess"]);
                    $('.category' + hidin).remove();
                    $('.modal-backdrop').hide();
                    $('.deletemodal').hide();
                    $('.sa-confirm-button-container .confirm').html(language["ok"]);
                }
            });
        });
        $('.modal').css("display", "none");

        new $.fn.dataTable.FixedHeader(table);

        $(document).on('click', '.delete_row', function () {
            var hidin = $(this).attr('delete_id');
            swal({
                title: "Are you sure?",
                text: "Do You Want to Delete This Expense Category?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function (result) {
                if (result == true) {
                    $.ajax({
                        url: BASE_URL + "masters/manage_category/delete",
                        type: 'POST',
                        data: {value1: hidin},
                        success: function (result) {
                            //swal(language["deleted"], "Expense Category successfully deleted!", language["sucess"]);
                            swal("Deleted!", "Expense Category successfully deleted!", "success");
                            $('.category' + hidin).remove();
                            $('.sa-confirm-button-container .confirm').html(language["ok"]);
                        }
                    });
                }
            });
        });
    });

    $('#cancel').on('click', function ()
    {
        $('.val').text("");
        $('#duplica_category').text("");
    });
    $("#manage_category").on('blur', function ()
    {
        var category = $("#manage_category").val();
        if (category == "" || category == null || category.trim().length == 0)
        {
            $("#category_error").text(language["required_field"]);
        } else
        {
            $("#category_error").text("");
        }
    });
    $('#manage_category').on('blur', function () {
        var cat_name = $.trim($("#manage_category").val());
        var comments = $.trim($("#comments").val());
        if ((cat_name) != '') {

            $.ajax({
                url: BASE_URL + "masters/manage_category/add_duplicate_category",
                type: 'POST',
                async: false,
                data: {category: cat_name, comments: comments},
                success: function (result)
                {
                    $("#duplica_category").html(result);
                }
            });
        } else {
            $("#duplica_category").html('');
        }
    });
    $('#comments').on('blur', function () {

        var comments = $('#comments').val();
        if (comments == '' || comments == null || comments.trim().length == 0)
        {
            $('#comments_err').html(language["required_field"]);
        } else
        {
            $('#comments_err').html(" ");
        }
    });

    $('#submit').on('click', function () {
        var cat_name = $.trim($("#manage_category").val());
        var comments = $.trim($("#comments").val());
        if (cat_name != '') {

            $.ajax({
                url: BASE_URL + "masters/manage_category/add_duplicate_category",
                type: 'POST',
                async: false,
                data: {category: cat_name, comments: comments},
                success: function (result)
                {
                    $("#duplica_category").html(result);
                }
            });
        } else {
            $("#duplica_category").html('');
        }

        var i = 0;

        if (comments == '' || comments == null || comments.trim().length == 0)
        {
            $('#comments_err').html(language["required_field"]);
            i = 1;
        } else
        {
            $('#comments_err').html(" ");
        }

        var manage_category = $("#manage_category").val();
        if (manage_category == "" || manage_category == null || manage_category.trim().length == 0)
        {
            $("#category_error").text(language["required_field"]);
            i = 1;
        } else
        {
            $("#category_error").text("");
        }
        var m = $('#duplica_category').html();
        if ((m.trim()).length > 0)
        {
            i = 1;
        }
        if (i == 1)
        {
            return false;
        } else
        {
            return true;
        }

    });
</script>