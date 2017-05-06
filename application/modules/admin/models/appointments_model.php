<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Appointments_model extends MY_Model
{
    protected $_table = "appointments";
    public $table     = 'appointments';
    public $id        = 'id';
    public $order     = 'DESC';
    function __construct()
    {
        parent::__construct();
    }
    // get all
    function get_all_appointments()
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
    function generate_get_by_id($id){
        $this->db->where($this->id, $id);
         return $this->db->get($this->table)->result_array();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
    	$this->db->or_like('user_id', $q);
    	$this->db->or_like('reference_no', $q);
    	$this->db->or_like('name', $q);
    	$this->db->or_like('age', $q);
    	$this->db->or_like('sex', $q);
    	$this->db->or_like('phone', $q);
    	$this->db->or_like('email_id', $q);
    	$this->db->or_like('test', $q);
    	$this->db->or_like('test_price', $q);
    	$this->db->or_like('discount', $q);
    	$this->db->or_like('total_price', $q);
    	$this->db->or_like('sample_collection_time', $q);
    	$this->db->or_like('appointment_date', $q);
    	$this->db->or_like('doctor_ref_by', $q);
    	$this->db->or_like('appointment_status', $q);
    	$this->db->or_like('report_doc', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
    	$this->db->or_like('user_id', $q);
    	$this->db->or_like('reference_no', $q);
    	$this->db->or_like('name', $q);
    	$this->db->or_like('age', $q);
    	$this->db->or_like('sex', $q);
    	$this->db->or_like('phone', $q);
    	$this->db->or_like('email_id', $q);
    	$this->db->or_like('test', $q);
    	$this->db->or_like('test_price', $q);
    	$this->db->or_like('discount', $q);
    	$this->db->or_like('total_price', $q);
    	$this->db->or_like('sample_collection_time', $q);
    	$this->db->or_like('appointment_date', $q);
    	$this->db->or_like('doctor_ref_by', $q);
    	$this->db->or_like('appointment_status', $q);
    	$this->db->or_like('report_doc', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    // insert data
    function insert_appointment($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    // update data
    function update_appointment($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    // delete data
    function delete_appointment($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    function todayAppointmentsCount()
    {
        return $this->count_by(array('appointment_date' => date('Y-m-d')));
    }
    function todayAppointments($limit, $start){
        return $this->limit($limit, $start)->get_many_by(array('appointment_date' => date('Y-m-d')));
    }
    function getAppointmentsCountByDate($from_date, $to_date)
    {   
        $count = $this->db->query("SELECT * FROM appointments WHERE 
                                   appointment_date BETWEEN '$from_date' AND '$to_date'")->num_rows();
        return $count;
    }
    function getAppointmentsByDate($from_date, $to_date, $limit, $start = 0)
    {   
        $appointments = $this->db->query("SELECT * FROM appointments WHERE 
                                   appointment_date BETWEEN '$from_date' AND '$to_date' 
                                   ORDER BY id DESC
                                   LIMIT $limit OFFSET $start")->result();
        return $appointments;
    }
    function getDayDetails($date){
    $details = $this->db->query("SELECT DISTINCT (SELECT sum(total_price) FROM appointments WHERE appointment_date = '$date') AS total_amount,  
        (SELECT sum(total_price) FROM appointments WHERE appointment_date = '$date' && payment_status = 'unpaid') AS pending_amount,
         (SELECT sum(total_price) FROM appointments WHERE appointment_date = '$date' && payment_status = 'paid') AS received_amount,
          (SELECT count(*) FROM appointments WHERE appointment_date = '$date' && appointment_status = 'pending') AS pending_appointments,
           (SELECT count(*) FROM appointments WHERE appointment_date = '$date' && appointment_status = 'inprogress') AS inprogress_appointments,
            (SELECT count(*) FROM appointments WHERE appointment_date = '$date' && appointment_status = 'generated') AS generated_appointments,
             (SELECT count(*) FROM appointments WHERE appointment_date = '$date' && appointment_status = 'cancelled') AS cancelled_appointments
FROM appointments WHERE appointment_date = '$date'")->result_array();
    
        if(count($details) > 0)
            return $details[0];
        else
            return array('total_amount' => 0,'pending_amount' => 0, 'received_amount' => 0, 'pending_appointments' => 0, 'inprogress_appointments' => 0, 'generated_appointments'=> 0, 'cancelled_appointments' => 0);
    }
    function getDetailsByDates($from_date, $to_date){
    $details = $this->db->query("SELECT DISTINCT 
       (SELECT sum(total_price) FROM appointments WHERE appointment_date BETWEEN '$from_date' AND '$to_date') AS total_amount,  
        (SELECT sum(total_price) FROM appointments WHERE appointment_date BETWEEN '$from_date' AND '$to_date' && payment_status = 'unpaid') AS pending_amount,
         (SELECT sum(total_price) FROM appointments WHERE appointment_date BETWEEN '$from_date' AND '$to_date' && payment_status = 'paid') AS received_amount,
          (SELECT count(*) FROM appointments WHERE appointment_date BETWEEN '$from_date' AND '$to_date' && appointment_status = 'pending') AS pending_appointments,
           (SELECT count(*) FROM appointments WHERE appointment_date BETWEEN '$from_date' AND '$to_date' && appointment_status = 'inprogress') AS inprogress_appointments,
            (SELECT count(*) FROM appointments WHERE appointment_date BETWEEN '$from_date' AND '$to_date' && appointment_status = 'generated') AS generated_appointments,
             (SELECT count(*) FROM appointments WHERE appointment_date BETWEEN '$from_date' AND '$to_date' && appointment_status = 'cancelled') AS cancelled_appointments
FROM appointments WHERE appointment_date BETWEEN '$from_date' AND '$to_date'")->result_array();
    
        if(count($details) > 0)
            return $details[0];
        else
            return array('total_amount' => 0,'pending_amount' => 0, 'received_amount' => 0, 'pending_appointments' => 0, 'inprogress_appointments' => 0, 'generated_appointments'=> 0, 'cancelled_appointments' => 0);
    }
    public function getTotalReceivedAmount(){
        $details = $this->db->query("SELECT DISTINCT sum(total_price) as received_amount
                                     FROM appointments 
                                     WHERE payment_status = 'paid'")->row();
        
        if($details->received_amount == "")
            return 0.00;
        else
            return $details->received_amount;
    }
    public function getTotalPendingAmount(){
        $details = $this->db->query("SELECT DISTINCT sum(total_price) as pending_amount
                                     FROM appointments 
                                     WHERE payment_status = 'unpaid'")->row();
        if($details->pending_amount == "")
            return 0.00;
        else
            return $details->pending_amount;
    }
}
/* End of file Appointments_model.php */
/* Location: ./application/models/Appointments_model.php */