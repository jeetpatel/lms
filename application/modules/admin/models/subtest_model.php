<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subtest_model extends MY_Model
{

    public $table = 'subtest';
    public $id    = 'id';
    public $order = 'ASC';
    public $test_id = 'test_id';
            function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Sub test
     * @param int $test_id
     * @return type
     */
    function get_all_subtest($test_id=null)
    {
        $this->db->order_by($this->id, $this->order);
        if (!empty($test_id))
        $this->db->where($this->test_id, $test_id);
        return $this->db->get($this->table)->result();
    }

    /**
     * Get Sub test
     * @param type $test_id {optional}
     * @return type
     */
    function get_subtest($test_id=NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where($this->test_id, $test_id);
        return $this->db->get($this->table)->row();
    }
    
    function getDataByKey($columnName,$value,$operator='=') {
      if ((empty($columnName)) || (empty($value)))
      {
        return [];
      }
      $this->db->order_by($this->id, $this->order); 
      switch($operator) {
        case 'IN':
        $this->db->where_in($this->$columnName, $value);
          break;
        default:
        $this->db->where($this->$columnName, $value);
      }
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
	$this->db->or_like('test_id', $q);
	$this->db->or_like('subtest_name', $q);
	$this->db->or_like('price', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('test_id', $q);
        $this->db->or_like('subtest_name', $q);
        $this->db->or_like('price', $q);
        $this->db->or_like('status', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert_subtest($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update_subtest($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete_subtest($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    /**
     * Delete Sub test by test_id
     * @param type $id
     */
    function delete_subtest_test($id)
    {
        $this->db->where($this->test_id, $id);
        $this->db->delete($this->table);
    }

    function getSubtestOptions($id){

        $testOpts = array('' => '-- SELECT TEST --');
        $subtest = $this->db->get_where($this->table,array('test_id' => $id))->result_array();
        if(count($subtest) > 0){
            foreach ($subtest as $key => $value) {
                $testOpts[$value['id']] = $value['subtest_name'];
            }
            return $testOpts;
        }else{
            return $testOpts;
        }
    
    }

    public function getSubTestData($testID,$columnName=null)
    {   
        $where['id'] = $testID;
        $details = $this->get_by($where);

        if(!empty($details))
          if (!empty($columnName))
            return humanize($details->$columnName);
          else
            return humanize($details->subtest_name);
        else
            return "";
    }

}