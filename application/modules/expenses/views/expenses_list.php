<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js/sweetalert.css">
<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>
<script type='text/javascript' src='<?php echo $theme_path; ?>/js/jquery.table2excel.min.js'></script>
<style>
    .expense_right tr td:nth-child(7) {
        text-align: right;
    }

    table tr td:nth-child(8) {
        text-align: center;
    }

    @media print {
        tfoot tr td {
            border-top: 0px !important;
            margin-top: -10px !important;
        }

        /* table tr td:last-child{display:none !important;} */
    }
</style>
<?php
// $this->config->item('firm_id');
$this->load->model('admin/admin_model');
$data['company_details'] = $this->admin_model->get_company_details();
?>
<div class="print_header">
    <table width="100%">
        <tr>
            <td width="15%" style="vertical-align:middle;">
                <div class="print_header_logo"><img src="<?= $theme_path; ?>/images/logo-login2.png" /></div>
            </td>
            <td width="85%">
                <div class="print_header_tit">
                    <h3><?= $data['company_details'][0]['company_name'] ?></h3>
                    <p>
                        <?= $data['company_details'][0]['address1'] ?>
                        <?= $data['company_details'][0]['address2'] ?>
                    </p>
                    <p></p>
                    <p><?= $data['company_details'][0]['city'] ?>-
                        <?= $data['company_details'][0]['pin'] ?>,
                        <?= $data['company_details'][0]['state'] ?></p>
                    <p></p>
                    <p>Ph:
                        <?= $data['company_details'][0]['phone_no'] ?>, Email:
                        <?= $data['company_details'][0]['email'] ?>
                    </p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="col-lg-12">
    <h4 class="card-title">Expenses List
        <!-- <a href="javascript:void(0);" id="advancesearchshow" class="btn btn-info clor" style="float:right;margin-top:-4px;" title="Advance Search">
            Advance Search</a> -->
        <?php
        $user_info = $this->user_info = $this->user_auth->get_from_session('user_info');
        if (($user_info[0]['role'] != 3)) {
        ?>
            <a style="float:right;margin-top:-5px; margin-right:3px;" href="<?php if ($this->user_auth->is_action_allowed('expenses', 'expenses', 'add')) : ?><?php echo $this->config->item('base_url') . 'expenses/' ?><?php endif ?>" class="btn btn-danger right topgen <?php if (!$this->user_auth->is_action_allowed('expenses', 'expenses', 'add')) : ?>alerts<?php endif ?>"><span class="fa fa-plus"></span> Add New Expense Entry</a>
        <?php } ?>
    </h4>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card hide_class" id="myDIVSHOW">
        <div class="card">
            <div class="card-body">
                <form id="form-filter" class="form-horizontal">
                    <div class="form-group row">

                        <div class="col col-md-3">
                            <label>Category</label>
                            <select class="form-control" id="ex_category">
                                <option>Select</option>
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
                        <div class="col col-md-3">
                            <label>Sub Category</label>
                            <select class="form-control" id="ex_subcat">
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
                        <div class="col col-md-3">
                            <label>From Date</label>
                            <input type="text" id='from_date' value="<?php echo date('01-m-Y') ?>" class="form-control datepicker" name="from_date" placeholder="dd-mm-yyyy" style="background-color:white;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col col-md-3">
                            <label>To Date</label>
                            <input type="text" id='to_date' value="<?php echo date('d-m-Y') ?>" class="form-control datepicker" name="to_date" placeholder="dd-mm-yyyy" style="background-color:white;">
                            <span class="date_err" style="color:#F00;font-size: 12px "></span>
                        </div>
                        <div class="col col-md-3">
                            <label class="control-label col-md-12 mnone">&nbsp;</label>
                            <a id='search' class="btn btn-success  mtop4" title="Search">SUBMIT<span class=" icon-magnifier"></span></a>&nbsp;
                            <a class="btn btn-danger mtop4" id='clear' title="Clear">CLEAR<span></span></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card" id="expense_list_table">
        <div class="card">
            <div class="card-body">
                <div class="tab-content tab-content-solid">
                    <div class="tabpad">
                        <table id="basicTable_call_back" class="table table-striped responsive no-footer dtr-inline expense_right">
                            <thead>
                                <tr>
                                    <th class="action-btn-align">S.No</th>
                                    <th class="action-btn-align">Company</th>
                                    <th class="action-btn-align">Expense Type</th>
                                    <th class="action-btn-align">Category</th>
                                    <th class="action-btn-align">Sub category</th>
                                    <th class="action-btn-align">Mode</th>
                                    <th class="action-btn-align">Expense amount</th>
                                    <th class="action-btn-align">Created Date</th>
                                    <th class="hide_class action-btn-align">Action</th>
                                </tr>
                            </thead>
                            <br>
                            <tbody id="result_data">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="hide_class"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="action-btn-align mb-10">
                            <button class="btn btn-primary print_btn"><span class="icon-printer"></span> Print</button>
                            <div class="btn-group">
                                <button type="button" class=" btn btn-success" data-toggle="dropdown">
                                    Excel
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" class="excel_btn1">Current Entries</a></li>
                                    <li><a href="#" id="excel-prt">Entire Entries</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="export_excel"></div>
