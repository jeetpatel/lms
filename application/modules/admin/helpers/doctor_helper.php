<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if(!function_exists('getDoctor')){
	function getDoctor($doctorID)
	{
		$CI =& get_instance();
		$CI->load->model('doctors_model','doctor_m');
		return $CI->doctor_m->get_by_id($doctorID);
	}
}

/* End of file appointments_helper.php */
/* Location: ./application/helpers/appointments_helper.php */