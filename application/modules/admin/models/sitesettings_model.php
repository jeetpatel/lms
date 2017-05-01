<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sitesettings_model extends MY_Model
{
    protected $_table = "sitesettings";

    function __construct()
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

}

/* End of file Sitesettings_model.php */
/* Location: ./application/models/Sitesettings_model.php */