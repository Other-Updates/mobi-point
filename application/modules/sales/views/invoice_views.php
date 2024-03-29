<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<!--
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script> -->
<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script src="<?php echo $theme_path; ?>/js/jQuery.print.js"></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/css/jquery-confirm.min.css" />
<script type='text/javascript' src='<?= $theme_path; ?>/js/jquery-confirm.min.js'></script>
<style type="text/css">
    .text_right {
        text-align: right;
    }

    .box,
    .box-body,
    .content {
        padding: 0;
        margin: 0;
        border-radius: 0;
    }

    #top_heading_fix h3 {
        top: -57px;
        left: 6px;
    }

    #TB_overlay {
        z-index: 20000 !important;
    }

    #TB_window {
        z-index: 25000 !important;
    }

    .dialog_black {
        z-index: 30000 !important;
    }

    #boxscroll22 {
        max-height: 291px;
        overflow: auto;
        cursor: inherit !important;
    }

    .auto-asset-search ul#country-list li:hover {
        background: #c3c3c3;
        cursor: pointer;
    }

    .auto-asset-search ul#country-list li {
        background: #dadada;
        margin: 0;
        padding: 5px;
        border-bottom: 1px solid #f3f3f3;
    }

    ul li {
        list-style-type: none;
    }

    .dropdown-menu {
        min-width: 190px;
    }

    .dataTable tbody tr td:last-child,
    .dataTable thead tr th:last-child {
        text-align: right;
    }

    .bold_heading {
        font-weight: bold;
    }

    .words,
    .goods-condi {
        display: none;
        width: 100%;
        margin-bottom: 20px;
    }

    .goods-condi .gc1 {
        border: 1px solid #000;
        float: left;
        width: 30%;
        height: 110px;
        padding: 5px;
    }

    .goods-condi .gc2 {
        border: 1px solid #000;
        float: left;
        width: 50%;
        height: 110px;
        padding: 5px;
    }

    .goods-condi .gc3 {
        border: 1px solid #000;
        float: left;
        width: 20%;
        height: 110px;
        padding: 5px;
    }

    .print_bgclr.table thead th {
        color: #fff !important;
    }

    .print_header_tit {
        width: 100%;
        text-align: right;
    }

    .m-b-0 {
        margin-bottom: 0px;
    }

    .table.table-bordered td:last-child {
        border-right-width: 1px;
    }

    .m-0 {
        margin: 0px;
    }

    .cashbill-tit {
        background: #003e94;
        padding: 6px 22px;
        border-radius: 10px;
        color: #fff;
        text-align: center;
        font-size: 25px;
        display: table;
        margin: 0 auto;
        margin-bottom: 20px;
    }

    @media print {
        .cashbill-tit {
            background: #003e94 !important;
            padding: 6px 22px;
            border-radius: 10px;
            color: #fff !important;
            text-align: center;
            font-size: 25px;
            display: table;
            margin-bottom: 20px;
        }

        .print_header {
            min-height: 110px !important;
            font-size: 14px;
        }

        .tot-amount,
        .tot-text {
            font-size: 20px !important;
        }

        .print_header table td {
            padding: 5px !important;
            border: 0 !important;
        }

        table tr td,
        .print_header table {
            border: 1px solid black !important;
        }

        .print_header table {
            border-bottom-color: #fff !important;
        }

        table tr {
            border-right: 1px solid black !important;
        }

        body {
            -webkit-print-color-adjust: exact;
        }

        .imeview {
            border-top: 1px solid black !important;
        }

        table tr td {
            border: 1px solid black !important;
        }

        .table-bordered>tfoot>tr>td {
            border: 1px solid black !important;
        }

        .words {
            display: block;
            margin-top: -21px;
        }

        .print_bgclr.table>thead:first-child>tr:first-child>th {
            background-color: #003e94 !important;
            -webkit-print-color-adjust;
            border-color: #003e94 !important;
        }

        .print_bgclr thead th {
            color: #fff !important;
            font-weight: bold;
        }

        .table-bordered>tfoot>tr> {
            border-top: 1px solid black !important;
            border-bottom: 1px solid black !important;
        }

        .tfootbotom {
            margin-top: -5px !important;
            border: 1ps solid black !important;
        }

        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 10px 10px 10px 10px !important;
            line-height: 1.928571;
            font-size: 14px !important;
        }

        .table>thead>tr>th {
            padding: 5px 10px 5px 10px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
        }

        .goods-condi {
            display: block;
        }
    }

    @page {
        size: A4 portrait !important;
        margin: 0.4cm;
    }
