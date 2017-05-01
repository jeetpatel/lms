<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailSettings_Model extends MY_Model {


	protected $_table = "email_settings";

	public function __construct()
	{
		parent::__construct();
		
	}

	function get_first_row()
    {
        $settings = $this->get_all();
        if(count($settings) > 0){
            return $settings[0];
        }else{
            $data = array(
                            'id' => 1
                         );

            $this->insert($data);
            return $this->get_by(array('id' => $this->db->insert_id()));
        }
        
    }


    function checkEmailConfigurations(){

        $details = $this->get_first_row();
        // dump_exit($details);
        if(!empty($details->smtp_host) && !empty($details->smtp_user) && !empty($details->smtp_password) && !empty($details->smtp_port)){
            return true;
        }else{
            return false;
        }
    }
}

/* End of file emailsettings.php */
/* Location: ./application/models/emailsettings.php */