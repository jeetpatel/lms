<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctors_model extends MY_Model
{

    public $table = 'doctors';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all_doctors()
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
	$this->db->or_like('surname', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('medical_licence_no', $q);
	$this->db->or_like('specialization', $q);
	$this->db->or_like('phone', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('surname', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('medical_licence_no', $q);
	$this->db->or_like('specialization', $q);
	$this->db->or_like('phone', $q);
	$this->db->or_like('status', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert_doctor($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update_doctor($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete_doctor($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function getDoctorOptions(){

        $doctorOpts = array('' => '-- SELECT DOCTOR --');
        $doctors = $this->db->get_where($this->table,array('status' => 'active'))->result_array();
        if(count($doctors) > 0){
            foreach ($doctors as $key => $value) {
                $doctorOpts[$value['id']] = 'Dr. '.humanize($value['surname'].' '.$value['name']).' ('.humanize($value['specialization']).')';
            }

            $doctorOpts['-1'] = 'Others';
            return $doctorOpts;
        }else{
            
            $doctorOpts['-1'] = 'Others';
            return $doctorOpts;
        }
        
    }
}

/* End of file Doctors_model.php */
/* Location: ./application/models/Doctors_model.php */