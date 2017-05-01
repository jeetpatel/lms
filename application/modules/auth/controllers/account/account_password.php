<?php
/*
 * Account_password Controller
 */
class Account_password extends MY_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('auth/account/account');
		$this->load->helper(array('date', 'language', 'account/ssl'));
		$this->load->library(array('form_validation'));
		$this->load->model(array('account/account_model'));
		$this->load->language(array('general', 'account/account_password'));

	}

	/**
	 * Account password
	 */
	function index()
	{	

		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('auth/account/sign_in');
		}

		// Retrieve sign in user
		$this->data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

		// No access to users without a password
		if ( ! $this->data['account']->password) redirect('');

		### Setup form validation
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(array('field' => 'password_new_password', 'label' => 'lang:password_new_password', 'rules' => 'trim|required|min_length[8]'), array('field' => 'password_retype_new_password', 'label' => 'lang:password_retype_new_password', 'rules' => 'trim|required|matches[password_new_password]')));
		// dump_exit($this->input->post());
		### Run form validation
		if ($this->form_validation->run())
		{	
			// Change user's password
			$this->account_model->update_password($this->data['account']->id, $this->input->post('password_new_password', TRUE));
			$this->session->set_flashdata('password_info', lang('password_password_has_been_changed'));
			redirect('auth/account/account_password');
		}

		$this->template->load_view('account/account_password', $this->data);
	}

}


/* End of file account_password.php */
/* Location: ./application/account/controllers/account_password.php */