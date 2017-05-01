<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailSettings extends MY_Controller {
	


	function __construct()
	{
		parent::__construct();
		if(!$this->authorization->is_permitted('manage_emailsettings')){
           redirect('');
        }
		$this->load->model('emailsettings_model','emailsettings_m');
	}




	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index() 
    {	
    	
        $row = $this->emailsettings_m->get_first_row();
        if ($row) {
            $data = array(
			                'action'     => 'admin/emailsettings/updateAction',
			                'attributes' => array('name' => 'sitesettings_form', 'id' => 'sitesettings_form'),
			                'id' 		 => set_value('id', $row->id),
			                'protocol' 	 => set_value('protocol', $row->protocol),
			                'path_to_send_mail'	 => set_value('path_to_send_mail', $row->path_to_send_mail),
			                'host'     	 => set_value('host', $row->smtp_host),
			                'email' 	 => set_value('email', $row->smtp_user),
			                'password'   => set_value('password', $row->smtp_password),
			                'port'		 => set_value('port', $row->smtp_port)
				         );
            // dump_exit($data);
            $this->template->load_view('emailsettings/emailsettings', array_merge($this->data,$data));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/emailsettings'));
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
	            'protocol' 	 => $this->input->post('protocol', TRUE),
			    'path_to_send_mail'	 => $this->input->post('path_to_send_mail', TRUE),
				'smtp_host' => $this->input->post('host',TRUE),
				'smtp_user' => $this->input->post('email',TRUE),
				'smtp_password' => $this->input->post('password',TRUE),
				'smtp_port' => $this->input->post('port',TRUE),
			    );
	            // dump_exit($data);
	            $this->emailsettings_m->update_by(array('id' => $this->input->post('id', TRUE)), $data);
	            $this->session->set_flashdata('message', 'Email Settings Updated.');
	            redirect('admin/emailsettings');
        }
         
    }




    /**
     * [rules description]
     * @return [type] [description]
     */
    public function rules() {
    		$this->form_validation->set_rules('protocol', 'Protocol', 'trim|required');
			$this->form_validation->set_rules('path_to_send_mail', 'Mail Path', 'trim|required');
			$this->form_validation->set_rules('host', 'Host', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|password');
			$this->form_validation->set_rules('port', 'Port', 'trim|required|integer');
			$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
	}

	
}
/* End of file  */
/* Location: ./application/controllers/ */