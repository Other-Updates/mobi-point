<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_sub_category extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->user_auth->is_logged_in())
            redirect($this->config->item('base_url') . 'users/login');
        $main_module = 'masters';
        $access_arr = array(
            'manage_sub_category/index' => array('add', 'edit', 'delete', 'view'),
            'manage_sub_category/insert_sub_category' => array('add'),
            'manage_sub_category/edit' => array('edit'),
            'manage_sub_category/update_subcategory' => array('edit'),
            'manage_sub_category/delete' => array('delete'),
            'manage_sub_category/add_duplicate_subcategory' => 'no_restriction',
            'manage_sub_category/update_duplicate_subcategory' => 'no_restriction',
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }

        $this->load->model('masters/subcategory_model');
        $language_data = [];
        $key = array('S.No', 'expsub_category_details', 'expsub_category_list', 'add_new', 'company', 'type', 'category', 'sub_category', 'add_category', 'enter_sub_category', 'status', 'success', 'action', 'edit', 'inactive_subcategory', 'inactive_subcategory_confirmation', 'filtered_from', 'no_data_available', 'showing', 'show', 'entries', 'previous', 'next', 'search', 'to', 'of', 'total', 'required_field', 'expsub_category_already_exists', 'update_expsub_cat', 'submit', 'cancel', 'update', 'clear', 'back', 'enter_details', 'select', 'filtered_from', 'no_data_available', 'showing', 'show', 'entries', 'previous', 'next', 'search', 'total', 'in_active', 'inactive_company_confirmation', 'yes', 'no', 'ok', 'success', 'deleted', 'delete', 'updated', 'expsub_cat_updated', 'expsub_cat_not_updated', 'expsub_cat_added', 'expsub_cat_not_added', 'expsub_cat_delete_success');
        $code = array('s_no', 'expsub_category_details', 'expsub_category_list', 'add_new', 'company', 'type', 'category', 'sub_category', 'add_category', 'enter_sub_category', 'status', 'success', 'action', 'edit', 'inactive_subcategory', 'inactive_subcategory_confirmation', 'filtered_from', 'no_data_available', 'showing', 'show', 'entries', 'previous', 'next', 'search', 'to', 'of', 'total', 'required_field', 'expsub_category_already_exists', 'update_expsub_cat', 'submit', 'cancel', 'update', 'clear', 'back', 'enter_details', 'select', 'filtered_from', 'no_data_available', 'showing', 'show', 'entries', 'previous', 'next', 'search', 'total', 'in_active', 'inactive_company_confirmation', 'yes', 'no', 'ok', 'success', 'deleted', 'delete', 'updated', 'expsub_cat_updated', 'expsub_cat_not_updated', 'expsub_cat_added', 'expsub_cat_not_added', 'expsub_cat_delete_success');
        $this->load->helper('language');
        $language = $this->language = get_words($code, $key);
        $language_data['language'] = $language;
        $this->template->write_view('session_msg', 'masters/session_msg', $language_data);
    }

    public function index()
    {
        $data = array();
        $data['language'] = $language = $this->language;
        $client_id = $this->user_auth->get_login_client_id();
        $data['all_list'] = $this->subcategory_model->get_all_list($client_id);
        $data['category_list'] = $this->subcategory_model->get_all_category_list($client_id);
        // echo '<pre>';
        // print_r($data);
        // exit;
        $this->template->write_view('content', 'masters/manage_sub_category', $data);
        $this->template->render();
    }

    public function insert_sub_category()
    {
        $data['language'] = $language = $this->language;
        $client_id = $this->user_auth->get_login_client_id();
        if ($this->input->post()) {
            $input = $this->input->post();
            $datas['category_id'] = $input['category'];
            $datas['sub_category'] = $input['sub_category'];
            $insert_id = $this->subcategory_model->insert_category($datas);
            if (!empty($insert_id)) {
                $this->session->set_flashdata('flashSuccess', 'Expense Sub Category Successfully added!');
                redirect($this->config->item('base_url') . 'masters/manage_sub_category');
            } else {
                $this->session->set_flashdata('flashError', 'Expense Sub Category not added');
                redirect($this->config->item('base_url') . 'masters/manage_sub_category');
            }
        }
    }

    public function edit($id)
    {
        $data = array();
        $data['language'] = $language = $this->language;
        $client_id = $this->user_auth->get_login_client_id();
        $data["get_category"] = $this->subcategory_model->get_subcategory_by_id($id);
        $data["category_list"] = $this->subcategory_model->get_all_category_list($client_id);
        // echo '<pre>';
        // print_r($data);
        // exit;
        $this->template->write_view('content', 'masters/edit_subcategory_list', $data);
        $this->template->render();
    }

    public function update_subcategory($id)
    {
        $data['language'] = $language = $this->language;
        $data = array();
        if ($this->input->post()) {
            $input = $this->input->post();
            $datas['sub_category'] = $input['sub_category'];
            $datas['category_id'] = $input['category'];
            $update_id = $this->subcategory_model->update_subcategory($datas, $id);
            if (!empty($update_id)) {
                $this->session->set_flashdata('flashSuccess', 'expsub_cat_updated');
                redirect($this->config->item('base_url') . 'masters/manage_sub_category');
            } else {
                $this->session->set_flashdata('flashError', 'expsub_cat_not_updated');
                redirect($this->config->item('base_url') . 'masters/manage_sub_category');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->POST('value1');
        $this->subcategory_model->delete_subcategory($id);
    }

    public function add_duplicate_subcategory()
    {
        $data['language'] = $language = $this->language;
        $client_id = $this->user_auth->get_login_client_id();
        $input = $this->input->post();
        $validation = $this->subcategory_model->add_duplicate_subcategory($input, $client_id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }
        if ($i == 1) {
            echo $language['expsub_category_already_exists'];
        }
    }

    public function update_duplicate_subcategory()
    {
        $data['language'] = $language = $this->language;
        $client_id = $this->user_auth->get_login_client_id();
        $input = $this->input->post();
        $validation = $this->subcategory_model->update_duplicate_subcategory($input, $client_id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }
        if ($i == 1) {
            echo $language['expsub_category_already_exists'];
        }
    }
}
