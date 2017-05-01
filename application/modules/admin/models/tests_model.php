<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tests_model extends MY_Model
{

    public $table = 'tests';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all_tests()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('test_name', $q);
	$this->db->or_like('test_description', $q);
	$this->db->or_like('test_price', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('test_name', $q);
	$this->db->or_like('test_description', $q);
	$this->db->or_like('test_price', $q);
	$this->db->or_like('status', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert_test($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update_test($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete_test($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function getTestOptions(){

        $testOpts = array('' => '-- SELECT TEST --');
        $tests = $this->db->get_where($this->table,array('status' => 'active'))->result_array();
        if(count($tests) > 0){
            foreach ($tests as $key => $value) {
                $testOpts[$value['id']] = $value['test_name'];
            }
            return $testOpts;
        }else{
            return $testOpts;
        }
    
    }

    public function getTestName($testID)
    {   
        $where['id'] = $testID;
        $details = $this->get_by($where);

        if(!empty($details))
            return humanize($details->test_name);
        else
            return "";
    }

}

/* End of file Tests_model.php */
/* Location: ./application/models/Tests_model.php */