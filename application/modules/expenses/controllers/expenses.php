<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expenses extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->user_auth->is_logged_in()) {
            redirect($this->config->item('base_url') . 'admin');
        }
        $main_module = 'expenses';
        $access_arr = array(
            'expenses/expenses_list' => 'no_restriction',
            'expenses/index' => array('add', 'edit', 'delete', 'view'),
            'expenses/insert_expense' => array('add'),
            'expenses/get_subcategory' => array('add'),
            'expenses/edit' => array('edit'),
            'expenses/get_company_amount' => 'no_restriction',
            'expenses/update_expenses' => array('edit'),
            'expenses/balance_list' => 'no_restriction',
            'expenses/expenses_ajaxList' => 'no_restriction',
            'expenses/balancesheet_ajaxList' => 'no_restriction',
            'expenses/getall_expenses_entries' => 'no_restriction',
            'expenses/getall_balance_entries' => 'no_restriction',
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            $this->user_auth->is_permission_allowed();
            redirect($this->config->item('base_url'));
        }
        
        $this->load->model('expenses/expense_model');
        $this->load->model('masters/manage_firms_model');
        $this->load->model('masters/subcategory_model');
        $this->template->write_view('session_msg', 'masters/sess_msg');
    }

    public function index() {
        $client_id = $this->user_auth->get_login_client_id();
        $data = array();
        
        $data["category_list"] = $this->subcategory_model->get_all_category_list($client_id);
        //$data['firms'] = $firms = $this->expense_model->get_all_firms();
        $data["firms"] = $firms = $this->manage_firms_model->get_all_firms($client_id);
        $data['sub_category_list']=$this->subcategory_model->get_all_subcategory_list($client_id);
        // print_r($data); exit;
        $this->template->write_view('content', 'expenses/index', $data);
        $this->template->render();
    }

    public function expenses_list() {
        $client_id = $this->user_auth->get_login_client_id();
        $data = array();
        // $data['firms'] = $firms = $this->expense_model->get_all_firms();
        $data["firms"] = $firms = $this->manage_firms_model->get_all_firms($client_id);
        $data["category_list"] = $this->subcategory_model->get_all_category_list($client_id);
        $data['expense_details'] = $this->expense_model->get_all_expenses();
        $data['sub_category_list']=$this->subcategory_model->get_all_subcategory_list($client_id);
        // echo'<pre>';  
        // print_r($data); 
        //    exit;
        $this->template->write_view('content', 'expenses/expenses_list', $data);
        $this->template->render();
    }

    public function insert_expense() {
        $client_id = $this->user_auth->get_login_client_id();
        if ($this->input->post()) {
            $input = $this->input->post();
            $user_info = $this->user_auth->get_from_session('user_info');
            $input['user_id'] = $user_info[0]['id'];
            $company_amt = $input['company_amount'];
            $expense_amt = $input['amount'];
            $mode = $input['mode'];
            if ($mode == 'credit') {
                $balance = ($company_amt + $expense_amt);
            } elseif ($mode == 'debit') {
                $balance = ($company_amt - $expense_amt);
            }
            $input['balance'] = $balance;
            $input['created_at'] = date('Y-m-d', strtotime($input['created_at']));
            unset($input['submit']);
            $input['client_id'] = $client_id;
            $this->expense_model->insert_expense($input);
            //Update balance sheet
            $balance_data = [
                "user_id" => $user_info[0]['id'],
                "firm_id" => $input['firm_id'],
                "cat_id" => $input['cat_id'],
                "sub_cat_id" => $input['sub_cat_id'],
                //For expenses,comments = 3
                "comments" => '3',
                "type" => $input['type'],
                "mode" => $input['mode'],
                "amount" => $input['amount'],
                "created_at" => $input['created_at'],
                "inv_id" => '',
                "pr_id" => '',
                "remarks" => $input['remarks'],
            ];
            $this->load->library('Balance_sheet');
            $this->balance_sheet->update_balance_sheet_data($balance_data);
            $this->expense_model->update_company_amt($balance, $input['firm_id']);
            $this->session->set_flashdata('flashSuccess', 'New Expense successfully added!');
            redirect($this->config->item('base_url') . 'expenses/expenses_list');
        }
    }

    public function get_subcategory() {
        $input = $this->input->post('category_id');
        $data = $this->expense_model->getSubCategory($input);
        echo json_encode($data);
    }

    public function get_company_amount() {

        $input = $this->input->post('firm_id');
        $data = $this->expense_model->getCompanyAmt($input);
        echo json_encode($data);
    }

    public function edit($id) {
        $client_id = $this->user_auth->get_login_client_id();
        $data = array();
        //$data['firms'] = $firms = $this->expense_model->get_all_firms();
        $data["firms"] = $firms = $this->manage_firms_model->get_all_firms($client_id);
        $data["category_list"] = $this->subcategory_model->get_all_category_list($client_id);
        $data['expense_edit'] = $expense_edit = $this->expense_model->edit_expenses($id);
        $category_id = $sub_category_list = '';
        if (!empty($expense_edit)) {
            $category_id = $expense_edit[0]['cat_id'];
            $sub_category_list = $this->expense_model->getSubCategory($category_id);
        }
        $data['sub_category_list'] = $sub_category_list;
        $this->template->write_view('content', 'expenses/edit_expense', $data);
        $this->template->render();
    }

    public function update_expenses($id) {
        $input = array();
        if ($this->input->post()) {
            $input = $this->input->post();
            $user_info = $this->user_auth->get_from_session('user_info');
            $input['user_id'] = $user_info[0]['id'];
            $company_amt = $input['company_amount'];
            $expense_amt = $input['amount'];
            $mode = $input['mode'];
            if ($mode == 'credit') {
                $balance = ($company_amt + $expense_amt);
            } elseif ($mode == 'debit') {
                $balance = ($company_amt - $expense_amt);
            }
            $input['balance'] = $balance;
            $input['created_at'] = date('Y-m-d', strtotime($input['created_at']));
            $input['updated_at'] = date('Y-m-d H:i:s');
            unset($input['submit']);
            $this->expense_model->update_expenses($input, $id);
            $balance = $this->expense_model->update_balance_sheet($input, $id);
            $this->expense_model->update_company_amt($balance, $input['firm_id']);
            $this->session->set_flashdata('flashSuccess', 'Expense successfully updated!');
            redirect($this->config->item('base_url') . 'expenses/expenses_list');
        }
    }

    public function balance_list() {
        $data = array();
        $client_id = $this->user_auth->get_login_client_id();
        $data["firms"] = $firms = $this->manage_firms_model->get_all_firms($client_id);
        // $data['firms'] = $firms = $this->expense_model->get_all_firms();
        $data['balance_list'] = $this->expense_model->get_all_balance();
        $this->template->write_view('content', 'expenses/balance_list', $data);
        $this->template->render();
    }

    function expenses_ajaxList() {
        $search_data = array();
        $search_data = $this->input->post();
        $list = $this->expense_model->get_datatables($search_data);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ass) {
            if ($this->user_auth->is_action_allowed('expenses', 'expenses', 'edit')) {
                $edit_row = '<a class="tooltips btn btn-info btn-fw btn-xs" href="' . base_url() . 'expenses/edit/' . $ass->id . '"><i class="fa fa-edit"></i></a>';
            } else {
                $edit_row = '<a class="tooltips btn btn-info btn-fw btn-xs alerts" href=""><i class="fa fa-edit"></i></a>';
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $ass->prefix;
            $row[] = ucfirst($ass->type);
            $row[] = ucfirst($ass->category);
            $row[] = ucfirst($ass->sub_category);
            $row[] = ucfirst($ass->mode);
            $row[] = number_format($ass->amount ? $ass->amount : '0.00', 2);
            $row[] = ($ass->created_at != '' && $ass->created_at != '0000-00-00 00:00:00') ? date('d-M-Y', strtotime($ass->created_at)) : '-';
            $row[] = $edit_row;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expense_model->count_all(),
            "recordsFiltered" => $this->expense_model->count_filtered($search_data),
            "data" => $data,
        );
        echo json_encode($output);
        exit;
    }

    function balancesheet_ajaxList() {
        $search_data = array();
        $search_data = $this->input->post();
        $list = $this->expense_model->get_balance_datatables($search_data);
        $get_company_bal = $this->expense_model->getCompanyAmt($search_data["firm_id"]);

        $com_bal = '';
        if (!empty($get_company_bal))
            $com_bal[] = [1, $get_company_bal[0]['firm_name'], "Opening Balance", "-", "-", "0.00", $get_company_bal[0]['opening_balance'], $get_company_bal[0]['opening_balance']];

        $data = array();
        $no = $_POST['start'];
        if ($com_bal) {
            $no = $_POST['start'] + 1;
        }
        foreach ($list as $ass) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $ass->prefix;
//            $row[] = $ass->company_amount;
            if ($ass->comments == 1) {
                $type = 'Sales';
            } elseif ($ass->comments == 2) {
                $type = 'Purchase';
            } else {
                $type = 'Expenses';
            }
            $row[] = $type;
            if ($ass->comments == 1) {
                $details = ' ' . number_format($ass->opening_balance, 2) . ' ' . $ass->inv_id . ' ' . $ass->cust_name;
            } elseif ($ass->comments == 2) {
                $details = ' ' . number_format($ass->opening_balance, 2) . ' ' . $ass->po_no . ' ' . $ass->store_name;
            } else {
                $details = ' ' . number_format($ass->opening_balance, 2) . ' ' . $ass->type . ' ' . $ass->category . ' ' . $ass->sub_category . ' ' . $ass->remarks;
            }
            $row[] = $details;
            $row[] = ($ass->created_at != '' && $ass->created_at != '0000-00-00 00:00:00') ? date('d-M-Y', strtotime($ass->created_at)) : '-';
            if ($ass->mode == 'debit' && ($ass->amount > 0)) {
                $debit_amount = ($ass->amount);
            } elseif ($ass->mode == 'credit' && ($ass->amount < 0)) {
                $debit_amount = (abs($ass->amount));
            } else {
                $debit_amount = '0.00';
            }
            $row[] = number_format($debit_amount, 2);
            if ($ass->mode == 'credit' && ($ass->amount > 0)) {
                $credit_amount = ($ass->amount);
            } elseif ($ass->mode == 'debit' && ($ass->amount < 0)) {
                $credit_amount = (abs($ass->amount));
            } else {
                $credit_amount = '0.00';
            }
            $row[] = number_format($credit_amount, 2);
            $row[] = number_format($ass->balance ? $ass->balance : '0.00', 2);
            $data[] = $row;
        }
        if ($com_bal) {
            $data = array_merge($com_bal, $data);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expense_model->count_all_balance(),
            "recordsFiltered" => $this->expense_model->count_filtered_balance($search_data),
            "data" => $data,
        );
        echo json_encode($output);
        exit;
    }

    function getall_expenses_entries() {

        $search_data = array();
        $search_data = $this->input->get();
        $expenses_data = $this->expense_model->get_expenses_datas($search_data);
//        echo "<pre>"; print_r($data);  exit;
        $this->export_all_expenses_csv($expenses_data);
    }

    function export_all_expenses_csv($query, $timezones = array()) {

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Expenses Report.csv');
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        // output the column headings
//        Order has been changes
        fputcsv($output, array('S.No', 'Company', 'Expense Type', 'Category', 'Sub Category', 'Mode', 'Expense Amount', 'Created Date'));
        // fetch the data
        //$rows = mysql_query($query);
        // loop over the rows, outputting them

        foreach ($query as $key => $value) {
            $row = array($key + 1, $value['prefix'], $value['type'], $value['category'], $value['sub_category'], $value['mode'], number_format($value['amount'], 2), ($value['created_at'] != '1970-01-01') ? date('d-M-Y', strtotime($value['created_at'])) : '');
            fputcsv($output, $row);
        }

        exit;
    }

    function getall_balance_entries() {
        $search_data = array();
        $search_data = $this->input->get();

        $balance_data = $this->expense_model->get_balance_datas($search_data);
//        echo "<pre>"; print_r($data);  exit;
        $this->export_all_balance_data_csv($balance_data);
    }

    function export_all_balance_data_csv($query, $timezones = array()) {

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Balance Report.csv');
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        //Order has been changes
        fputcsv($output, array('S.No', 'Company', 'Type', 'Details', 'Created Date', 'Debit Amt', 'Credit Amt', 'Balance'));

        // fetch the data
        //$rows = mysql_query($query);
        // loop over the rows, outputting them

        foreach ($query as $key => $value) {
            if ($value['comments'] == 1) {
                $type = 'Sales';
            } elseif ($value['comments'] == 2) {
                $type = 'Purchase';
            } else {
                $type = 'Expenses';
            }

            if ($value['comments'] == 1) {
                $details = ' ' . number_format($value['opening_balance'], 2) . ' ' . $value['inv_id'] . ' ' . $value['cust_name'];
            } elseif ($value['comments'] == 2) {
                $details = ' ' . number_format($value['opening_balance'], 2) . ' ' . $value['po_no'] . ' ' . $value['store_name'];
            } else {

                $details = ' ' . number_format($value['opening_balance'], 2) . ' ' . $value['type'] . ' ' . $value['category'] . ' ' . $value['sub_category'] . ' ' . $value['remarks'];
            }
            if ($value['mode'] == 'debit' && ($value['amount'] > 0)) {
                $debit_amount = ($value['amount']);
            } elseif ($value['mode'] == 'credit' && ($value['amount'] < 0)) {
                $debit_amount = (abs($value['amount']));
            } else {
                $debit_amount = '0.00';
            }
            if ($value['mode'] == 'credit' && ($value['amount'] > 0)) {
                $credit_amount = ($value['amount']);
            } elseif ($value['mode'] == 'debit' && ($value['amount'] < 0)) {
                $credit_amount = (abs($value['amount']));
            } else {
                $credit_amount = '0.00';
            }
            $row = array($key + 1, $value['prefix'], $type, $details, ($value['created_at'] != '1970-01-01') ? date('d-M-Y', strtotime($value['created_at'])) : '', number_format($debit_amount, 2), number_format($credit_amount, 2), number_format($value['balance'] ? $value['balance'] : '0.00', 2));
            fputcsv($output, $row);
        }
        exit;
    }

}