</style>
<div class="mainpanel">
    <div class="hide_class media mt--40">
        <h4 class="hide_class">View Sales Invoice</h4>
    </div>
    <div class="contentpanel enquiryview viewquo mb-45 mt-top2">
        <?php
        if (isset($quotation) && !empty($quotation)) {
            foreach ($quotation as $val) {
        ?>
                <div class="cashbill-tit">CASH&nbsp;BILL</div>
                <?php $gsttype = $val['bill_category']; ?>
                <div class="print_header">
                    <table width="100%">
                        <tr>
                            <td width="50%" style="vertical-align:top;">
                                <div class="print_header_logo" style="width:350px !important;"><img src="<?= $theme_path; ?>/images/logo-login2.png" width="400px" /></div>
                            </td>
                            <td width="50%" style="vertical-align:top; border-left: 0;" align="right">
                                75A, SP Nagar, TVS Nagar Road,<br /> Kavundampalayam, Coimbatore-641002.<br /> <b>E-Mail :</b> sales@mobi-point.com<br /> <b>Phone :</b> 0422-4521100. <b>Cell :</b> 9566781098.<br /> <b>GSTIN :</b> 33BABFFM2200A1ZA
                            </td>
                        </tr>
                    </table>
                </div>
                <table class="table ptable" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="50%" style="margin-left:20px !important; border-right: 0;"><span class="tdhead"><b>Customer Name & Address :</b></span>
                            <div><?php echo $val['store_name']; ?></div>
                            <div><?php echo $val['address1']; ?> </div>
                            <div><b>Mobile :</b> <?php echo ($val['mobil_number']) ? $val['mobil_number'] : '-'; ?></div>
                        </td>
                        <td width="50%" align="right" style="vertical-align:top; border-left: 0;"><b>Invoice No :</b> <?php echo '' . $val['inv_id']; ?><br />
                            <!--Reference No :  <?php echo $val['q_no']; ?>--> <b>Date :</b> <?php echo ($val['created_date'] != '1970-01-01') ? date('d-M-Y', strtotime($val['created_date'])) : ''; ?><br />
                            <!--Sales Man : <?php
                                            $sales_man = (!empty($val['sales_man_name']) ? $val['sales_man_name'] : '-');
                                            echo $sales_man;
                                            ?>-->
                        </td>
                    </tr>
                </table>
                <br>

                <div>
                    <a href="<?php echo $this->config->item('base_url') . 'print_view' ?>" class="btn btn-defaultprint6 gst"><span class="glyphicon glyphicon-print"></span> GST Print </a>
                    <a href="<?php echo $this->config->item('base_url') . 'print_view' ?>" class="btn btn-defaultprint6 nogst"><span class="glyphicon glyphicon-print"></span> NOGST Print </a>
                </div>

                <table class="table table-striped table-bordered responsive print_bgclr m-b-0" id="add_quotation" cellpadding="0" cellspacing="0">
                    <thead style="color:white !important;">
                        <tr style="text-align:center; color:white !important;">
                            <th width="1%" class="first_td1 action-btn-align">S.No</th>
                            <th width="59%" class="first_td1 pro-wid">Product&nbsp;Name&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th width="15%" class="first_td1">HSN Code</th>
                            <th width="7%" class="first_td1 action-btn-align ser-wid">QTY</th>
                            <th width="7%" class="text_right">Rate</td>
                            <th width="15%" class="first_td1 qty-wid text_right">Amount</th>
                        </tr>
                    </thead>
                    <tbody id='app_table'>
                        <?php
                        $i = 1;
                        $cgst = 0;
                        $sgst = 0;
                        if (isset($quotation_details) && !empty($quotation_details)) {
                            foreach ($quotation_details as $vals) {
                                $cgst1 = ($vals['tax'] / 100) * ($vals['sp_with_gst'] * $vals['quantity']);
                                $gst_type = $quotation[0]['state_id'];
                                if ($gst_type != '') {
                                    if ($gst_type == 31) {
                                        $sgst1 = ($vals['gst'] / 100) * ($vals['sp_with_gst'] * $vals['quantity']);
                                    } else {
                                        $sgst1 = ($vals['igst'] / 100) * ($vals['sp_with_gst'] * $vals['quantity']);
                                    }
                                }
                                $cgst += $cgst1;
                                $sgst += $sgst1;
                                if (isset($val['round_off']) && $val['round_off'] > 0) {
                                    if ($val['net_total'] > ($val['subtotal_qty'] + $val['transport'] + $val['labour'] + $cgst + $sgst)) {
                                        $round_off_plus = $val['round_off'];
                                        $round_off_minus = 0;
                                    } else if ($val['net_total'] < ($val['subtotal_qty'] + $val['transport'] + $val['labour'] + $cgst + $sgst)) {
                                        $round_off_minus = $val['round_off'];
                                        $round_off_plus = 0;
                                    } else {
                                        $round_off_plus = 0;
                                        $round_off_minus = 0;
                                    }
                                }
                                $net_total = $val['net_total'];
                        ?>
                                <tr style="border-bottom:1px solid black;">
                                    <td class="action-btn-align">
                                        <input type="checkbox" id="box" class="box" name="checkbox" value="" />
                                    </td>
                                    <td>
                                        <?php echo $vals['product_name'] ?><br /? IMEI : </td>
                                    <td class="">
                                        <?php echo !empty($vals['hsn_sac']) ? $vals['hsn_sac'] : '-'; ?>
                                    </td>
                                    <td class="action-btn-align">
                                        <?php echo $vals['quantity'] ?>
                                    </td>
                                    <td align="right"><?php echo number_format($vals['per_cost'], 2); ?></td>
                                    <td class="text_right" style="text-align:right;">
                                        <?php echo number_format($vals['sub_total'], 2); ?>
                                    </td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                    <?php if ($gsttype == 1) { ?>
                        <tfoot>
                            <?php
                            foreach ($val['other_cost'] as $key) {
                            ?>
                            <?php }
                            ?>
                            <?php
                            $gst = number_format(($quotation[0]['cgst_price'] + $quotation[0]['sgst_price']), 2)
                            ?>
                            <tr>
                                <td align="right" colspan="4"><b>GST</b></td>
                                <td align="center">12%</td>
                                <td align="right"><?php echo $gst; ?></td>
                            </tr>
                            <?php if ($quotation[0]['tax'] && round($quotation[0]['tax']) != 0) { ?>
                                <tr>
                                    <td align="right" colspan="4"><b><?php echo $quotation[0]['tax_label']; ?></b></td>
                                    <td align="center">-</td>
                                    <td align="right"><?php echo $quotation[0]['tax']; ?></td>
                                </tr>
                            <?php } ?>
                        </tfoot>
                    <?php } ?>
                </table>
                <table width="100%" class="tfootbotom table table-bordered m-b-0">
                    <tr style="border-bottom:1px solid black; background: #f4f8fb;">
                        <?php if ($gsttype == 1) { ?>
                            <td width="15%" colspan="" style="text-align:center;" class="bor-tb0 bold_heading">Taxable Price : </td>
                        <?php } ?>
                        <?php if ($gsttype == 1) { ?>
                            <td width="10%" class="text_right bor-tb0"><?php echo number_format($quotation[0]['taxable_price'], 2); ?></td>
                        <?php } ?>
                        <?php if ($gsttype == 1) { ?>
                            <td width="8%" colspan="" style="text-align:center;" class="bor-tb0 bold_heading">CGST : </td>
                        <?php } ?>
                        <?php if ($gsttype == 1) { ?>
                            <td width="9%" class="text_right bor-tb0"><?php echo number_format($quotation[0]['cgst_price'], 2); ?></td>
                        <?php } ?>
                        <?php if ($gsttype == 1) { ?>
                            <?php
                            $gst_type = $quotation[0]['state_id'];
                            if ($gst_type == 31) {
                            ?>
                                <td width="8%" colspan="" style="text-align:center;" class="bor-tb0 bold_heading">SGST : </td>
                            <?php } else { ?>
                                <td width="10%" colspan="" style="text-align:center;" class="bor-tb0 bold_heading">IGST : </td>
                            <?php
                            }
                            ?>
                        <?php } ?>
                        <?php if ($gsttype == 1) { ?>
                            <td width="9%" class="text_right bor-tb0"><?php echo number_format($quotation[0]['sgst_price'], 2); ?></td>
                        <?php } ?>
                        <td width="12%" colspan="" style="text-align:center;font-weight:bold;" class="bor-tb0 tot-text">Net Total : </td>
                        <?php
                        $net_total = $quotation[0]['net_total'];
                        if ($quotation[0]['tax'] && round($quotation[0]['tax']) != 0) {
                            //$net_total = $net_total + $quotation[0]['tax'];
                        } ?>
                        <td width="10%" class="text_right bor-tb0 tot-amount"><b class="tot-amount"><?php echo number_format($net_total, 2); ?></b></td>
                    </tr>
                    <tr>
                        <td align="center"><b>Rupees : </b> <?php echo $val['remarks']; ?>
                        </td>
                        <td colspan="11" class="bor-tb0  ">
                            <span class=""><?php echo $in_words; ?></span>
                        </td>
                    </tr>
                </table><br>
                <div class="goods-condi">
                    <div class="gc1" style="text-align:center;">
                        Received the goods in<br /> goods condition <br /><br /><br /><b>Customer's Signature</b>
                    </div>
                    <div class="gc2">
                        Goods once sold will not be taken back or exchanged.<br />
                        Warranty as per terms& Conditions of the manufacyure.<br />
                        All disputes are subject to coimbatore jurisdiction.
                    </div>
                    <div class="gc3" style="text-align:center;">FOR <b>Mob-Point</b></div>
                </div>
                <div class="sign row col-md-12" style="margin-top:20px ; display: none;">
                    <div class="col-xs-6">
                        <p style="text-align:center; color:#003e94 !important;"><br>Thank You! Vist again!!</p>
                    </div>
                    <div class="col-xs-6">
                        <p style="text-align:center; color:#003e94 !important;"><br>Service with Satisfaction</p>
                    </div>
                </div>
                <!-- <div class="" style="text-align:center; margin-top:3px;">
                    <p>This software developed by <b style="color:blue !important;">F2F Solutions</b> &nbsp;&nbsp;|&nbsp;&nbsp; Email:info@f2fsolutions.co.in &nbsp;&nbsp;|&nbsp;&nbsp; Phone: +91 95008 51999</p>
                </div> -->
                <div class="hide_class action-btn-align">
                    <a href="<?php echo $this->config->item('base_url') . 'sales/invoice_list/' ?>" class="btn btn-defaultback"><span class="glyphicon"></span> Back </a>
                    <?php if ($quotation[0]['customer_type'] == 3) { ?>
                        <button class="btn btn-defaultprint6" data-toggle="dropdown"><span class="glyphicon glyphicon-print"></span> Print</button>
                        <ul class="dropdown-menu dropdown-menu-left" style="bottom: auto; top: 98%;margin-left: 630px;">
                            <li><a href="javascript:void(0);" class="print_cus" mode="1" sr_id="<?php echo $quotation[0]['id']; ?>"><i class="icon-copy3"></i> Customer Invoice</a></li>
                            <li><a href="javascript:void(0);" class="print_con" mode="2" sr_id="<?php echo $quotation[0]['id']; ?>"><i class="icon-copy4"></i> Contractor Invoice</a></li>
                        </ul>
                    <?php } else { ?>
                        <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>
                    <?php } ?>
                    <?php if ((isset($_GET['notification']) && $_GET['notification'] != '') || ($user_info[0]['role'] == 1 && $quotation[0]['invoice_status'] == 'waiting')) { ?>
                        <button class="btn btn-defaultprint6" id="approve">Approve</button>
                    <?php } ?>
                    <!--<input type="button" class="btn btn-success" id='send_mail' style="float:right;top: 100%"  value="Send Email"/>
                    -->
                </div>
        <?php
            }
        }
        ?>
    </div><!-- contentpanel -->
</div><!-- mainpanel -->
<?php
if (isset($quotation_details) && !empty($quotation_details)) {
    foreach ($quotation_details as $key_ime => $po_vals) {
?>
        <div id="ime_modal<?php echo $po_vals["id"]; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center" style="display: none;">
            <div class="modal-dialog ">
                <div class="modal-content modalcontent-top">
                    <div class="modal-header modal-padding modalcolor ">
                        <a class="close modal-close closecolor" onclick="ime_modal_discard(<?php echo $po_vals["id"]; ?>)">×</a>
                        <h3 id="myModalLabel" style="color:white;margin-top:10px"><?php echo $po_vals["product_name"]; ?></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row scrollclass<?php echo $po_vals["id"]; ?>  heightclass" style="overflow-y:auto;">
                            <table class="table-bordered table-sripted action-btn-align" width="100%">
                                <tr class="action-btn-align">
                                    <th class="action-btn-align">S.No</th>
                                    <th class="action-btn-align">IME CODE</th>
                                </tr>
                                <?php
                                if (!empty($po_vals['ime_code_details'])) {
                                    foreach ($po_vals['ime_code_details'] as $keys => $ime_data) {
                                ?>
                                        <tr class="action-btn-align">
                                            <td><?php echo $keys + 1; ?></td>
                                            <td><?php echo $ime_data; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer action-btn-align" style="">
                        <button type="button" class="btn btn-danger1 " onclick="ime_modal_discard(<?php echo $po_vals["id"]; ?>)"> Discard</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>
<style>
    .heightclass {
        height: auto;
    }

    .scrollclass {
        height: 245px;
    }

    .modal-dialog {
        width: 420px !important;
        margin: 30px auto;
    }
</style>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function ime_modal_open(id, count) {
        if (count > 0) {
            $('#ime_modal' + id + '').modal('show');
            if (count > 10) {
                $('.scrollclass' + id + '').removeClass('heightclass')
                $('.scrollclass' + id + '').addClass('scrollclass')
            }
        } else {
            toastr.clear();
            toastr.error("IME Code Not available", 'Warning Message.!');
        }
    }

    function ime_modal_discard(id) {
        $('#ime_modal' + id + '').modal('hide');
    }
    $(document).ready(function() {
        //  window.print();
        $('#send_mail').click(function() {
            var s_html = $('.size_html');
            for_loading();
            $.ajax({
                url: BASE_URL + "sales/send_email",
                type: 'GET',
                data: {
                    id: <?= $quotation[0]['id'] ?>
                },
                success: function(result) {
                    alert(result);
                    for_response();
                }
            });
        });
        $('.print_con').click(function() {
            ConfirmDialog('Are you sure want to Print invoice ?');
        });
        $('.print_cus').click(function() {
            var sr_id = $(this).attr('sr_id');
            var url = '<?php echo base_url(); ?>sales/customer_invoice_pdf/' + sr_id;
            window.open(url, '_blank');
        });
        $('#approve').click(function() {
            var id = '<?php echo $quotation[0]['id'] ?>';
            var user = '<?php echo $user_info[0]['role'] ?>';
            if (user == 1) {
                $.ajax({
                    url: BASE_URL + "sales/approve_invoice",
                    type: 'POST',
                    data: {
                        id: id,
                    },
                    success: function(result) {
                        if (result == 'success') {
                            swal({
                                title: "Success!",
                                text: "Invoice Approved!",
                                type: "success"
                            }, function() {
                                window.location = BASE_URL + "sales/invoice_list";
                            });
                        }
                    }
                });
            } else {
                sweetAlert("Oops..!", "You Dont Have Permission to approve the invoice!", "error");
                return false;
            }
        });
        $('.print_btn').click(function() {
            window.print();
            // ConfirmDialog('Are you sure want to Print invoice ?');
        });
        $('.gst').click(function() {
            // document.location.href = 'sales/print_view/';
        });

        // window.print();
    });
    $('.nogst').click(function() {
        // window.print();
        // document.location.href = 'sales/print_view/';
    });



    function ConfirmDialog(message) {
        $('<div></div>').appendTo('body')
            .html('<div><h6><strong>' + message + '</strong></h6></div>')
            .dialog({
                modal: true,
                title: 'Print Confirm',
                zIndex: 10000,
                autoOpen: true,
                width: '300px',
                resizable: false,
                buttons: {
                    Yes: function() {
                        // $(obj).removeAttr('onclick');
                        // $(obj).parents('.Parent').remove();
                        window.print();
                        $(this).dialog("close");
                    },
                    No: function() {
                        $(this).dialog("close");
                    }
                },
                close: function(event, ui) {
                    $(this).remove();
                }
            });
    }
    });
</script>