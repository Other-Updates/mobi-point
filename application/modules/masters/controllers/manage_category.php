<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_category extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->user_auth->is_logged_in()) {
            redirect($this->config->item('base_url') . 'admin');
        }
        $main_module = 'masters';
        $access_arr = array(
            'manage_category/index' => array('add', 'edit', 'delete', 'view'),
            'manage_category/add' => array('add'),
            'manage_category/edit' => array('edit'),
            'manage_category/delete' => array('delete'),
            'manage_category/update_category' => array('edit'),
            'manage_category/add_duplicate_category' => 'no_restriction',
            'manage_category/update_duplicate_category' => 'no_restriction',
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }
        $this->load->model('masters/category_model');
        $language_data = [];
        $key = array('S.No', 'exp_category_details', 'exp_category_list', 'add_new', 'company', 'type', 'category', 'add_category', 'enter_category', 'status', 'success', 'action', 'edit', 'inactive_category', 'inactive_category_confirmation', 'filtered_from', 'no_data_available', 'showing', 'show', 'entries', 'previous', 'next', 'search', 'to', 'of', 'total', 'required_field', 'category_already_exists', 'update_exp_cat', 'submit', 'cancel', 'update', 'clear', 'back', 'enter_details', 'select', 'filtered_from', 'no_data_available', 'showing', 'show', 'entries', 'previous', 'next', 'search', 'total', 'in_active', 'inactive_company_confirmation', 'yes', 'no', 'ok', 'success', 'deleted', 'delete', 'updated', 'exp_cat_updated', 'exp_cat_not_updated', 'exp_cat_added', 'exp_cat_not_added', 'exp_cat_delete_success');
        $code = array('s_no', 'exp_category_details', 'exp_category_list', 'add_new', 'company', 'type', 'category', 'add_category', 'enter_category', 'status', 'success', 'action', 'edit', 'inactive_category', 'inactive_category_confirmation', 'filtered_from', 'no_data_available', 'showing', 'show', 'entries', 'previous', 'next', 'search', 'to', 'of', 'total', 'required_field', 'category_already_exists', 'update_exp_cat', 'submit', 'cancel', 'update', 'clear', 'back', 'enter_details', 'select', 'filtered_from', 'no_data_available', 'showing', 'show', 'entries', 'previous', 'next', 'search', 'total', 'in_active', 'inactive_company_confirmation', 'yes', 'no', 'ok', 'success', 'deleted', 'delete', 'updated', 'exp_cat_updated', 'exp_cat_not_updated', 'exp_cat_added', 'exp_cat_not_added', 'exp_cat_delete_success');
        $this->load->helper('language');
        $language = $this->language = get_words($code, $key);
        $language_data['language'] = $language;
        $this->template->write_view('session_msg', 'masters/session_msg', $language_data);
    }

    public function index() {
        $data = array();
        $data['language'] = $language = $this->language;
        //$client_id = $this->user_auth->get_login_client_id();
        $data['category_list'] = $this->category_model->get_all_category_list();
        $this->template->write_view('content', 'masters/manage_category', $data);
        $this->template->render();
    }

    public function add() {
        $data['language'] = $language = $this->language;
        $client_id = $this->user_auth->get_login_client_id();
        if ($this->input->post()) {
            $input = $this->input->post();
            $input['client_id'] = $client_id;
            $insert_id = $this->category_model->insert_category($input);
            if (!empty($insert_id)) {
                $this->session->set_flashdata('flashSuccess', 'Expense Category successfully added!');
                redirect($this->config->item('base_url') . 'masters/manage_category');
            } else {
                $this->session->set_flashdata('flashError', 'Expense Category not added');
                redirect($this->config->item('base_url') . 'masters/manage_category');
            }
        }
    }

    public function edit($id) {
        $data = array();
        $client_id = $this->user_auth->get_login_client_id();
        $data['language'] = $language = $this->language;
        $data["category_list"] = $this->category_model->get_all_category_list($client_id);
        $data["get_category"] = $this->category_model->get_category_by_id($id);
        $this->template->write_view('content', 'masters/edit_category_list', $data);
        $this->template->render();
    }

    public function update_category($id) {
        $client_id = $this->user_auth->get_login_client_id();
        $data['language'] = $language = $this->language;
        if ($this->input->post()) {
            $input = $this->input->post();
            $input['client_id'] = $client_id;
            unset($input['submit']);
            $update_id = $this->category_model->update_category($input, $id);
            if (!empty($update_id)) {
                $this->session->set_flashdata('flashSuccess', 'Expense Category successfully updated');
                redirect($this->config->item('base_url') . 'masters/manage_category');
            } else {
                $this->session->set_flashdata('flashError', 'Expense Category not updated');
                redirect($this->config->item('base_url') . 'masters/manage_category');
            }
        }
    }

    public function delete() {
        $id = $this->input->POST('value1');
        $this->category_model->delete_category($id);
    }

    public function add_duplicate_category() {
        $data['language'] = $language = $this->language;
        $client_id = $this->user_auth->get_login_client_id();
        $input = $this->input->post();
        $validation = $this->category_model->add_duplicate_category($input, $client_id);
        if ($validation) {
            echo $language['category_already_exists'];
        }
    }

    public function update_duplicate_category() {
        $data['language'] = $language = $this->language;
        $client_id = $this->user_auth->get_login_client_id();
        $cat_name = $this->input->get('value1');
        $id = $this->input->get('value2');
        $comments = $this->input->get('comments');
        $validation = $this->category_model->update_duplicate_category($cat_name, $id, $comments, $client_id);
        if ($validation) {
            echo $language['category_already_exists'];
        }
    }

}
