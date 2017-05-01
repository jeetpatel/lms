<?php
/*
 * Forgot_password Controller
 */
class Forgot_password extends MY_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->config('auth/account/account');
		$this->load->helper(array('language', 'account/ssl'));
		$this->load->library(array('form_validation'));
		$this->load->model(array('account/account_model'));
		$this->load->language(array('general', 'account/forgot_password'));
	}

	/**
	 * Forgot password
	 */
	function index()
	{	

		$this->data['appScript'] = <<< APPSCRIPT
		$(function () {
			$('body').addClass("hold-transition login-page");
        });
APPSCRIPT;


		// Enable SSL?
		maintain_ssl($this->config->item("ssl_enabled"));

		// Redirect signed in users to homepage
		if ($this->authentication->is_signed_in()) redirect('');


		// Setup form validation
		// max length as per IETF (http://www.rfc-editor.org/errata_search.php?rfc=3696&eid=1690)
		$this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'forgot_password_username_email',
				'label' => 'lang:forgot_password_username_email',
				'rules' => 'trim|required|min_length[2]|max_length[254]|callback_check_username_or_email'
			)
		));

		// Run form validation
		if ($this->form_validation->run())
		{	

				// Username does not exist
				if ( ! $account = $this->account_model->get_by_username_email($this->input->post('forgot_password_username_email', TRUE)))
				{
					$this->data['forgot_password_username_email_error'] = lang('forgot_password_username_email_does_not_exist');
				}
				// Does not manage password
				elseif ( ! $account->password)
				{
					$this->data['forgot_password_username_email_error'] = lang('forgot_password_does_not_manage_password');
				}
				else
				{
					// Set reset datetime
					$time = $this->account_model->update_reset_sent_datetime($account->id);

					// Generate reset password url
					$password_reset_url = site_url('auth/account/reset_password?id='.$account->id.'&token='.sha1($account->id.$time.$this->config->item('password_reset_secret')));


					// Load email library
					$this->load->library('email');

					$this->load->model('admin/emailsettings_model','emailsettings_m');
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
								->to($account->email)
								->subject(lang('reset_password_email_subject'))
								->message($this->load->view('account/reset_password_email', array(
								'username' => $account->username,
								'password_reset_url' => anchor($password_reset_url, $password_reset_url)
								), TRUE));

					if($this->email->send())
					{
						// Load reset password sent view
						$this->template->load_view('account/reset_password_sent', isset($this->data) ? $this->data : NULL);
					}
					else
					{	
						$this->data['forgot_password_username_email_error'] = "Invalid email configurations, cannot send email.";
						$this->template->load_view('account/forgot_password', isset($this->data) ? $this->data : NULL);
						// echo $this->email->print_debugger();
					}
					return;
				}
			
		}

		
		
		
		$this->template->load_view('account/forgot_password', isset($this->data) ? $this->data : NULL);
	}

	public function check_username_or_email($str)
	{
		//are we checking an email address?
		if (strpos($str,'@') !== false)
		{
			//Its an email, so lets check if its valid
			if ($this->form_validation->valid_email($str))
				return TRUE;
			else
			{
				$this->form_validation->set_message('check_username_or_email', 'Invalid e-mail address format');
				return FALSE;
			}
		}
		else
		{
			//check if username is alpha_dash
			if ($this->form_validation->alpha_dash($str))
				return TRUE;
			else
			{
				$this->form_validation->set_message('check_username_or_email', 'Invalid username format');
				return FALSE;
			}

		}

	}

}

/* End of file forgot_password.php */
/* Location: ./application/account/controllers/forgot_password.php */
