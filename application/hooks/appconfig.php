<?php defined('BASEPATH') OR exit('No direct script access allowed');
  
  //Loads configuration from database into global CI config
  function siteConfig()
  {
     $CI =& get_instance();
     $siteSettingsData = $CI->general_m->siteSettings()->row();

     foreach($siteSettingsData as $key => $value)
     {  
     		 $CI->config->set_item($key,$value);
     }

  }
