<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />
<style>
    .btn-xs {
        border-radius: 0px;
    }

    .bg-red {
        background-color: #dd4b39 !important;
    }

    .bg-green {
        background-color: #09a20e !important;
    }

    .bg-yellow {
        background-color: orange !important;
    }

    .btn-info {
        background-color: #ffffff;
        border-color: #000000;
        color: #a1a3a5;
        padding: 2px 2px 2px 2px !important;
    }

    .btn-info:hover {
        background-color: #ff4081;
        border: 1px solid #ff4081 !important;
        color: #ffffff;
    }

    .auto-asset-search ul#country-list {
        border: 1px solid #ffffff;
        position: absolute;
        width: 96%;
        overflow-x: hidden;
        overflow-y: auto;
        max-height: 137px;
        z-index: 9;
        padding-left: 0;
    }

    .auto-asset-search ul#country-list li.asset_name_auto {
        background: #00c0ef;
        margin: 0;
        padding: 4px 5px;
        border-bottom: 1px solid #f3f3f3;
        color: #fff;
    }

    .auto-asset-search ul#country-list li {
        background: red;
        color: #fff !important;
        margin: 0;
        padding: 4px 5px;
        border-bottom: 0px solid #f3f3f3;
    }

    .auto-asset-search ul#country-list li.asset_name_auto:hover {
        background: #c3c3c3;
        cursor: pointer;
    }

    .auto-asset-search ul#country-list li:hover {
        background: red;
        cursor: pointer;
    }
