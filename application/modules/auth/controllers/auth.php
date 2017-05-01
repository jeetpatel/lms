<?php

class Auth extends MY_Controller{

	function __construct()
	{
		parent::__construct();		
	}

	function index()
	{	
		if ($this->authentication->is_signed_in() && ($this->authorization->is_admin() || $this->authorization->is_staff()))
		{	
			redirect('admin');

		}else{
			redirect(SIGNIN);
		}
		
	}

	public function error404()
	{
		$this->template->load_view('404',$this->data);
	}
}	


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */