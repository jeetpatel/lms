<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Commission_model extends MY_Model {

  public $table = 'commission';
  public $id = 'id';
  public $order = 'DESC';

  function __construct() {
    parent::__construct();
  }

  // get all
  function get_all_commission() {
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  // get data by id
  function get_by_id($id) {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }
  
  function get_commission($params=null,$limit=null,$start=null,$count=0) {
    if ($count==1)
    $this->db->select('commission.id');   
    else
    $this->db->select('commission.*,doctors.surname,doctors.name,doctors.commission');   
    $this->db->from('commission');
    $this->db->join('doctors', 'doctors.id = commission.doctor_id', 'inner'); 
    if ($limit!=null && $start!=null)
    {
      $this->db->limit($limit, $start);
    }
    $this->db->order_by($this->id, $this->order);
    $query = $this->db->get();
    if ($count==1)
    {
      return $query->num_rows();
    } else {
      return $query->result();
    }
  }

  // get total rows
  function total_rows($q = NULL) {
    $this->db->like('id', $q);
    $this->db->or_like('doctor_id', $q);
    $this->db->or_like('appointment_id', $q);
    $this->db->or_like('comm_amount', $q);
    $this->db->or_like('comm_percent', $q);
    $this->db->or_like('phone', $q);
    $this->db->or_like('created_at', $q);
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('id', $q);
    $this->db->or_like('doctor_id', $q);
    $this->db->or_like('appointment_id', $q);
    $this->db->or_like('comm_amount', $q);
    $this->db->or_like('comm_percent', $q);
    $this->db->or_like('phone', $q);
    $this->db->or_like('created_at', $q);
    $this->db->limit($limit, $start);
    return $this->db->get($this->table)->result();
  }

  // insert data
  function insert_commission($data) {
    $this->db->insert($this->table, $data);
  }

  // update data
  function update_commission($id, $data) {
    $this->db->where('appointment_id', $id);
    $this->db->update($this->table, $data);
  }

  // delete data
  function delete_commission($id) {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }
}

/* End of file Commission_model.php */
/* Location: ./application/models/commission_model.php */