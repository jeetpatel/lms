<?php
/*
 * Sign_out Controller
 */
class Sign_out extends MY_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language'));
		$this->load->config('auth/account/account');
		$this->load->language(array('general', 'account/sign_out'));
	}

	// --------------------------------------------------------------------

	/**
	 * Account sign out
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{	
		// Redirect signed out users to homepage
		if ( ! $this->authentication->is_signed_in()) redirect('');

		// Run sign out routine
		$this->authentication->sign_out();

		// Redirect to homepage
		if ( ! $this->config->item("sign_out_view_enabled")) redirect('');

		// Load sign out view
		$this->template->set_header('home/common/header');
        $this->template->set_footer('home/common/footer');
		$this->template->load_view('sign_out');
	}

}


/* End of file sign_out.php */
/* Location: ./application/account/controllers/sign_out.php */