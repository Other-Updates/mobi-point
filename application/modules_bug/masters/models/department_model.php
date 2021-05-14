<?phpif (!defined('BASEPATH'))    exit('No direct script access allowed');/** * Users_model * * This model represents Department. It operates the following tables: * - department, * * @package	Payroll * @author	Vathsala */class Department_model extends CI_Model {    private $table_name = 'department';    function __construct() {        parent::__construct();        $ci = & get_instance();    }    /**     * Get all departments     *     * @return	array     */    function get_all_departments() {        $this->db->select($this->table_name . '.*');        $this->db->select($this->table_name . '.id as dept_id');        $this->db->select($this->table_name . '.name as dept_name');        $this->db->select('users.first_name department_head');        $this->db->join('users', 'users.id=' . $this->table_name . '.department_head', 'left');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    /* Get all departments by status */    function get_all_departments_by_status($status) {        $this->db->select($this->table_name . '.*');        $this->db->select($this->table_name . '.id as dept_id');        $this->db->select($this->table_name . '.name as dept_name');        $this->db->select('users.first_name department_head');        $this->db->where($this->table_name . '.status', $status);        $this->db->order_by("dept_name", "asc");        $this->db->join('users', 'users.id=' . $this->table_name . '.department_head', 'left');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    /* Get all departments except id */    function get_all_departments_except($id) {        $this->db->select($this->table_name . '.*');        $this->db->select($this->table_name . '.id as dept_id');        $this->db->select($this->table_name . '.name as dept_name');        $this->db->select('users.first_name department_head');        $this->db->where($this->table_name . '.id !=', $id);        $this->db->join('users', 'users.id=' . $this->table_name . '.department_head', 'left');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    /**     * Get all departments names     *     * @return	array     */    function get_all_department_names() {        $this->db->select('id,name');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    /**     * Get all departments names with status enabled     *     * @return	array     */    function get_all_department_names_with_status($status) {        $this->db->where('status', $status);        $this->db->select('id,name');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    /**     * Get all departments names     *     * @return	array     */    function get_department_head_by_id($user_id) {        $this->db->where('department_head', $user_id);        $this->db->select('*');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    function get_department_id_by_department_head($user_id) {        $this->db->where('department_head', $user_id);        $this->db->select('id');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    /**     * Get all departments     *     * @return	array     */    function get_all_departments_by_limit($limit, $start, $filter = null) {        $this->db->limit($limit, $start);        $this->db->select($this->table_name . '.*');        $this->db->select($this->table_name . '.id as dept_id');        $this->db->select($this->table_name . '.name as dept_name');        $this->db->select('users.first_name department_head');        if (isset($filter["sort"]) && !empty($filter["sort"])) {            $this->db->order_by($filter["sort"], $filter["order"]);        }        $this->db->join('users', 'users.id=' . $this->table_name . '.department_head', 'left');        $this->db->order_by($this->table_name . '.id');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    /**     * Get departments by id (dept id)     *     * @param	int     * @return	array     */    function get_department_by_id($dept_id) {        $this->db->select($this->table_name . '.*');        $this->db->select($this->table_name . '.name as dep_name');        $this->db->select($this->table_name . '.id as dept_id');        $this->db->select('users.first_name dept_head');        $this->db->join('users', 'users.id=' . $this->table_name . '.department_head', 'left');        $this->db->where($this->table_name . '.id', $dept_id);        $query = $this->db->get($this->table_name);        if ($query->num_rows() == 1) {            return $query->result_array();        }        return false;    }    /**     * Insert new department     *     * @param	array     * @param	bool     * @return	id     */    function insert_department($data) {        if ($this->db->insert($this->table_name, $data)) {            $dept_id = $this->db->insert_id();            return $dept_id;        }        return false;    }    /**     * Update  department     *     * @param	array     * @param	int     * @return	bool     */    function update_department($dept_id, $data) {        $this->db->where('id', $dept_id);        if ($this->db->update($this->table_name, $data)) {            return true;        }        return false;    }    /**     * Delete department     *     * @param	int     * @return	bool     */    function delete_department($dept_id) {        $this->db->where('id', $dept_id);        $this->db->delete($this->table_name);        if ($this->db->affected_rows() > 0) {            return true;        }        return false;    }    /**     * Get department count */    function get_department_count() {        $this->db->select('count(*) as count');        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    /**     * Get shifts by Department ids(dept id)     *     * @param	int     * @return	array     */    function get_shifts_by_department($dept_id) {        $this->db->select($this->table_name . '.id as dept_id');        $this->db->select('shift.id as shift_id');        $this->db->select('shift.name as shift_name');        $this->db->join('shift', 'shift.id=' . $this->table_name . '.shift_id', 'left');        if (isset($dept_id) && !empty($dept_id)) {            $this->db->where_in($this->table_name . '.id', $dept_id);        }        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }    function check_department_exist($dept_name, $dept_id = NULL) {        $this->db->select('id');        if (gettype($dept_name) == "array")            $this->db->where_in('LOWER(name)', $dept_name);        else            $this->db->where('LOWER(name)', trim(strtolower($dept_name)));        if (isset($dept_id) && $dept_id != NULL)            $this->db->where('id !=', $dept_id);        $query = $this->db->get($this->table_name);        if ($query->num_rows() >= 1) {            return $query->result_array();        }        return false;    }}