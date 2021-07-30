<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_sheet extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('expenses/expense_model');
        $this->load->model('masters/subcategory_model');
    }

    public function update_balance_sheet_data($balance_data) {
        $client_id = $this->user_auth->get_login_client_id();
        $company_amt = $balance = 0;

        if ($balance_data['comments'] == '1') {

            $key = '1';
            $sales = $this->expense_model->get_subcategory($key);

            $category_id = $sales[0]['category_id'];
            $sub_category_id = $sales[0]['id'];
            $company_amt = $this->expense_model->getCompanyAmt($balance_data['firm_id']);
            $company_amt = $company_amt[0]['company_amount'];
        }


        if ($balance_data['comments'] == '2') {
            $key = '2';
            $purchase = $this->expense_model->get_subcategory($key);
            $category_id = $purchase[0]['category_id'];
            $sub_category_id = $purchase[0]['id'];
            $company_amt = $this->expense_model->getCompanyAmt($balance_data['firm_id']);
            $company_amt = $company_amt[0]['company_amount'];
        }
        if ($balance_data['comments'] == '3') {
            $category_id = $balance_data['cat_id'];
            $sub_category_id = $balance_data['sub_cat_id'];
            $company_amt = $this->expense_model->getCompanyAmt($balance_data['firm_id']);
            $company_amt = $company_amt[0]['company_amount'];
        }

        $insert_data['user_id'] = $balance_data['user_id'];
        $insert_data['firm_id'] = $balance_data['firm_id'];
        $insert_data['cat_id'] = $category_id;
        $insert_data['sub_cat_id'] = $sub_category_id;
        $insert_data['type'] = $balance_data['type'];
        $insert_data['amount'] = $balance_data['amount'];
        $insert_data['company_amount'] = $company_amt;

        if ($balance_data['mode'] == 'credit') {
            $balance = ($company_amt + $balance_data['amount']);
        } elseif ($balance_data['mode'] == 'debit') {
            $balance = ($company_amt - $balance_data['amount']);
        }

        $insert_data['balance'] = $balance;
        $insert_data['mode'] = $balance_data['mode'];
        $insert_data['created_at'] = $balance_data['created_at'];
        $insert_data['inv_id'] = $balance_data['inv_id'];
        $insert_data['pr_id'] = $balance_data['pr_id'];
        $insert_data['remarks'] = $balance_data['remarks'];
        $insert_data['client_id'] = $client_id;

        $data = $this->expense_model->insert_balance_sheet($insert_data);
        $this->expense_model->update_company_amt($balance, $balance_data['firm_id']);
    }

}
