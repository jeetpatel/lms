<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if(!function_exists('getUserName')){
	function getUserName($userID)
	{
		$CI =& get_instance();
		$CI->load->model('auth/account/account_model','account_m');
		return $CI->account_m->getUserName($userID);
	}
}

/* End of file appointments_helper.php */
/* Location: ./application/helpers/appointments_helper.php */