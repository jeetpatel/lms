<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Doctors extends MY_Controller
{
    

    function __construct()
    {
        parent::__construct();
        if (!$this->authentication->is_signed_in()){
            redirect(SIGNIN);
        }
        
        
        if(!$this->authorization->is_permitted('manage_doctors')){
            redirect('');
        }
        $this->load->model('Doctors_model');
        $this->load->library('form_validation');
    }



    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $segment = $this->uri->segment(3);         
        if(!empty($segment) && ctype_digit($segment)){
            $start = $this->uri->segment(3);
        }
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin/doctors/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin/doctors/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin/doctors';
            $config['first_url'] = base_url() . 'admin/doctors';
        }
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->Doctors_model->total_rows($q);
        $doctors = $this->Doctors_model->get_limit_data($config['per_page'], $start, $q);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'doctors_data' => $doctors,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load_view('doctors/doctors_list', array_merge($this->data,$data));
    }




    /**
     * [read description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function read($id) 
    {
        $row = $this->Doctors_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id' => $row->id,
        'surname' => $row->surname,
        'name' => $row->name,
        'medical_licence_no' => $row->medical_licence_no,
        'specialization' => $row->specialization,
        'phone' => $row->phone,
        'status' => $row->status,
        );
            $this->template->load_view('doctors/doctors_read', array_merge($this->data,$data));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/doctors'));
        }
    }




    /**
     * [create description]
     * @return [type] [description]
     */
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/doctors/createAction'),
            'attributes' => array('name' => 'doctor_form', 'id' => 'doctor_form'),
        'id' => set_value('id'),
        'surname' => set_value('surname'),
        'name' => set_value('name'),
        'medical_licence_no' => set_value('medical_licence_no'),
        'specialization' => set_value('specialization'),
        'phone' => set_value('phone'),
        'status' => set_value('status'),
        'commission' => set_value('commission')
    );
        $this->template->load_view('doctors/doctors_form', array_merge($this->data,$data));
    }
    




    /**
     * [createAction description]
     * @return [type] [description]
     */
    public function createAction() 
    {
        $this->rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'surname' => $this->input->post('surname',TRUE),
        'name' => $this->input->post('name',TRUE),
        'medical_licence_no' => $this->input->post('medical_licence_no',TRUE),
        'specialization' => $this->input->post('specialization',TRUE),
        'phone' => $this->input->post('phone',TRUE),
        'status' => $this->input->post('status',TRUE),
        'commission' => $this->input->post('commission',TRUE),
        );
            $this->Doctors_model->insert_doctor($data);
            $this->session->set_flashdata('message', 'Doctor Added Successfyully.');
            redirect(site_url('admin/doctors'));
        }
    }
    



    /**
     * [update description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function update($id) 
    {
        $row = $this->Doctors_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/doctors/updateAction'),
                'attributes' => array('name' => 'doctor_form', 'id' => 'doctor_form'),
        'id' => set_value('id', $row->id),
        'surname' => set_value('surname', $row->surname),
        'name' => set_value('name', $row->name),
        'medical_licence_no' => set_value('medical_licence_no', $row->medical_licence_no),
        'specialization' => set_value('specialization', $row->specialization),
        'phone' => set_value('phone', $row->phone),
        'status' => set_value('status', $row->status),
        'commission' => set_value('commission', $row->commission),
        ); //commission
            $this->template->load_view('doctors/doctors_form', array_merge($this->data,$data));
        } else {
            $this->session->set_flashdata('message', 'Doctor Not Found');
            redirect(site_url('admin/doctors'));
        }
    }
    



    /**
     * [updateAction description]
     * @return [type] [description]
     */
    public function updateAction() 
    {
        $this->rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
        'surname' => $this->input->post('surname',TRUE),
        'name' => $this->input->post('name',TRUE),
        'medical_licence_no' => $this->input->post('medical_licence_no',TRUE),
        'specialization' => $this->input->post('specialization',TRUE),
        'phone' => $this->input->post('phone',TRUE),
        'status' => $this->input->post('status',TRUE),
        'commission' => $this->input->post('commission',TRUE),
        );
            $this->Doctors_model->update_doctor($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Doctor Updated Successfully.');
            redirect(site_url('admin/doctors'));
        }
    }
    



    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id) 
    {
        $row = $this->Doctors_model->get_by_id($id);
        if ($row) {
            $this->Doctors_model->delete_doctor($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/doctors'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/doctors'));
        }
    }




    /**
     * [rules description]
     * @return [type] [description]
     */
    public function rules() 
    {
        $this->form_validation->set_rules('surname', 'surname', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[250]');
        $this->form_validation->set_rules('medical_licence_no', 'Medical Licence No', 'trim|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|max_length[20]');
        $this->form_validation->set_rules('specialization', 'specialization', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }
    
}
/* End of file Doctors.php */
/* Location: ./application/controllers/Doctors.php */