<script>
    // $('.datepicker').datepicker({
    //     format: 'dd-mm-yyyy',
    // });
    // if($('#search').click(function)){
    //     $('#basicTable_call_back').find().show();
    // } else {
    //     $('#basicTable_call_back').find().hide();
    // }
    $('.print_btn').click(function() {
        window.print();
    });
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
                    $('#ex_subcat').find('option').not(':first').remove();
                    // Add options
                    $.each(response, function(index, data) {
                        $('#ex_subcat').append('<option value="' + data['id'] + '">' + data['sub_category'] + '</option>');
                    });
                }
            });
        });
    });
    var table;
    $(document).ready(function() {
        var firm_id = $('#firm').val();
        if (firm_id != '') {
            $("#footer_id").show();
            $(".excel_show").show();
            $('#expense_list_table').show();
            var table;
            table = $('#basicTable_call_back').DataTable({
                "lengthMenu": [
                    [50, 100, 150, -1],
                    [50, 100, 150, "All"]
                ],
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "retrieve": true,
                "order": [], //Initial no order.
                //dom: 'Bfrtip',
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('expenses/expenses_ajaxList/'); ?>",
                    "type": "POST",
                    "data": function(data) {
                        // data.firm_id = $('#firm').val();
                        data.cat_id = $('#ex_category').val();
                        data.sub_cat_id = $('#ex_subcat').val();
                        data.from_date = $('#from_date').val();
                        data.to_date = $('#to_date').val();
                    }
                },
                //Set column definition initialisation properties.
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };
                    // Total over all pages
                    var cols = [6];
                    var numFormat = $.fn.dataTable.render.number('\,', '.', 2, '&#8377;').display;
                    for (x in cols) {
                        total = api.column(cols[x]).data().reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        // Total over this page
                        pageTotal = api.column(cols[x], {
                            page: 'current'
                        }).data().reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        // Update footer
                        if (Math.floor(pageTotal) == pageTotal && $.isNumeric(pageTotal)) {
                            pageTotal = pageTotal;
                        } else {
                            pageTotal = pageTotal.toFixed(2); /* float */
                        }
                        $(api.column(cols[x]).footer()).html(numFormat(pageTotal));
                    }
                },
                responsive: true,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 2,
                        targets: -2
                    },
                    {
                        "targets": [0, 8], //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                ]
            });
            // new $.fn.dataTable.FixedHeader(table);
        } else {
            swal("Please select Company");
            $('#expense_list_table').hide();
        }
        // table.ajax.reload();  //just reload table

        $('#clear').click(function() { //button reset event click
            $("#firm").select2("val", "");
            $('#form-filter')[0].reset();
            table.ajax.reload(); //just reload table
            //        window.location.reload();
        });
        $('#search').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });
    });
    // $('#search').click(function() { //button filter event click
    //     // console.log(1);
    //     var table;
    //     var firm_id = $('#firm').val();
    //     if (firm_id != '') {
    //         $("#footer_id").show();
    //         $(".excel_show").show();
    //         $('#expense_list_table').show();
    //         var table;
    //         table = $('#basicTable_call_back').DataTable({
    //             "lengthMenu": [
    //                 [50, 100, 150, -1],
    //                 [50, 100, 150, "All"]
    //             ],
    //             "processing": true, //Feature control the processing indicator.
    //             "serverSide": true, //Feature control DataTables' server-side processing mode.
    //             "retrieve": true,
    //             "order": [], //Initial no order.
    //             //dom: 'Bfrtip',
    //             // Load data for the table's content from an Ajax source
    //             "ajax": {
    //                 "url": "<?php echo site_url('expenses/expenses_ajaxList/'); ?>",
    //                 "type": "POST",
    //                 "data": function(data) {
    //                     data.firm_id = $('#firm').val();
    //                     data.cat_id = $('#ex_category').val();
    //                     data.sub_cat_id = $('#ex_subcat').val();
    //                     data.from_date = $('#from_date').val();
    //                     data.to_date = $('#to_date').val();
    //                 }
    //             },
    //             //Set column definition initialisation properties.
    //             "footerCallback": function(row, data, start, end, display) {
    //                 var api = this.api(),
    //                     data;
    //                 // Remove the formatting to get integer data for summation
    //                 var intVal = function(i) {
    //                     return typeof i === 'string' ?
    //                         i.replace(/[\$,]/g, '') * 1 :
    //                         typeof i === 'number' ?
    //                         i : 0;
    //                 };
    //                 // Total over all pages
    //                 var cols = [6];
    //                 var numFormat = $.fn.dataTable.render.number('\,', '.', 2, '&#8377;').display;
    //                 for (x in cols) {
    //                     total = api.column(cols[x]).data().reduce(function(a, b) {
    //                         return intVal(a) + intVal(b);
    //                     }, 0);
    //                     // Total over this page
    //                     pageTotal = api.column(cols[x], {
    //                         page: 'current'
    //                     }).data().reduce(function(a, b) {
    //                         return intVal(a) + intVal(b);
    //                     }, 0);
    //                     // Update footer
    //                     if (Math.floor(pageTotal) == pageTotal && $.isNumeric(pageTotal)) {
    //                         pageTotal = pageTotal;
    //                     } else {
    //                         pageTotal = pageTotal.toFixed(2); /* float */
    //                     }
    //                     $(api.column(cols[x]).footer()).html(numFormat(pageTotal));
    //                 }
    //             },
    //             responsive: true,
    //             columnDefs: [{
    //                     responsivePriority: 1,
    //                     targets: 0
    //                 },
    //                 {
    //                     responsivePriority: 2,
    //                     targets: -2
    //                 },
    //                 {
    //                     "targets": [0, 8], //first column / numbering column
    //                     "orderable": false, //set not orderable
    //                 },
    //             ]
    //         });
    //         // new $.fn.dataTable.FixedHeader(table);
    //     } else {
    //         swal("Please select Company");
    //         $('#expense_list_table').hide();
    //     }
    //     // table.ajax.reload();  //just reload table
    // });
    $('#clear').click(function() { //button reset event click
        $("#firm").select2("val", "");
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
        //        window.location.reload();
    });
    $('#firm').change(function() {
        var firm_id = $(this).val();
        $.ajax({
            url: BASE_URL + "expenses/get_company_amount",
            type: "post",
            data: {
                firm_id: firm_id
            },
            dataType: 'json',
            success: function(result) {
                if (result != '') {
                    if (result[0].opening_balance != null && result[0].opening_balance > 0) {
                        opening_amt = (result[0].opening_balance);
                        $("#firm_amt").val(opening_amt);
                    } else {
                        $("#firm_amt").val('0');
                    }
                } else {
                    $("#firm_amt").val('0');
                }
            }
        });
    });
    $(document).on('click', '.excel_btn1', function() {
        fnExcelReport2();
    });

    function fnExcelReport2() {
        var tab_text = "<table id='custom_export' border='5px'><tr width='100px' bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById('basicTable_call_back'); // id of table
        for (j = 0; j < tab.rows.length; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        }
        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        $('#export_excel').show();
        $('#export_excel').html('').html(tab_text);
        $('#export_excel').hide();
        $("#custom_export").table2excel({
            exclude: ".noExl",
            name: "Expenses Report",
            filename: "Expenses Report",
            fileext: ".xls",
            exclude_img: false,
            exclude_links: false,
            exclude_inputs: false
        });
    }
    $('#excel-prt').on('click', function() {
        var firm_id = $('#firm').val();
        var cat_id = $('#ex_category').val();
        var sub_cat_id = $('#ex_subcat').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        window.location = (BASE_URL + 'expenses/getall_expenses_entries?firm_id=' + firm_id + '&cat_id=' + cat_id + '&sub_cat_id=' + sub_cat_id + '&from_date=' + from_date + '&to_date=' + to_date);
    });
    $("#from_date").datepicker({
        autoclose: true,
    }).on('changeDate', function(selected) {
        var startDate = new Date(selected.date.valueOf());
        $('#to_date').datepicker('setStartDate', startDate);
    }).on('clearDate', function(selected) {
        $('#to_date').datepicker('setStartDate', null);
    });
    $("#to_date").datepicker({
        autoclose: true,
    }).on('changeDate', function(selected) {
        var endDate = new Date(selected.date.valueOf());
        $('#from_date').datepicker('setEndDate', endDate);
    }).on('clearDate', function(selected) {
        $('#from_date').datepicker('setEndDate', null);
    });
</script>
<!-- <script src="<?= $theme_path; ?>/js/fixedheader/dataTables.fixedHeader.min.js"></script> -->