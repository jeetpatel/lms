<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Commission extends MY_Controller
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
        $this->load->model('commission_model');
    }



    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        $q      = urldecode($this->input->get('q', TRUE));
        $start  = intval($this->input->get('start'));
        
        $segment    = $this->uri->segment(3);         
        if(!empty($segment) && ctype_digit($segment)){
            $start  = $this->uri->segment(3);
        }
        
        if ($q <> '') {
            $config['base_url']   = base_url() . 'admin/commission?q=' . urlencode($q);
            $config['first_url']  = base_url() . 'admin/commission?q=' . urlencode($q);
        } else {
            $config['base_url']   = base_url() . 'admin/commission';
            $config['first_url']  = base_url() . 'admin/commission';
        }
        $config['per_page']       = RECORDSPERPAGE;
        $config['uri_segment']    = 3;
        $config['total_rows'] = $this->commission_model->get_commission($q,null,null,1);
        //echo "<pre>"; print_r($config['total_rows']); echo "</pre>";
        //die;
        $paginator = $this->commission_model->get_commission($config['per_page'], $start, $q);
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data = array(
            'result_data' => $paginator,
            'q'           => $q,
            'pagination'  => $this->pagination->create_links(),
            'total_rows'  => $config['total_rows'],
            'start'       => $start,
        );
        $this->template->load_view('commission/list', array_merge($this->data,$data));
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
}
/* End of file Doctors.php */
/* Location: ./application/controllers/Doctors.php */