<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	

	function __construct()
	{
		parent::__construct();
		if (!$this->authentication->is_signed_in()){
			redirect(SIGNIN);
		}
		
	}




	/**
	 * [index method will get the pending appointments count, inprogress appointments count, generated appointments count, cancelled appointments count and loads the dashboard view by calling _pageletDashboard method ]
	 * @return [type] [description]
	 */
	public function index()
	{	
		$this->load->model('appointments_model','appointments_m');
		
		$dt = json_encode(array(
				'pending_appointments'    => $this->appointments_m->count_by(array('appointment_status' => 'pending')),
				'inprogress_appointments' => $this->appointments_m->count_by(array('appointment_status' => 'inprogress')),
				'generated_appointments'  => $this->appointments_m->count_by(array('appointment_status' => 'generated')),
				'cancelled_appointments'  => $this->appointments_m->count_by(array('appointment_status' => 'cancelled')),
			  ));
		$this->data['pagelet_dashboard'] = Modules::run('admin/pageletDashboard',array());
		$this->data['appScript'] = "window.appointmentsData = '{$dt}'";
		$this->template->add_cdn_js("https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js");
		$this->template->add_thirdparty_css("morris/morris.css");
		$this->template->add_thirdparty_js("morris/morris.min.js");
		$this->template->add_js('admin/pages/dashboard.js');
		$this->template->load_view('dashboard',$this->data);		
	}


	/**
	 * [_pagelet_dashboard method will load the dashboard view]
	 * @param  array  $params [description]
	 * @return [type]         [description]
	 */
	function pageletDashboard($params = array()){
		$this->load->model('appointments_model','appointments_m');
		$this->load->model('doctors_model','doctors_m');
		$this->load->model('tests_model','tests_m');
		$this->load->model('auth/account/acl_role_model');
		$default_params = array(
									'appointments_count' => $this->appointments_m->count_all(),
									'tests_count' => $this->tests_m->count_all(),
									'doctors_count' => $this->doctors_m->count_all(),
									'staff_count' => $this->acl_role_model->get_user_count(3)	
							   );
		// dump_exit($default_params);
		$params = array_merge($default_params,$params);
		$this->load->view('pagelets/pagelet_dashboard',$params);
	}





	/**
	 * [sendMail method is used to send quick mails from dashboard]
	 * @return [type] [description]
	 */
	public function sendMail(){
		if($this->input->is_ajax_request()){

			 $result = array('status' => 'FAIL', 'mes' => '');
			 $this->load->library('form_validation');
			 $this->rules();
			 if ($this->form_validation->run() == true) {
			 		$this->load->library('email');
					$this->load->model('emailsettings_model','emailsettings_m');
					//check the email configurations
					
					//get the email settings
					$settings = $this->emailsettings_m->get_first_row();

					$config['protocol']         = $settings->protocol;
		            $config['mailpath']         = $settings->path_to_send_mail;
					$config['smtp_host']        = $settings->smtp_host;
					$config['smtp_user']        = $settings->smtp_user;
					$config['smtp_pass']        = $settings->smtp_password;
					$config['smtp_port']        = $settings->smtp_port;

					$this->email->initialize($config);
					$this->email->from($config['smtp_user'], $this->config->item('site_name'))
								->reply_to($config['smtp_user'])
								->to($this->input->post('emailto'))
								->subject($this->input->post('subject'))
								->message($this->input->post('message'));
								
					if ($this->email->send()){
						$result['status'] = "SUCCESS";
						$result['mes'] = '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Success!</strong> Mail Sent.
						</div>';				    
					}else{
						$result['mes'] = '<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Info!</strong> Unable to send mail.
						</div>';
					}
			 }else{

			 	$result['mes'] = '<div class="alert alert-info">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			 		<strong></strong>'. validation_errors().'</div>'; 
			 }

			 echo json_encode($result); return;
		}
	}


	/**
	 * [_rules method will set the server side validations for quick email form]
	 * @return [type] [description]
	 */
	public function rules() {

	    $this->form_validation->set_rules('emailto', 'Email', 'trim|required|valid_email');
	    $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
	    $this->form_validation->set_rules('message', 'Message', 'trim|required');
	    $this->form_validation->set_error_delimiters('<p">', '</p>');
    
    }
    
}
/* End of file admin.php */
/* Location: ./application/modules/admin/controllers/admin.php */