</style>
<?php
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
                        <?= $data['company_details'][0]['address1'] ?>,
                        <?= $data['company_details'][0]['address2'] ?>,
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
<div class="mainpanel">
    <div class="media mt--20">
        <h4>Sales Return List
            <!--<a href="<?php echo $this->config->item('base_url') . 'purchase_order/' ?>" class="btn btn-success right topgen"><span class="glyphicon glyphicon-plus"></span> Add Purchase Order</a>-->
        </h4>
    </div>
    <div class="contentpanel">
        <div id='result_div' class="panel-body mt-top5 pb0">
            <form name="product_name_wise_search" id="product_namewise_search" method="post" action="<?php echo $this->config->item('base_url'); ?>sales_return/index">
                <div class="mh-col text-center">
                    <div class="filter-area-field">
                        <br>
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-4" style="position:relative;">

                            </div>
                            <div class="col-sm-2">

                            </div>
                        </div>

                    </div>
            </form>
            <div class="tabpad">
                <table id="basicTable_call_back" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline totalqua-cntr returnqua-cntr presentqua-cntr totalamt-right" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <td class="action-btn-align">S.No</td>
                            <td class='action-btn-align'>Inv ID</td>
                            <td>Customer Name</td>
                            <td class="action-btn-align">Total QTY</td>
                            <td>Total Amount</td>
                            <td class="action-btn-align">Return QTY</td>
                            <!--<td class="action-btn-align">Present Quantity</td>-->
                            <!--                        <td class="action-btn-align">Total Tax</td>-->
                            <!--<td>Sub Total</td>-->
                            <td class="text_right total-bg">Return Amount</td>
                            <!--<td>Remarks</td>-->
                            <td class="hide_class action-btn-align">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!--                             <tr><td colspan="10">No data found...</td></tr>-->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="action-btn-align total-bg"></td>
                            <td class="action-btn-align total-bg"></td>
                            <td class="action-btn-align total-bg"></td>
                            <td class="text_right total-bg"></td>
                            <td class="hide_class"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="action-btn-align mb-10">
                <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>
            </div>
        </div>
        <?php
        if (isset($po) && !empty($po)) {
            foreach ($po as $val) {
        ?>
                <div id="test3_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                    <div class="modal-dialog">
                        <div class="modal-content modalcontent-top">
                            <div class="modal-header modal-padding modalcolor"> <a class="close modal-close closecolor" data-dismiss="modal">×</a>
                                <h3 id="myModalLabel" class="inactivepop">In-Active user</h3>
                            </div>
                            <div class="modal-body">
                                Do You Want In-Active This Purchase Order?<strong><?= $val['po_no']; ?></strong>
                                <input type="hidden" value="<?php echo $val['id']; ?>" class="id" />
                            </div>
                            <div class="modal-footer action-btn-align">
                                <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
                                <button type="button" class="btn btn-danger delete_all" data-dismiss="modal" id="no">No</button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<script>
    $(document).on('click', '.alerts', function() {
        sweetAlert("Oops...", "This Access is blocked!", "error");
        return false;
    });
    $('.print_btn').click(function() {
        window.print();
    });
</script>
</div><!-- contentpanel -->
</div><!-- mainpanel -->
<script type="text/javascript">
    $('.complete_remarks').live('blur', function() {
        var complete_remarks = $(this).parent().parent().find(".complete_remarks").val();
        var ssup = $(this).offsetParent().find('.remark_error');
        if (complete_remarks == '' || complete_remarks == null) {
            ssup.html("Required Field");
        } else {
            ssup.html("");
        }
    });
    $(document).ready(function() {
        jQuery('.datepicker').datepicker();
    });
    $().ready(function() {
        $("#po_no").autocomplete(BASE_URL + "gen/get_po_list", {
            width: 260,
            autoFocus: true,
            matchContains: true,
            selectFirst: false
        });
    });
    $('#search').live('click', function() {
        for_loading();
        $.ajax({
            url: BASE_URL + "po/search_result",
            type: 'GET',
            data: {
                po: $('#po_no').val(),
                style: $('#style').val(),
                supplier: $('#supplier').val(),
                supplier_name: $('#supplier').find('option:selected').text(),
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val()
            },
            success: function(result) {
                for_response();
                $('#result_div').html(result);
            }
        });
    });
</script>
<script type="text/javascript">
    function datatable() {
        var table;
        table = jQuery('#basicTable_call_back').DataTable({
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
                var cols = [3, 4, 5, 6];
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
                    $(api.column(cols[x]).footer()).html(pageTotal);
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
                }
            ]
        });
        // new $.fn.dataTable.FixedHeader(table);
    }
    $(document).ready(function() {
        var table;
        table = jQuery('#basicTable_call_back').DataTable({
            "lengthMenu": [
                [50, 100, 500, -1],
                [50, 100, 500, "All"]
            ],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "retrieve": true,
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('sales_return/ajaxList/'); ?>",
                "type": "POST",
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 6], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],
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
                var cols = [3, 4, 5, 6];
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
                    $(api.column(cols[x]).footer()).html(pageTotal);
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
                }
            ]
        });
        // new $.fn.dataTable.FixedHeader(table);
        $("#yesin").live("click", function() {
            var hidin = $(this).parent().parent().find('.id').val();
            // alert(hidin);
            $.ajax({
                url: BASE_URL + "purchase_order/po_delete",
                type: 'POST',
                data: {
                    value1: hidin
                },
                success: function(result) {
                    window.location.reload(BASE_URL + "purchase_order/purchase_order_list");
                }
            });
        });
        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });
    $('#product_name_src').keyup(function() {
        var term = $(this).val();
        if ($.trim(term).length > 0) {
            $.ajax({
                url: BASE_URL + "sales_return/product_list",
                type: 'POST',
                data: {
                    term: term
                },
                success: function(result) {
                    $("#suggesstion-box_ins").show();
                    $("#suggesstion-box_ins").html(result);
                    $("#search-box_ins").css("background", "#FFF");
                }
            });
        }
    });
    $('.asset_name_auto').live('click', function() {
        var product_name = $(this).attr('asset_name');
        var product_id = $(this).attr('asset_id');
        $("#suggesstion-box_ins").hide();
        $('#product_id_hdn').val(product_id);
        $('#product_name_hdn').val(product_name);
        $('#product_name_src').val(product_name);
    });
    $('#product_name_wise_reset').click(function() {
        $.ajax({
            url: BASE_URL + "sales_return/clear_prodct_name_wise_filter",
            type: 'POST',
            success: function(result) {
                window.location.reload(BASE_URL + "sales_return/index");
            }
        });
    });
</script>
<script src="<?= $theme_path; ?>/js/fixedheader/jquery.dataTables.min.js"></script>