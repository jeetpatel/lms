<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_m extends MY_Model {

	public $_table = '';
	public $validate = array();

	public function siteSettings()
	{
		return $this->db->get('sitesettings');
	}
}

/* End of file general_model.php */
/* Location: ./application/models/general_model.php */