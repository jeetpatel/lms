<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if(!function_exists('getTestName')){
	function getTestName($testID)
	{
		$CI =& get_instance();
		$CI->load->model('tests_model','tests_m');
		return $CI->tests_m->getTestName($testID);
	}
}

/* End of file appointments_helper.php */
/* Location: ./application/helpers/appointments_helper.php */