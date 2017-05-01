<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class SiteSettings extends MY_Controller
{
   

    function __construct()
    {
        parent::__construct();
        if (!$this->authentication->is_signed_in()){
            redirect(SIGNIN);
        }
        if(!$this->authorization->is_permitted('manage_sitesettings')){
            redirect('');
        }
        $this->load->model('sitesettings_model','sitesettings_m');
    }




    /**
     * [index description]
     * @return [type] [description]
     */
   public function index() 
    {   
        
        $row = $this->sitesettings_m->get_first_row();
        // dump_exit($row);
        if ($row) {
            $data = array(
                            'action'     => 'admin/sitesettings/updateAction',
                            'attributes' => array('name'  => 'sitesettings_form', 'id' => 'sitesettings_form'),
                            'id'         => set_value('id', $row->id),
                            'site_name'       => set_value('site_name', $row->site_name),
                            'site_phone'       => set_value('site_phone', $row->site_phone),
                            'site_email'   => set_value('site_email', $row->site_email),
                            'site_address'       => set_value('site_address', $row->site_address),
                            'site_city'       => set_value('site_city', $row->site_city),
                            'site_state'       => set_value('site_state', $row->site_state),
                            'site_country'       => set_value('site_country', $row->site_country),
                            'site_pincode'       => set_value('site_pincode', $row->site_pincode),
                            'site_currency'       => set_value('site_currency', $row->site_currency),
                         );
            // dump_exit($data);
            $this->template->load_view('sitesettings/sitesettings_form', array_merge($this->data,$data));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/sitesettings'));
        }
    }
    



    /**
     * [updateAction description]
     * @return [type] [description]
     */
    public function updateAction() 
    {
        $this->load->library('form_validation');
        $this->rules();
        if ($this->form_validation->run() == FALSE) {
                $this->index();
        } else {
                $data = array(
                    'site_name'        => $this->input->post('site_name', TRUE),
                    'site_phone'       => $this->input->post('site_phone', TRUE),
                    'site_email'       => $this->input->post('site_email', TRUE),
                    'site_address'     => $this->input->post('site_address', TRUE),
                    'site_city'        => $this->input->post('site_city', TRUE),
                    'site_state'       => $this->input->post('site_state', TRUE),
                    'site_country'     => $this->input->post('site_country', TRUE),
                    'site_pincode'     => $this->input->post('site_pincode', TRUE),
                    'site_currency'    => $this->input->post('site_currency', TRUE)
                );
                // dump_exit($data);
                $this->sitesettings_m->update_by(array('id' => $this->input->post('id', TRUE)), $data);
                $this->session->set_flashdata('message', 'Site Settings Updated.');
                redirect('admin/sitesettings');
        }
     
    }




    /**
     * [rules description]
     * @return [type] [description]
     */
    public function rules() {
            $this->form_validation->set_rules('site_name', 'Name', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('site_phone', 'Phone', 'trim|max_length[10]');
            $this->form_validation->set_rules('site_email', 'Email', 'trim|valid_email|max_length[45]');
            $this->form_validation->set_rules('site_address', 'Address', 'trim|max_length[512]');
            $this->form_validation->set_rules('site_city', 'City', 'trim|max_length[45]');
            $this->form_validation->set_rules('site_state', 'State', 'trim|max_length[45]');
            $this->form_validation->set_rules('site_country', 'Country', 'trim|max_length[45]');
            $this->form_validation->set_rules('site_pincode', 'Pincode', 'trim|max_length[10]');
            $this->form_validation->set_rules('site_currency', 'Currency', 'trim|required|max_length[1]');
            $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
    }

    
}
/* End of file Sitesettings.php */
/* Location: ./application/controllers/Sitesettings.php */